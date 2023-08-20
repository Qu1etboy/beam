<?php

namespace App\Http\Controllers;

use App\Mail\SubmissionResultMail;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\RegistrantQuestion;
use App\Models\User;
use \Datetime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Spatie\CalendarLinks\Link;

class EventController extends Controller
{
    /**
     * Display a listing of published events.
     */
    public function index()
    {
        // Get the published upcoming events order by start_date
        $events = Event::where('is_published', true)
                    ->where('end_date', '>', Carbon::now())
                    ->orderBy('start_date')
                    ->paginate(10);
        return view('index', compact('events'));
    }

    public function search(Request $request)
    {
        $search_query = $request->query('q');
        $events = Event::search($search_query)->where('is_published', 1)->paginate(10);
        return view('search', compact('events', 'search_query'));
    }

    /**
     * Create a new event.
     */
    public function create()
    {
        return view('create-event');
    }


    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        $user = User::find(Auth::id());
        $owner = $event->organizer->owner;
        $is_registered = false;
        if ($user) {
            // Check if user already registered this event
            $is_registered = $user->joinedEvents()->find($event->id);
        }
        return view('event-detail', ['event' => $event, 'owner' => $owner, 'is_registered' => $is_registered]);
    }

     /**
     * Delete the specified event.
     */
    public function destroy(Organizer $organizer, Event $event)
    {

        $event->delete();

        return redirect()->back();
    }

    /**
     * Show the dashboard for the given event.
     */
    public function dashboard(Organizer $organizer, Event $event)
    {
        // Assuming there's a created_at column in your pivot table for event-user.
        $acceptedCount = $event->participants()->wherePivot('status', 'ACCEPTED')->count();
        $pendingCount = $event->participants()->wherePivot('status', 'PENDING')->count();
        $rejectedCount = $event->participants()->wherePivot('status', 'REJECTED')->count();

        // Get the number of registration per day
        $days = [];
        $registrations = [];
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $daysInMonth = Carbon::now()->daysInMonth;
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $days[] = (string)$i;
            $registrations[] = $event->participants()
                ->whereDate('event_user.created_at', Carbon::create($currentYear, $currentMonth, $i))
                ->count();
        }

        // Get total cost of the event
        $totalCost = $event->getTotalOrderCost();

        return view('organizer.event.dashboard', compact('organizer', 'event', 'acceptedCount', 'pendingCount', 'rejectedCount', 'days', 'registrations', 'totalCost'));
    }

    /**
     * Show the information for the given event.
     */
    public function information(Organizer $organizer, Event $event)
    {
        return view('organizer.event.information', compact('organizer', 'event'));
    }

    public function updateInformation(Request $request, Organizer $organizer, Event $event)
    {

        // dd($request);

        $validatedData = $request->validate([
            'event_name' => ['required', 'string', 'min:1', 'max:1024','unique:events,event_name,' . $event->id],
            'event_description' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date', 'after:register_end_date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'register_start_date' => ['nullable', 'date'],
            'register_end_date' => ['nullable', 'date', 'after:register_start_date'],
            'allow_register' => [
                // 'nullable', 
                // 'boolean',
                function ($attribute, $value, $fail) use ($request) {
                    if ((is_null($request->get('register_start_date')) && is_null($request->get('register_end_date'))) && $value) {
                        $fail("You can't allow candidate to register if not specified register time period");
                    }
                },

            ],
            'location' => ['nullable', 'string'],
        ]);

        $file = $request->file('poster');

        // If user upload a new poster store in storage and update.
        if ($file) {
            $poster_path = $file->store('posters', 'public');
            $event->poster_image = $poster_path;
            $event->save();
        }

        $event->event_name = $request->get('event_name');
        $event->event_description = $request->get('event_description');
        $event->start_date = $request->get('start_date');
        $event->end_date = $request->get('end_date');
        $event->register_start_date = $request->get('register_start_date');
        $event->register_end_date = $request->get('register_end_date');
        $event->allow_register = $request->has('allow_register');
        $event->location = $request->get('location');

        $event->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Display a listing of the participants for the given event.
     */
    public function participantSubmissions(Organizer $organizer, Event $event)
    {
        // Get pending participants
        $eventWithPendingParticipants = Event::with(['participants' => function ($query) {
            $query->where('status', '=', 'PENDING');
        }])->find($event->id);

        $participants = $eventWithPendingParticipants->participants;

        return view('organizer.event.participants.submission', compact('organizer', 'event', 'participants'));
    }

    /**
     * Display a listing of the participants for the given event.
     */
    public function participantAccepted(Organizer $organizer, Event $event)
    {
        // Get pending participants
        $eventWithAcceptedParticipants = Event::with(['participants' => function ($query) {
            $query->where('status', '=', 'ACCEPTED');
        }])->find($event->id);

        $participants = $eventWithAcceptedParticipants->participants;

        return view('organizer.event.participants.accepted', compact('organizer', 'event', 'participants'));
    }

    /**
     * Set between ACCPETED or REJECTED
     */
    public function setParticipantStatus(Request $request, Organizer $organizer, Event $event)
    {
        $user_id = $request->get('user_id');
        $status = $request->get('status');

        $user = User::find($user_id);

        $event->participants()->syncWithoutDetaching([$user_id => ['status' => $status]]);

        if ($status == "ACCEPTED") {
            // Sent email to users that they got accepted

            $subject = $event->accepted_email_subject ? $event->accepted_email_subject : Event::$DEFAULT_ACCEPTED_MAIL_SUBJECT; 
            $body = $event->accepeted_email_body ? $event->accepeted_email_body : Event::$DEFAULT_ACCEPTED_MAIL_BODY;

            $body = $this->replaceSpecialSymbol($body, $user, $event);
            $subject = $this->replaceSpecialSymbol($subject, $user, $event);

            Mail::to($user->email)->send(new SubmissionResultMail($subject, $body));
        } else {
            // Sent email to users that they got rejected
            $subject = $event->rejected_email_subject ? $event->rejected_email_subject : Event::$DEFAULT_REJECTED_MAIL_SUBJECT; 
            $body = $event->rejected_email_body ? $event->rejected_email_body : Event::$DEFAULT_REJECTED_MAIL_BODY;

            $body = $this->replaceSpecialSymbol($body, $user, $event);
            $subject = $this->replaceSpecialSymbol($subject, $user, $event);
            
            Mail::to($user->email)->send(new SubmissionResultMail($subject, $body));
        }

        return redirect()->back();
    }

    /**
     * Register user to an event.
     */
    public function register(Request $request, Event $event)
    {
        $user = User::find(Auth::id());

        $joinedEvent = $user->joinedEvents()->find($event->id);

        // If user already registered this event
        if ($joinedEvent) {
            abort(409, 'You already registered this event.');
        }

        if (!$event->allow_register) {
            abort(400, 'Not allowed to register this event yet.');
        }

        // Not in register date
        if ($event->register_start_date > date("Y-m-d")) {
            abort(400, 'The application period hasn\'t started.');
        }

        // Not in register date
        if ($event->register_end_date < date("Y-m-d")) {
            abort(400, 'The application period has closed.');
        }

        // This event has started or the application has close so can't register anymore
        if ($event->start_date && $event->start_date < date("Y-m-d")) {
            abort(400, 'The application period has closed.');
        }

        // This event has started or the application has close so can't register anymore
        if ($event->start_date && $event->end_date < date("Y-m-d")) {
            abort(400, 'Event ended');
        }

        $errors = [];

        // If event ask user to answer question, then check errors first
        $event->registrantQuestions->each(function ($question, $index) use ($request, &$errors) {
            $answer = $request->get('q' . (string) ($index + 1));

            if ($answer == null) {
                $errors['q' . ($index + 1)] = 'Question is required';
                return;
            }
        });

        // If their was an error redirect back with status error
        if (!empty($errors)) {
            return redirect()->back()->with('status', 'error')->withInput();
        }

        // If no error added it to database
        $event->registrantQuestions->each(function ($question, $index) use ($request) {
            $answer = $request->get('q' . (string) ($index + 1));
    
            $question = RegistrantQuestion::with('respondents')->find($question->id);
            $question->respondents()->attach(Auth::id(), ['answer' => $answer]);
        });

        $event->participants()->attach($user->id, ['created_at' => now(), 'updated_at' => now()]);

        $events = $user->joinedEvents()->get();

        return Redirect::route('orders', ['events' => $events]);
    }

    public function togglePublish(Organizer $organizer, Event $event)
    {
        // Toogle between publish and unpublish
        $event->is_published = !$event->is_published;
        $event->save();

        return redirect()->back();
    }

    public function addToCalendar(Event $event)
    {

        if (!$event->start_date && !$event->end_date) {
            abort(400, 'This event has not anounced the start date and end date yet');
        }

        $from = DateTime::createFromFormat('Y-m-d H:i:s', $event->start_date);
        $to = DateTime::createFromFormat('Y-m-d H:i:s', $event->end_date);

        $eventDetailUrl = route('event-detail', ['event' => $event]);

        $link = Link::create($event->event_name, $from, $to)
            ->description("Event detail here {$eventDetailUrl}")
            ->address($event->location);

        // Return in base64 format
        // dd($link->ics());

        $decodedData = base64_decode(explode(',', $link->ics())[1]);

        $headers = [
            'Content-Type' => 'text/calendar',
            'Content-Disposition' => 'attachment; filename="' . $event->id . '-calendar.ics"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        return Response::make($decodedData, 200, $headers);
    }

    public function createDraftEmail(Organizer $organizer, Event $event) {
        return view('organizer.event.participants.email', compact('organizer', 'event'));
    }

    public function storeAcceptedMail(Request $request, Organizer $organizer, Event $event) {
        $request->validate([
            'accepeted_email_subject' => ['required', 'string', 'min:1', 'max:255'],
            'accepeted_email_body' => ['required', 'min:8']
        ],[
            'accepeted_email_body.min' => 'The accepted email body is required'
        ]);

        $body = $request->get('accepeted_email_body');
        $subject = $request->get('accepeted_email_subject');

        $event->accepeted_email_subject = $subject;
        $event->accepeted_email_body = $body;
        $event->save();
        
        return redirect()->back()->with('status', 'updated');
    }

    public function storeRejectedMail(Request $request, Organizer $organizer, Event $event) {
        $request->validate([
            'rejected_email_subject' => ['required', 'string', 'min:1', 'max:255'],
            'rejected_email_body' => ['required', 'min:8']
        ], [
            'rejected_email_body.min' => 'The rejected email body is required'
        ]);

        $body = $request->get('rejected_email_body');
        $subject = $request->get('rejected_email_subject');

        $event->rejected_email_subject = $subject;
        $event->rejected_email_body = $body;
        $event->save();
        
        return redirect()->back()->with('status', 'updated');
    }

    private function replaceSpecialSymbol($text, $user, $event) {
        $text = str_replace("{ user.name }", $user->name, $text);
        $text = str_replace("{ event.name }", $event->event_name, $text);
        $text = str_replace("{ event.start_date }", $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') : "To be announced", $text);
        $text = str_replace("{ event.end_date }", $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') :"To be announced", $text);
        $text = str_replace("{ event.location }", $event->location ? $event->location : "To be announced", $text);
        $text = str_replace("{ event.organizer_name }", $event->organizer->organizer_name, $text);

        return $text;
    }

}

/* 
{ user.name }

{ event.name }

{ event.start_date }

{ event.end_date }

{ event.location }
*/