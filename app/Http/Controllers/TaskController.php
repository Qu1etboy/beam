<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display the board of tasks for a given event.
     */
    public function board(Organizer $organizer, Event $event)
    {
        // Ensure that the organizer owns the event
        if ($organizer->id !== $event->organizer_id) {
            return redirect()->route('organizer.home');
        }

        $tasks = $event->tasks;
        return view('organizer.event.tasks.board', compact('organizer', 'event', 'tasks'));
    }

    /**
     * Display a list of tasks for a given event.
     */
    public function list(Organizer $organizer, Event $event)
    {
        // Ensure that the organizer owns the event
        if ($organizer->id !== $event->organizer_id) {
            return redirect()->route('organizer.home');
        }

        $tasks = $event->tasks;
        return view('organizer.event.tasks.list', compact('organizer', 'event', 'tasks'));
    }

    /**
     * Store a newly created task for the given event.
     */
    public function add(Request $request, Organizer $organizer, Event $event)
    {
        // Ensure that the organizer owns the event
        if ($organizer->id !== $event->organizer_id) {
            return redirect()->route('organizer.home');
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|integer|between:1,3',
            'due_date' => 'required|date',
        ]);

        $task = new Task($validatedData);
        $event->tasks()->save($task);

        return redirect()->route('organizer.event.dashboard', ['organizer' => $organizer->id, 'event' => $event->id]);
    }
}
