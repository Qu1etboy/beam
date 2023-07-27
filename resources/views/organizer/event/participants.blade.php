@extends('layouts.event')

@section('sub-content')
<div class="p-3">
    <h1 class="font-bold text-4xl my-3">Participants</h1>
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
      <ul class="flex flex-wrap -mb-px">
          <li class="mr-2">
              <a href="#" class="inline-block p-4 text-blue-600 border-blue-600 border-b-2 rounded-t-lg">Submission</a>
          </li>
          <li class="mr-2">
              <a href="#" class="inline-block p-4 hover:text-gray-600 hover:border-gray-300 border-transparent marker:border-b-2 rounded-t-lg active" aria-current="page">Accepted</a>
          </li>
      </ul>
    </div>

    @if(true)
      <table class="w-full">
        <thead class="bg-gray-50 text-left">
          <tr>
            <th class="px-6 py-3">Avatar</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 0; $i < 3; $i++)
            <tr>
              <td class="px-6 py-3">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=928&q=80" alt="user avatar" class="h-10 w-10 rounded-full object-cover">
              </td>
              <td class="px-6 py-3">Weerawong Vonggatunyu</td>
              <td class="px-6 py-3">weerawong.v@ku.th</td>
              <td>
                <button class="bg-green-500 hover:bg-green-600 duration-300 rounded-lg px-3 py-2 text-gray-100">Accept</button>
                <button class="bg-red-500 hover:bg-red-600 duration-300 rounded-lg px-3 py-2 text-gray-100">Decline</button>
              </td>
            </tr>  
          @endfor
        </tbody>
      </table>
    @else 
       <table class="w-full">
        <thead class="bg-gray-50 text-left">
          <tr>
            <th class="px-6 py-3">Avatar</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Email</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 0; $i < 3; $i++)
            <tr>
              <td class="px-6 py-3">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=928&q=80" alt="user avatar" class="h-10 w-10 rounded-full object-cover">
              </td>
              <td class="px-6 py-3">Weerawong Vonggatunyu</td>
              <td class="px-6 py-3">weerawong.v@ku.th</td>
            </tr>  
          @endfor
        </tbody>
      </table>
    @endif


</div>
@endsection