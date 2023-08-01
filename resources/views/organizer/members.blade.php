@extends('layouts.organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Your Members</h1>

    <form method="POST">
      @csrf
      <div class="mb-6 w-full">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Invite member</label>
        <div class="flex">
          <input type="email" id="email" placeholder="Email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-4">Invite</button>
        </div>
      </div>
    </form>

    <table class="w-full">
      <thead class="bg-gray-50 text-left">
        <tr>
          <th class="px-6 py-3">Avatar</th>
          <th class="px-6 py-3">Name</th>
          <th class="px-6 py-3">Email</th>
        </tr>
      </thead>

      <tbody>
        @for($i = 0; $i < 5; $i++)
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

</div>
@endsection