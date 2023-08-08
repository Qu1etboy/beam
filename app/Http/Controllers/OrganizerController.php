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
        // Get the organizations owned by the user
        $organizations = $user->organizations;
        // Get the organizations the user has joined
        $joinedOrganizations = $user->joinedOrganizations;
        // if you are owner of joinedOrganizations, remove it from the joinedOrganizations
        foreach ($joinedOrganizations as $joinedOrganization) {
            if ($joinedOrganization->owner_id == $user->id) {
                $joinedOrganizations->forget($joinedOrganizations->search($joinedOrganization));
            }
        } 
        // Merge the two collections
        $allOrganizations = $organizations->concat($joinedOrganizations);
        return view('organizer.home', compact('allOrganizations'));
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
            'name' => ['required', 'string', 'min:1', 'max:255']
        ]);
        
        $user = User::find(Auth::id());
        $organization = new Organizer;
        $organization->organizer_name = $request->get('name');
        $organization->owner_id = $user->id;
        $organization->save();
        // also owner is a member
        $organization->members()->attach($user);

        return redirect()->route('organizer.home');
    }

    /**
     * Display a listing of the events.
     */
    public function events(Organizer $organizer)
    {
        $events = $organizer->events;
        return view('organizer.events', compact('events', 'organizer'));
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
            'name' => ['required', 'string', 'min:1', 'max:1024']
        ]);

        $event = new Event;
        $event->event_name = $request->get('name');

        $organizer->events()->save($event);
        $events = $organizer->events;
        // Redirect back with success message
        return redirect()->route('organizer.event.information', compact('event', 'organizer'))->with('success', 'Event successfully created.');
    }

    /**
     * Display a listing of the organizer members.
     */
    public function members(Organizer $organizer)
    {
        $members = $organizer->members;
        // if you are owner of members, remove it from the members
        foreach ($members as $member) {
            if ($member->id == $organizer->owner_id) {
                $members->forget($members->search($member));
            }
        }
        return view('organizer.members', compact('members', 'organizer'));
    }

    /**
     * Add a new member to the organizer by email.
     */
    public function addMember(Request $request, Organizer $organizer)
    {
        // Find the user by email
        $user = User::where('email', $request->get('email'))->first();
        // Check if the user is already a member of the organizer
        if ($organizer->members->contains($user)) {
            // Redirect back with error if the user is already a member
            return redirect()->back()->with('error', 'This user is already a member of the organizer.');
        }
        // Add the user to the members of the organizer
        $organizer->members()->attach($user);
        // Redirect back with success message
        return redirect()->back()->with('success', 'Member successfully added.');
    }

    /**
     * Remove the specified member from the organizer.
     */
    public function removeMember(Organizer $organizer, User $user)
    {
        // Check if the user is the owner of the organizer
        if ($user->id == $organizer->owner_id) {
            // Redirect back with error if the user is the owner
            return redirect()->back()->with('error', 'You cannot remove the owner of the organizer.');
        }
        // Remove the user from the members of the organizer
        $organizer->members()->detach($user);
        // Redirect back with success message
        return redirect()->back()->with('success', 'Member successfully removed.');
    }
}