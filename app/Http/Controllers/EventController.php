<?php

namespace App\Http\Controllers;

use App\Mail\Mail;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validatedData = $request->validate([
            'event_name' => ['required', 'string', 'min:1', 'max:1024'],
            'event_description' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date', 'after:tomorrow'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'location' => ['nullable', 'string'],
        ]);

        $file = $request->file('poster');

        // If user upload a new poster store in storage and update.
        if ($file) {
            $poster_path = $file->store('posters', 'public');
            $event->poster_image = $poster_path;
            $event->save();
        }

        // $poster_path = $request->file('poster')->store('posters', 'public');

        Event::where('id', $event->id)->update($validatedData);

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
        
        $event->participants()->sync([$user_id => ['status' => $status]]);

        if ($status == "ACCEPTED") {
            // TODO: sent email to users that they got accepted
            //Mail::to($user)->send(new Mail($user));
        } else {
            // TODO: sent email to users that they got rejected
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
        
        // This event has started or the application has close so can't register anymore
        if ($event->start_date < date("Y-m-d")) {
            abort(400, 'The application period has closed.');
        }

        // If event ask user to answer question add it
        if (!$event->registrantQuestions()->count() > 0) {
            // TODO: add registrant question
        }

        $event->participants()->attach($user->id);

        $events = $user->joinedEvents()->get();
        
        return view('orders', compact('events'));
    }

    public function togglePublish(Organizer $organizer, Event $event)
    {
        // Toogle between publish and unpublish
        $event->is_published = !$event->is_published;
        $event->save();

        return redirect()->back();
    }
}