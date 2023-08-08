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
                <x-input-error :messages="$errors->get('title')" />
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Task description</label>
                <textarea type="text" id="description" name="description" placeholder="Enter task description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5"
                    required>{{ old('description', $task->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" />

            </div>
            <div class="mb-6">
                <x-input-label for="due_date" :value="__('Due date')" />
                <x-text-input type="date" id="due_date" name="due_date" placeholder="Enter due date"
                    value="{{ old('due_date', $task->due_date) }}" />
                <x-input-error :messages="$errors->get('due_date')" />
            </div>
            
            <!-- Select Members -->
            <div
                x-data="multiselect(
                { 
                items: @js($organizer->members->map(function($member) {
                    return ['label' => $member->name, 'value' => $member->id];
                })), 
                size: @js($organizer->members->count()),
                selectedItems: @js($task->assignees->map(function($member) {
                    return ['label' => $member->name, 'value' => $member->id];
                })),
                searchPlaceholder: 'Select members',
                })"
                x-init="onInit"
                @focusout="handleBlur"
                class="relative mb-6"
            >
                <input type="hidden" name="selected_members" x-bind:value="JSON.stringify(selectedItems.map(item => item.value))">
                <x-input-label for="due_date" :value="__('Assignee member')"/>
                
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

                <x-input-error :messages="$errors->get('selected_members')" />
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
                <x-input-error :messages="$errors->get('priority')" />
            </div>

            <button type="submit"
                class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Save</button>
        </form>

    </div>
@endsection
