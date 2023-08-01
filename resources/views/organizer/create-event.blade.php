@extends('layouts.organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Create New Event</h1>

    {{-- TODO: change to a real route --}}
    <form action="{{ route('test.create.event') }}" method="POST">
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
        <x-input-label for="date" :value="__('Event date')"/>
        <x-text-input type="date" id="date" name="date" />
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