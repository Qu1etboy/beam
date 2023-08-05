@extends('layouts.organizer')

@section('title', 'Create Event - Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Create New Event</h1>
    <p class="text-gray-600">Create your new event. Manage with your team, and publish to the world!</p>

    {{-- TODO: change to a real route --}}
    <form action="{{ route('organizer.store-event', $organizer) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="my-6">
        <x-input-label for="name" :value="__('Event name')"/>
        <x-text-input id="name" name="name" placeholder="Enter your event name" />
        <x-input-error :messages="[]" />
        <p class="text-sm text-gray-600 mt-2">After creating an event. You can go to the Event Information page to edit your event information. Don't worry you can change it later.</p>
      </div>

      <x-buttons.primary type="submit" class="w-full">Create new event</x-buttons.primary> 
    </form>

</div>
@endsection