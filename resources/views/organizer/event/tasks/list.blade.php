@extends('layouts.task')

@section('title', 'Tasks - Beam Organizer')

@section('sub-content')
    <div>
        <h1 class="font-bold text-4xl my-3">List</h1>

        {{-- @if ($tasks->isNotEmpty()) --}}
        <table class="w-full">
            <thead class="text-left border-b">
                <tr>
                    <th class="px-6 py-3">Task</th>
                    <th class="px-6 py-3">Assignees</th>
                    <th class="px-6 py-3">Due date</th>
                    <th class="px-6 py-3">Priority</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="px-6 py-3">
                            <div class="flex gap-3">
                                <div>
                                    {{ $task->title }}
                                </div>
                                <a href="{{ route('task.edit', ['organizer' => $organizer, 'event' => $event, 'task' => $task]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24
                                    24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-pen-square">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0
                                    2-2v-7" />
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z" />
                                    </svg>
                                </a>

                                <!-- Display task status -->
                                @if ($task->status == \App\Models\Task::STATUS_TODO)
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Todo</span>
                                @elseif ($task->status == \App\Models\Task::STATUS_DOING)
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Doing</span>
                                @else
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Done</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex -space-x-4 mt-3">
                                <!-- Display task assignees -->
                                @foreach ($task->assignees->take(2) as $assignee)
                                    <img class="w-8 h-8 border-2 border-white rounded-full"
                                        src="{{ file_exists('storage/' . $assignee->avatar) ? asset('storage/' . $assignee->avatar) : $assignee->avatar }}"
                                        alt="{{ $assignee->name }}">
                                @endforeach
                                @if ($task->assignees->count() > 2)
                                    <span
                                        class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600">
                                        +{{ $task->assignees->count() - 2 }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-3">
                            <!-- Display task priority -->
                            @if ($task->priority == \App\Models\Task::PRIORITY_LOW)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Low</span>
                            @elseif ($task->priority == \App\Models\Task::PRIORITY_MEDIUM)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Medium</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">High</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-more-horizontal">
                                            <circle cx="12" cy="12" r="1" />
                                            <circle cx="19" cy="12" r="1" />
                                            <circle cx="5" cy="12" r="1" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Mark task as different status -->
                                    <x-dropdown-link>
                                        <form method="POST"
                                            action="{{ route('organizer.event.tasks.update', ['organizer' => $organizer->id, 'event' => $event->id, 'task' => $task->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"
                                                value="{{ \App\Models\Task::STATUS_TODO }}">
                                            <button type="submit" class="w-full flex justify-start">Mark as
                                                Todo</button>
                                        </form>
                                    </x-dropdown-link>

                                    <x-dropdown-link>
                                        <form method="POST"
                                            action="{{ route('organizer.event.tasks.update', ['organizer' => $organizer->id, 'event' => $event->id, 'task' => $task->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"
                                                value="{{ \App\Models\Task::STATUS_DOING }}">
                                            <button type="submit" class="w-full flex justify-start">Mark as
                                                Doing</button>
                                        </form>
                                    </x-dropdown-link>

                                    <x-dropdown-link>
                                        <form method="POST"
                                            action="{{ route('organizer.event.tasks.update', ['organizer' => $organizer->id, 'event' => $event->id, 'task' => $task->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"
                                                value="{{ \App\Models\Task::STATUS_DONE }}">
                                            <button type="submit" class="w-full flex justify-start">Mark as
                                                Done</button>
                                        </form>
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
        {{-- @else
          <section class="text-center mt-16">
            <img src="/_static/undraw_partying.svg" class="mx-auto" width="300"/>
            <p class="my-8">Hooray! you have no tasks. Let's party!</p>
          </section>
        @endif  --}}

    </div>
@endsection
