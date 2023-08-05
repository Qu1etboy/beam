@extends('layouts.organizer')

@section('title', 'Members - Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl mt-3 mb-6">Your Members</h1>

    <form action="{{ route('organizer.add-member', $organizer) }}" method="POST" class="mb-8">
      @csrf
      <div class="mb-6 w-full">
        <x-input-label for="email" :value="__('Invite member to your organization')" />
        <div class="flex gap-3 items-center">
          <x-text-input type="email" id="email" name="email" placeholder="Email" class="mb-2.5"/>
          <x-buttons.primary type="submit">Invite</x-buttons.primary> 
        </div>
        <x-input-error :messages="[]" />
      </div>
    </form>

    <div class="space-y-5">
      <div class="flex items-center justify-between gap-3 border-b pb-5 pr-3">
          <div class="flex items-center gap-3">
            <x-user-avatar :profile_url="$organizer->owner->avatar" class="w-10 h-10"/>
            <div>
              <p>
                {{ $organizer->owner->name }}
                <span class="ml-2 bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Owner</span>
              </p>
              <p class="text-sm text-gray-500">{{ $organizer->owner->email }}</p>
            </div>
          </div>
          <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                  <button>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal text-gray-800"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                  </button>
              </x-slot>

              <x-slot name="content">            
                  <x-dropdown-link class="text-red-500 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    Remove member
                  </x-dropdown-link>
              </x-slot>
          </x-dropdown>
      </div> 
      @foreach($members as $member)
        <div class="flex items-center justify-between gap-3 border-b pb-5 pr-3">
          <div class="flex items-center gap-3">
            <x-user-avatar :profile_url="$member->avatar" class="w-10 h-10"/>
            <div>
              <p>
                {{ $member->name }}
                <span class="ml-2 bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Member</span>
              </p>
              <p class="text-sm text-gray-500">{{ $member->email }}</p>
            </div>
          </div>
          <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                  <button>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal text-gray-800"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                  </button>
              </x-slot>

              <x-slot name="content">            
                <x-dropdown-link class="text-red-500 flex items-center gap-2">
                    <form action="{{ route('organizer.remove-member', ['organizer' => $organizer, 'user' => $member]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            Remove member
                        </button>
                    </form>
                </x-dropdown-link>
              </x-slot>
          </x-dropdown>
        </div> 
      @endforeach
    </div>

    {{-- <table class="w-full">
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
    
    </table> --}}

</div>
@endsection