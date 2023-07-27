@extends('layouts.task')

@section('sub-content')
  <div>
    <h1 class="font-bold text-4xl my-3">List</h1>
    
    <table class="w-full">
      <thead class="text-left border-b">
        <tr>
          <th class="px-6 py-3">Task</th>
          <th class="px-6 py-3">Assginees</th>
          <th class="px-6 py-3">Due date</th>
          <th class="px-6 py-3">Priority</th>
          <th class="px-6 py-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @for($i = 0; $i < 3; $i++)
          <tr>
            <td class="px-6 py-3">
              Planning
              <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Doing</span>
            </td>
            <td class="px-6 py-3">
              <div class="flex -space-x-4 mt-3">
                <img class="w-8 h-8 border-2 border-white rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="">
                <img class="w-8 h-8 border-2 border-white rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="">
                <span class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600">+3</span>
              </div>
            </td>
            <td class="px-6 py-3">27 Jul 2023</td>
            <td class="px-6 py-3">
              <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Medium</span>
            </td>
            <td class="px-6 py-3">
               <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                      <button>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                      </button>
                  </x-slot>

                  <x-slot name="content">            
                      <x-dropdown-link>Mark as Todo</x-dropdown-link>
                      <x-dropdown-link>Mark as Doing</x-dropdown-link>
                      <x-dropdown-link>Mark as Done</x-dropdown-link>
                  </x-slot>
              </x-dropdown>
            </td>
          </tr>
        @endfor
      </tbody>
    </table>
    
  </div>
@endsection

