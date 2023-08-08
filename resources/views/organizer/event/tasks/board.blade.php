@extends('layouts.task')

@section('title', 'Tasks - Beam Organizer')

@section('sub-content')
    <div>
        <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Board</h1>

        <!-- Desktop Board -->
        <div class="hidden sm:block">
            <div class="grid grid-cols-3 gap-x-5">

                <!-- Todo -->
                <div>
                    <h2 class="text-xl m-3 font-bold">Todo</h2>
                    <div class="space-y-3">
                        @foreach ($tasksTodo as $task)
                            <x-task-card :task="$task" :organizer="$organizer" :event="$event" />
                        @endforeach
                    </div>
                </div>

                <!-- Doing -->
                <div>
                    <h2 class="text-xl m-3 font-bold">Doing</h2>

                    <div class="space-y-3">
                        @foreach ($tasksDoing as $task)
                            <x-task-card :task="$task" :organizer="$organizer" :event="$event" />
                        @endforeach
                    </div>

                </div>

                <!-- Done -->
                <div>
                    <h2 class="text-xl m-3 font-bold">Done</h2>
                    <div class="space-y-3">
                        @foreach ($tasksDone as $task)
                            <x-task-card :task="$task" :organizer="$organizer" :event="$event" />
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <!-- Mobile Board -->
        <div class="block sm:hidden" x-data="{ openTab: 'todo' }">
            <!-- Status Tab -->
            <div class="flex gap-1 mb-5">
                <button @click="openTab = 'todo'" type="button"
                    :class="{
                        'text-white bg-black hover:bg-gray-900 focus:ring-4 focus:ring-gray-300': openTab ===
                            'todo',
                        'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200': openTab !==
                            'todo'
                    }"
                    class="font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">Todo</button>
                <button @click="openTab = 'doing'" type="button"
                    :class="{
                        'text-white bg-black hover:bg-gray-900 focus:ring-4 focus:ring-gray-300': openTab ===
                            'doing',
                        'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200': openTab !==
                            'doing'
                    }"
                    class="font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">Doing</button>
                <button @click="openTab = 'done'" type="button"
                    :class="{
                        'text-white bg-black hover:bg-gray-900 focus:ring-4 focus:ring-gray-300': openTab ===
                            'done',
                        'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200': openTab !==
                            'done'
                    }"
                    class="font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">Done</button>
            </div>
            <!-- Tasks -->
            <div class="space-y-3">
                <div x-show="openTab === 'todo'">
                    @foreach ($tasksTodo as $task)
                        <div class="mb-3">
                            <x-task-card :task="$task" :organizer="$organizer" :event="$event" />
                        </div>
                    @endforeach
                </div>
                <div x-show="openTab === 'doing'">
                    @foreach ($tasksDoing as $task)
                        <div class="mb-3">
                            <x-task-card :task="$task" :organizer="$organizer" :event="$event" />
                        </div>
                    @endforeach
                </div>
                <div x-show="openTab === 'done'">
                    @foreach ($tasksDone as $task)
                        <div class="mb-3">
                            <x-task-card :task="$task" :organizer="$organizer" :event="$event" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>



    </div>
@endsection
