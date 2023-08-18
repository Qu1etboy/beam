@props(['task', 'organizer', 'event'])

<div class="relative block p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="absolute right-0 top-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-more-horizontal">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="19" cy="12" r="1" />
                    <circle cx="5" cy="12" r="1" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link>
                <form method="POST"
                    action="{{ route('organizer.event.tasks.update', ['organizer' => $organizer->id, 'event' => $event->id, 'task' => $task->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{ \App\Models\Task::STATUS_TODO }}">
                    <button type="submit" class="w-full flex justify-start">Mark as
                        Todo</button>
                </form>
            </x-dropdown-link>

            <x-dropdown-link>
                <form method="POST"
                    action="{{ route('organizer.event.tasks.update', ['organizer' => $organizer->id, 'event' => $event->id, 'task' => $task->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{ \App\Models\Task::STATUS_DOING }}">
                    <button type="submit" class="w-full flex justify-start">Mark as
                        Doing</button>
                </form>
            </x-dropdown-link>

            <x-dropdown-link>
                <form method="POST"
                    action="{{ route('organizer.event.tasks.update', ['organizer' => $organizer->id, 'event' => $event->id, 'task' => $task->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{ \App\Models\Task::STATUS_DONE }}">
                    <button type="submit" class="w-full flex justify-start">Mark as
                        Done</button>
                </form>
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>
    <div class="flex gap-3 mb-2">
        <a href="{{ route('task.show', ['organizer' => $organizer, 'event' => $event, 'task' => $task] ) }}" class=" text-xl font-bold tracking-tight text-gray-90">{{ $task->title }}</a>
        <a href="{{ route('task.edit', ['organizer' => $organizer, 'event' => $event, 'task' => $task] ) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24
                                    24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen-square">
                <path
                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0
                                    2-2v-7" />
                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z" />
            </svg>
        </a>
    </div>

    @if ($task->priority == \App\Models\Task::PRIORITY_LOW)
        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Low</span>
    @elseif ($task->priority == \App\Models\Task::PRIORITY_MEDIUM)
        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Medium</span>
    @else
        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">High</span>
    @endif

    <div class="flex justify-between">
        <!-- Due date -->
        <div class="flex mt-4 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-calendar-days">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                <line x1="16" x2="16" y1="2" y2="6" />
                <line x1="8" x2="8" y1="2" y2="6" />
                <line x1="3" x2="21" y1="10" y2="10" />
                <path d="M8 14h.01" />
                <path d="M12 14h.01" />
                <path d="M16 14h.01" />
                <path d="M8 18h.01" />
                <path d="M12 18h.01" />
                <path d="M16 18h.01" />
            </svg>
            <p class="font-normal text-sm text-gray-700">
                {{-- 27 Jul 2023 --}}
                {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
            </p>
        </div>
        <!-- Assginee-->
        <div class="flex -space-x-4 mt-3">
            @foreach ($task->assignees->take(2) as $assignee)
                <img class="w-8 h-8 border-2 border-white rounded-full"
                    src="{{ file_exists('storage/' . $assignee->avatar) ? asset('storage/' . $assignee->avatar) : $assignee->avatar }}"
                    alt="{{ $assignee->name }}" title="{{ $assignee->name }}">
            @endforeach
            @if ($task->assignees->count() > 2)
                <span
                    class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600">
                    +{{ $task->assignees->count() - 2 }}
                </span>
            @endif
        </div>
    </div>
</div>