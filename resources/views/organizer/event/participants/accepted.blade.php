@extends('layouts.event')

@section('title', 'Participants - Beam Organizer')

@section('content')
<div class="p-3">
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Participants</h1>
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
      <ul class="flex flex-wrap -mb-px">
          <li class="mr-2">
              <a href="{{ route('organizer.event.participants.submission', ['organizer' => $organizer, 'event' => $event]) }}" class="inline-block p-4  hover:text-gray-600 hover:border-gray-300 border-transparent marker:border-b-2  rounded-t-lg">Submission</a>
          </li>
          <li class="mr-2">
              <a href="{{ route('organizer.event.participants.accepted', ['organizer' => $organizer, 'event' => $event]) }}" class="inline-block p-4 text-purple-600 border-purple-600  border-b-2 rounded-t-lg" aria-current="page">Accepted</a>
          </li>
      </ul>
    </div>

    <div class="overflow-x-auto overflow-y-clip">
      <table class="w-full">
        <thead class="bg-gray-50 text-left">
          <tr>
            <th class="px-6 py-3">Avatar</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Email</th>
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
            </tr>  
          @endforeach
        </tbody>
      </table>
    </div>


</div>
@endsection