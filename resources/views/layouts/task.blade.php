@extends('layouts.base')

@section('body')
  @include('layouts.subviews.organizer-navbar', ['organizer' => $organizer])
  <main>
    <div class="grid lg:grid-cols-5 w-full">
      @include('layouts.subviews.sidebar')
      <div class="p-4 col-span-4">

        <nav class="flex items-center justify-between gap-5 border rounded-lg w-full p-3 mb-8">
          <div class="space-x-5">
            <a href="{{ route('organizer.event.tasks.list') }}" class="hover:text-purple-500 duration:300">List</a>
            <a href="{{ route('organizer.event.tasks.board') }}" class="hover:text-purple-500 duration:300">Board</a>
          </div>
          <a href="{{ route('organizer.event.tasks.add') }}" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add Task</a>
        </nav>

        @yield('sub-content')
      </div>
    </div>
  </main>
@endsection 