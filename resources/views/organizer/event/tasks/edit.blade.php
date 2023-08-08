@extends('layouts.task')

@section('title', 'Tasks - Beam Organizer')

@section('sub-content')
    <div>
        <div class="flex justify-between my-3">
            <h1 class="font-bold text-4xl ">Edit Task</h1>
            <form action="{{ route('task.destroy', ['organizer' => $organizer, 'event' => $event, 'task' => $task]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure you want to delete this task?');"
                    class="text-white bg-red-600 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                    Delete
                </button>
            </form>
        </div>

        <form action="{{ route('task.update', ['organizer' => $organizer, 'event' => $event, 'task' => $task]) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-label for="title" :value="__('Task name')" />
                <x-text-input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                    placeholder="Enter task name" />
                <x-input-error :messages="[]" />
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Task description</label>
                <textarea type="text" id="description" name="description" placeholder="Enter task description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5"
                    required>{{ old('description', $task->description) }}</textarea>
                <x-input-error :messages="[]" />

            </div>
            <div class="mb-6">
                <x-input-label for="due_date" :value="__('Due date')" />
                <x-text-input type="date" id="due_date" name="due_date" placeholder="Enter due date"
                    value="{{ old('due_date', $task->due_date) }}" />
                <x-input-error :messages="[]" />
            </div>
            <div class="mb-6">
                <label for="assign" class="block mb-2 text-sm font-medium text-gray-900">Assign</label>
                <select id="assign" name="member_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 ">
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
                <select id="priority" name="priority"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
                    <option value="">Choose a priority</option>
                    <option value="{{ \App\Models\Task::PRIORITY_LOW }}"
                        {{ old('priority', $task->priority) == \App\Models\Task::PRIORITY_LOW ? 'selected' : '' }}>
                        Low
                    </option>
                    <option value="{{ \App\Models\Task::PRIORITY_MEDIUM }}"
                        {{ old('priority', $task->priority) == \App\Models\Task::PRIORITY_MEDIUM ? 'selected' : '' }}>
                        Medium
                    </option>
                    <option value="{{ \App\Models\Task::PRIORITY_HIGH }}"
                        {{ old('priority', $task->priority) == \App\Models\Task::PRIORITY_HIGH ? 'selected' : '' }}>
                        High
                    </option>
                </select>
                <x-input-error :messages="[]" />
            </div>

            <button type="submit"
                class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add</button>
        </form>

    </div>
@endsection
