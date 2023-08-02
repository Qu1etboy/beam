<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    /**
     * Display the organizer home page.
     */
    public function home()
    {
        $user = User::find(Auth::id());
        $organizations = $user->organizations;
        return view('organizer.home', compact('organizations'));
    }

    /**
     * Show the form for creating a new organization.
     */
    public function createOrganization()
    {
        return view('organizer.create-organization');
    }

    /**
     * Store a newly created organization in storage.
     */
    public function storeOrganization(Request $request)
    {
        $request->validate([
            'organizer_name' => 'required|string|max:255',
        ]);
        $user = User::find(Auth::id());
        $organization = new Organizer;
        $organization->organizer_name = $request->organizer_name;
        $organization->owner_id = $user->id;
        $organization->save();

        return redirect()->route('organizer.home');
    }

    /**
     * Display a listing of the events.
     */
    public function events(Organizer $organizer)
    {
        $events = $organizer->events;
        return view('organizer.events', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function createEvent(Organizer $organizer)
    {
        return view('organizer.create-event', compact('organizer'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function storeEvent(Request $request, Organizer $organizer)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            // Add other event fields here as needed
        ]);

        $event = new Event;
        $event->event_name = $request->event_name;
        // Add other event fields here as needed
        $event->organizer_id = $organizer->id;
        $event->save();

        return redirect()->route('organizer.events', ['organizer' => $organizer->id]);
    }

    /**
     * Display a listing of the organizer members.
     */
    public function members(Organizer $organizer)
    {
        $members = $organizer->members;
        return view('organizer.members', compact('members'));
    }
}