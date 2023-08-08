<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display the board of tasks for a given event.
     */
    public function board(Organizer $organizer, Event $event)
    {
        $tasks = $event->tasks;
        $tasksTodo = $tasks->where('status', Task::STATUS_TODO);
        $tasksDoing = $tasks->where('status', Task::STATUS_DOING);
        $tasksDone = $tasks->where('status', Task::STATUS_DONE);
        return view('organizer.event.tasks.board', compact('organizer', 'event','tasksTodo', 'tasksDoing', 'tasksDone', 'tasks'));
    }

    /**
     * Display a list of tasks for a given event.
     */
    public function list(Organizer $organizer, Event $event)
    {
        $tasks = Task::where('event_id', $event->id)->paginate(8);
        return view('organizer.event.tasks.list', compact('organizer', 'event', 'tasks'));
    }

    /**
     * Update the status of a task.
     */
    public function updateStatus(Request $request, Organizer $organizer, Event $event, Task $task)
    {
        $newStatus = $request->get('status');
        if (!in_array($newStatus, [Task::STATUS_TODO, Task::STATUS_DOING, Task::STATUS_DONE])) {
            return back()->withErrors('Invalid status provided.');
        }
        $task = Task::find($task->id);
        $task->status = $newStatus;
        $task->save();
        return back()->with('status', 'Task status updated successfully!');
    }


    /**
     * Store a newly created task for the given event.
     */
    public function create(Organizer $organizer, Event $event)
    {
        return view('organizer.event.tasks.create', compact('organizer', 'event'));
    }

    /**
     * Store a newly created task for the given event.
     */
    public function store(Request $request, Organizer $organizer, Event $event)
    {
        $task = new Task;
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->status = Task::STATUS_TODO;
        $task->priority = $request->get('priority');
        $task->due_date = $request->get('due_date');
        $task->event_id = $event->id;
        $task->save();
        $task->assignees()->attach($request->get('member_id'));
        return redirect()->route('organizer.event.tasks.list', compact('organizer', 'event'))->with('status', 'Task added successfully!');
    }

    /**
     * Display edit form for a given task.
     */
    public function edit(Organizer $organizer, Event $event, Task $task)
    {
        return view('organizer.event.tasks.edit', compact('organizer', 'event', 'task'));
    }

    /**
     * Update a given task.
     */
    public function update(Request $request, Organizer $organizer, Event $event, Task $task)
    {
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->priority = $request->get('priority');
        $task->due_date = $request->get('due_date');
        $task->save();
        return redirect()->route('organizer.event.tasks.list', compact('organizer', 'event'))->with('status', 'Task updated successfully!');
    }

    public function destroy(Organizer $organizer, Event $event, Task $task)
    {
        $task->delete();
        return redirect()->route('organizer.event.tasks.list', compact('organizer', 'event'))->with('status', 'Task deleted successfully!');
    }
}
