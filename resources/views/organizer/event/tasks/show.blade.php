@extends('layouts.task')

@section('title', $task->title . ' - ' . $event->event_name . "'s " . 'Tasks - Beam Organizer')

@section('sub-content')
  <div>
    {{-- <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3"></h1> --}}
    
    <a href="{{ url()->previous() }}" class="flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
      Back
    </a>
    
    <section class="my-3">
      <h2 class="text-xl sm:text-2xl md:text-3xl">
        {{ $task->title }}
        <a href="{{ route('task.edit', ['organizer' => $organizer, 'event' => $event, 'task' => $task]) }}" title="Edit task">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24
          24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="lucide lucide-pen-square inline-block">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0
          2-2v-7" />
              <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z" />
          </svg>
        </a> 
      </h2>
      <p class="text-sm text-gray-600 my-1">Due date: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
      
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
    </section>
    
    <p>{{ $task->description }}</p>


    <div class="flex -space-x-4 mt-3">
        <!-- Display task assignees -->
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
@endsection

