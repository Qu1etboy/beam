@extends('layouts.task')

@section('sub-content')
  <div>
    <h1 class="font-bold text-4xl my-3">Add Task</h1>
    
    <form>
      <div class="mb-6">
        <label for="task" class="block mb-2 text-sm font-medium text-gray-900">Task name</label>
        <input type="text" id="task" placeholder="Enter task name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
      </div>
      <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Task description</label>
        <textarea type="text" id="description" placeholder="Enter task description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
      </div>
      <div class="mb-6">
        <label for="due-date" class="block mb-2 text-sm font-medium text-gray-900">Due date</label>
        <input type="date" id="due-date" placeholder="Enter due date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>
      <div class="mb-6">
        <label for="assign" class="block mb-2 text-sm font-medium text-gray-900">Assign</label>
        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          <option selected>Choose a member</option>
          <option value="1">User 1</option>
          <option value="2">User 2</option>
          <option value="3">User 3</option>
          <option value="4">User 4</option>
        </select>
      </div>
        <div class="mb-6">
        <label for="priority" class="block mb-2 text-sm font-medium text-gray-900">Task Priority</label>
        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          <option selected>Choose a priority</option>
          <option value="LOW">Low</option>
          <option value="MEDIUM">Medium</option>
          <option value="HIGH">High</option>
        </select>
      </div>

      <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add</button>
    </form>
  
  </div>
@endsection

