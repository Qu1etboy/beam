<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::get();
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
        return view('event-detail', compact('event'));
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

    /**
     * Display a listing of the participants for the given event.
     */
    public function participants(Organizer $organizer, Event $event)
    {
        $participants = $event->participants;
        return view('organizer.event.participants', compact('organizer', 'event', 'participants'));
    }
}
