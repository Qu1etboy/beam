@extends('layouts.event')

@section('title', 'Participants - Beam Organizer')

@section('content')
<div class="p-3">
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Participants</h1>
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
      <ul class="flex flex-wrap -mb-px">
          <li class="mr-2">
              <a href="{{ route('organizer.event.participants.submission', ['organizer' => $organizer, 'event' => $event]) }}" class="inline-block p-4 text-purple-600 border-purple-600 border-b-2 rounded-t-lg">Submission</a>
          </li>
          <li class="mr-2">
              <a href="{{ route('organizer.event.participants.accepted', ['organizer' => $organizer, 'event' => $event]) }}" class="inline-block p-4 hover:text-gray-600 hover:border-gray-300 border-transparent marker:border-b-2 rounded-t-lg active" aria-current="page">Accepted</a>
          </li>
      </ul>
    </div>

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
        @foreach($participants as $participant)
          <tr>
            <td class="px-6 py-3">
              <x-user-avatar :profile_url="$participant->avatar" class="h-10 w-10" />
            </td>
            <td class="px-6 py-3">{{ $participant->name }}</td>
            <td class="px-6 py-3">{{ $participant->email }}</td>
            <td class="flex items-center gap-2 px-6 py-3">
              <form action="{{ route('organizer.event.set-participants-status', ['organizer' => $organizer, 'event' => $event])}}" method="POST"> 
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $participant->id }}"/>
                <input type="hidden" name="status" value="ACCEPTED"/>
                <button type="submit" class="bg-green-500 hover:bg-green-600 duration-300 rounded-lg px-3 py-2 text-gray-100">Accept</button>
              </form>
              <form action="{{ route('organizer.event.set-participants-status', ['organizer' => $organizer, 'event' => $event])}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $participant->id }}"/>
                <input type="hidden" name="status" value="REJECTED"/>
                <button class="bg-red-500 hover:bg-red-600 duration-300 rounded-lg px-3 py-2 text-gray-100">Reject</button>
              </form>
            </td>
          </tr>  
        @endforeach
      </tbody>
    </table>
</div>
@endsection