<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\User;
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
        $owner = $event->organizer->owner;
        return view('event-detail', ['event' => $event, 'owner' => $owner]);
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

    }

    /**
     * Display a listing of the participants for the given event.
     */
    public function participants(Organizer $organizer, Event $event)
    {
        $participants = $event->participants;
        return view('organizer.event.participants', compact('organizer', 'event', 'participants'));
    }

    /**
     * Display a listing of the participants for the given event.
     */
    public function togglePublish(Organizer $organizer, Event $event)
    {
        // Toogle between publish and unpublish
        $event->is_published = !$event->is_published;
        $event->save();

        return redirect()->back();
    }
}