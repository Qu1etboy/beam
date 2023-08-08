@extends('layouts.event')

@section('content')
<div class="p-4">
    <nav class="flex items-center justify-between gap-5 border rounded-lg w-full p-3 mb-8">
        <div class="space-x-5">
            <a href="{{ route('organizer.event.tasks.list', ['organizer' => $organizer->id, 'event' => $event->id]) }}"
                class="hover:text-purple-500 duration:300 ml-4">List</a>
            <a href="{{ route('organizer.event.tasks.board', ['organizer' => $organizer->id, 'event' => $event->id]) }}"
                class="hover:text-purple-500 duration:300">Board</a>
        </div>
        <a href="{{ route('task.create', ['organizer' => $organizer->id, 'event' => $event->id]) }}"
            class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 ">Add
            Task</a>
    </nav>
    @yield('sub-content')
</div>
@endsection
