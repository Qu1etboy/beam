@extends('layouts.organizer')

@section('title', 'Create Event - Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Create New Event</h1>

    {{-- TODO: change to a real route --}}
    <form action="{{ route('organizer.store-event', $organizer) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <x-input-label for="name" :value="__('Event name')"/>
        <x-text-input id="name" name="name" placeholder="Enter your event name" />
        <x-input-error :messages="[]" />
      </div>

      <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Event description</label>
        <textarea id="description" class="ckeditor form-control" name="description"></textarea>
      </div>

      <div class="mb-6">
        <x-input-label for="address" :value="__('Event location')"/>
        <x-text-input id="address" name="address" placeholder="Where is your event hosted?" />
        <x-input-error :messages="[]" />
      </div>

      <div class="mb-6">
        <x-input-label for="start_date" :value="__('Event start date')"/>
        <x-text-input type="date" id="start_date" name="start_date" />
        <x-input-error :messages="[]" />
      </div>

      <div class="mb-6">
        <x-input-label for="end_date" :value="__('Event end date')"/>
        <x-text-input type="date" id="end_date" name="end_date" />
        <x-input-error :messages="[]" />
      </div>

      <div class="mb-6">
        <x-input-label for="poster" :value="__('Upload event poster')"/>
        <x-file-input accept="image/*" id="poster" name="poster" />
        <x-input-error :messages="[]" />
      </div>

      <x-buttons.primary type="submit" class="w-full">Create new event</x-buttons.primary> 
    </form>

</div>
@endsection