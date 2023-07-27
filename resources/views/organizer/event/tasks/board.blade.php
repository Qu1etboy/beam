@extends('layouts.task')

@section('sub-content')
  <div>
    <h1 class="font-bold text-4xl my-3">Board</h1>
    

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
@endsection

