@extends('layouts.organizer')

@section('title', 'Members - Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Your Members</h1>

    <form action="{{ route('organizer.add-member', $organizer) }}" method="POST" class="mb-8">
      @csrf
      <div class="mb-6 w-full">
        <x-input-label for="email" :value="__('Invite member')" />
        <div class="flex">
          <x-text-input type="email" id="email" name="email" placeholder="Email" />
          <x-buttons.primary type="submit">Invite</x-buttons.primary> 
        </div>
        <x-input-error :messages="[]" />
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
        @foreach($members as $member)
          <tr>
            <td class="px-6 py-3">
              <img src="{{ file_exists('storage/' . $member->avatar) ? asset('storage/' . $member->avatar) : $member->avatar }}" alt="user avatar" class="h-10 w-10 rounded-full object-cover">
            </td>
            <td class="px-6 py-3">{{ $member->name }}</td>
            <td class="px-6 py-3">{{ $member->email }}</td>
          </tr>  
        @endforeach
      </tbody>
    
    </table>

</div>
@endsection