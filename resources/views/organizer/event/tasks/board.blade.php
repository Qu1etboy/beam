@extends('layouts.task')

@section('sub-content')
  <div>
    <h1 class="font-bold text-4xl my-3">Board</h1>
    
    <!-- Desktop Board -->
    <div class="hidden sm:block">
      <div class="grid grid-cols-3 gap-x-5">

        <!-- Todo -->
        <div>
          <h2 class="text-xl m-3 font-bold">Todo</h2>
          <div class="space-y-3">
              <x-task-card />
          </div>
        </div> 

        <!-- Doing -->
        <div>
          <h2 class="text-xl m-3 font-bold">Doing</h2>

          <div class="space-y-3">

            @for($i = 0; $i < 3; $i++)
              <x-task-card />
            @endfor

          </div>

        </div>

        <!-- Done -->
        <div>
          <h2 class="text-xl m-3 font-bold">Done</h2>
          <div class="space-y-3">
            @for($i = 0; $i < 2; $i++)
              <x-task-card />
            @endfor
          </div>
        </div>

      </div>
    </div>

    <!-- Mobile Board -->

    <div class="block sm:hidden">
      <!-- Status Tab -->
      <div class="flex gap-1 mb-5">
        <!-- Active -->
        <button type="button" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">Todo</button>
        <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">Doing</button>
        <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">Done</button>
      </div>

      <!-- Tasks -->
      <div class="space-y-3">
        @for($i = 0; $i < 2; $i++)
          <x-task-card />
        @endfor
      </div>
    
    </div>

  </div>
@endsection

