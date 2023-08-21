@extends('layouts.task')

@section('title', 'Add ' . $event->event_name . "'s " . 'Task - Beam Organizer')

@section('sub-content')
  <div>
    <a href="{{ route('organizer.event.tasks.list',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
      Back
    </a>

    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Add Task</h1>
    
    <form action="{{ route('task.store', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
      @csrf
      <div class="mb-6">
        <x-input-label for="title" :value="__('Task name')"/>
        <x-text-input type="text" id="title" name="title" value="{{ old('title', '') }}" placeholder="Enter task name" />
        @error('title')
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-md shadow-md text-white text-sm animate-pulse">
                {{$message}}
            </div>
        @enderror
      </div>
      <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Task description</label>
        <textarea type="text" id="description" name="description" placeholder="Enter task description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">{{ old('description', '') }}</textarea>
        @error('description')
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-md shadow-md text-white text-sm animate-pulse">
                {{$message}}
            </div>
        @enderror
      </div>
      <div class="mb-6">
        <x-input-label for="due_date" :value="__('Due date')"/>
        <x-text-input type="date" id="due_date" name="due_date" value="{{ old('due_date', '') }}" placeholder="Enter due date" />
        @error('due_date')
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-md shadow-md text-white text-sm animate-pulse">
                {{$message}}
            </div>
        @enderror
      </div>
      
      <!-- Select Members -->
      <div
        x-data="multiselect(
        { 
          items: @js($organizer->members->map(function($member) {
            return ['label' => $member->name, 'value' => $member->id];
          })), 
          size: @js($organizer->members->count()),
          searchPlaceholder: 'Select members',
        })"
        x-init="onInit"
        @focusout="handleBlur"
        class="relative mb-6"
      >
        <input type="hidden" name="selected_members" x-bind:value="JSON.stringify(selectedItems.map(item => item.value))">
        <x-input-label for="due_date" :value="__('Assign member')"/>
        
        <!-- Start Item Tags And Input Field -->
        <div
          class="bg-gray-50 border border-gray-300 text-gray-900 flex items-center justify-between rounded-lg relative pr-8"
        >
          <ul class="flex flex-wrap items-center w-full">
            <!-- Tags (Selected) -->
            <template x-for="(selectedItem, idx) in selectedItems">
              <li
                x-text="shortenedLabel(selectedItem.label, maxTagChars)"
                @click="removeElementByIdx(idx)"
                @keyup.backspace="removeElementByIdx(idx)"
                @keyup.delete="removeElementByIdx(idx)"
                tabindex="0"
                class="relative m-1 px-2 py-1.5 border rounded-md text-sm cursor-pointer hover:bg-gray-100 after:content-['x'] after:ml-1.5 after:text-red-500 outline-none focus:outline-none ring-0 focus:ring-2 focus:ring-purple-300 ring-inset transition-all"
              ></li>
            </template>

            <!-- Search Input -->
            <input
              x-ref="searchInput"
              x-model="search"
              @click="expanded = true"
              @focusin="expanded = true"
              @input="expanded = true"
              @keyup.arrow-down="expanded = true; selectNextItem()"
              @keyup.arrow-up="expanded = true; selectPrevItem()"
              @keyup.escape="reset"
              @keyup.enter="addActiveItem"
              :placeholder="searchPlaceholder"
              type="text"
              class="flex-grow p-2.5 text-sm border-none outline-none focus:outline-none focus:ring-0 rounded-md w-24"
            />

            <!-- Arrow Icon -->
            <svg
              @click="expanded = !expanded; expanded && $refs.searchInput.focus()"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              stroke-width="0"
              fill="#ccc"
              :class="expanded && 'rotate-180'"
              class="absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer focus:outline-none"
              tabindex="-1"
            >
              <path
                d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"
              />
            </svg>
          </ul>
        </div>
        <!-- End Item Tags And Input Field -->

        <!-- Start Items List -->
        <template x-if="expanded">
          <ul
            x-ref="listBox"
            class="w-full list-none border border-t-0 text-sm rounded-md focus:outline-none overflow-y-auto outline-none bg-white absolute left-0 bottom-100"
            tabindex="0"
            :style="listBoxStyle"
          >
            <!-- Item Element -->
            <template x-if="filteredItems.length">
              <template x-for="(filteredItem, idx) in filteredItems">
                <li
                  x-text="shortenedLabel(filteredItem.label, maxItemChars)"
                  @click="handleItemClick(filteredItem)"
                  :class="idx === activeIndex && 'bg-amber-200'"
                  :title="filteredItem.label"
                  class="hover:bg-gray-100 cursor-pointer px-2 py-2"
                ></li>
              </template>
            </template>

            <!-- Empty Text -->
            <template x-if="!filteredItems.length">
              <li
                x-text="emptyText"
                class="cursor-pointer px-2 py-2 text-gray-400"
              ></li>
            </template>
          </ul>
        </template>
        <!-- End Items List -->

      
        @error('selected_members')
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-md shadow-md text-white text-sm animate-pulse">
                {{$message}}
            </div>
        @enderror
      </div>

      <div class="mb-6">
        <label for="priority" class="block mb-2 text-sm font-medium text-gray-900">Task Priority</label>
        <select id="priority" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5">
          <option selected>Choose a priority</option>
          <option value="{{ \App\Models\Task::PRIORITY_LOW }}">Low</option>
          <option value="{{ \App\Models\Task::PRIORITY_MEDIUM }}">Medium</option>
          <option value="{{ \App\Models\Task::PRIORITY_HIGH }}">High</option>
        </select>
        @error('priority')
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-md shadow-md text-white text-sm animate-pulse">
                {{$message}}
            </div>
        @enderror
      </div>

      <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add</button>
    </form>

  </div>
@endsection

