@extends('layouts.task')

@section('title', 'Tasks - Beam Organizer')

@section('sub-content')
  <div>
    <h1 class="font-bold text-4xl my-3">Add Task</h1>
    
    <form action="{{ route('organizer.event.tasks.store', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
      @csrf
      <div class="mb-6">
        <x-input-label for="title" :value="__('Task name')"/>
        <x-text-input type="text" id="title" name="title" placeholder="Enter task name" />
        <x-input-error :messages="[]" />
      </div>
      <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Task description</label>
        <textarea type="text" id="description" name="description" placeholder="Enter task description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required></textarea>
        <x-input-error :messages="[]" />
      </div>
      <div class="mb-6">
        <x-input-label for="due_date" :value="__('Due date')"/>
        <x-text-input type="date" id="due_date" name="due_date" placeholder="Enter due date" />
        <x-input-error :messages="[]" />
      </div>
      <div class="mb-6">
        <label for="assign" class="block mb-2 text-sm font-medium text-gray-900">Assign</label>
        <select id="countries" name="member_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
          <option selected>Choose a member</option>
          {{-- <option value="1">User 1</option>
          <option value="2">User 2</option>
          <option value="3">User 3</option>
          <option value="4">User 4</option> --}}
          @foreach ($organizer->members as $member)
          {{-- <input type="checkbox" id="member" name="member" value="{{ $member->id }}">
          <label for="member">{{ $member->name }}</label><br> --}}
          <option value="{{ $member->id }}">{{ $member->name }}</option>
          @endforeach
        </select>
        <x-input-error :messages="[]" />
      </div>
        <div class="mb-6">
        <label for="priority" class="block mb-2 text-sm font-medium text-gray-900">Task Priority</label>
        <select id="countries" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
          <option selected>Choose a priority</option>
          <option value="{{ \App\Models\Task::PRIORITY_LOW }}">Low</option>
          <option value="{{ \App\Models\Task::PRIORITY_MEDIUM }}">Medium</option>
          <option value="{{ \App\Models\Task::PRIORITY_HIGH }}">High</option>
        </select>
        <x-input-error :messages="[]" />
      </div>

      <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add</button>
    </form>
  
  </div>
@endsection

