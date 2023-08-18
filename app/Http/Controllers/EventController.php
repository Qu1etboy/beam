<?php

namespace App\Http\Controllers;

use App\Mail\AcceptedMail;
use App\Mail\RejectedMail;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\RegistrantQuestion;
use App\Models\User;
use \Datetime;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
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
        $events = Event::where('is_published', true)->paginate(10);
        return view('index', compact('events'));
    }

    public function search(Request $request) {
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
     * Show the dashboard for the given event.
     */
    public function dashboard(Organizer $organizer, Event $event)
    {
        return view('organizer.event.dashboard', compact('organizer', 'event'));
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
            'event_name' => ['required', 'string', 'min:1', 'max:1024'],
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

        return redirect()->back();
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
    public function setParticipantStatus(Request $request, Organizer $organizer, Event $event) {
        $user_id = $request->get('user_id');
        $status = $request->get('status');

        $user = User::find($user_id);
        
        $event->participants()->sync([$user_id => ['status' => $status]]);

        if ($status == "ACCEPTED") {
            // Sent email to users that they got accepted
            Mail::to($user->email)->send(new AcceptedMail($user,$event));
        } else {
            // Sent email to users that they got rejected
            Mail::to($user->email)->send(new RejectedMail($user,$event));

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

        // If event ask user to answer question add it
        $event->registrantQuestions->each(function ($question, $index) use ($request) {
            $answer = $request->get('q' . (string) ($index + 1));

            // dd($question);

            if ($answer == null) {
                return abort(400, 'Questions is required');
            }

            $question = RegistrantQuestion::with('respondents')->find($question->id);
            $question->respondents()->attach(Auth::id(), ['answer' => $answer]);

        });

        $event->participants()->attach($user->id);

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

    public function addToCalendar(Event $event) {

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
}