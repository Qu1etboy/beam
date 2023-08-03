@extends('layouts.event')

@section('title', 'Information - Beam Organizer')

@section('sub-content')

<h1 class="font-bold text-4xl m-3">Event Information</h1>
<form class="p-3 space-y-5">
  @csrf
  <!-- Upload poster -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">1</span>
      <h2 class="text-xl font-bold">Upload Poster</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3">
      <img 
        src="https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" 
        alt="poster"
        class="rounded-lg object-cover"    
      >
      <div class="mb-6 px-3 col-span-2">
          <x-input-label for="poster" :value="__('Upload event poster')"/>
          <x-file-input accept="image/*" id="poster" name="poster" />
          <x-input-error :messages="[]" />
        </div>
    </div>
  </div>

  <!-- Event detail -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">2</span>
      <h2 class="text-xl font-bold">Detail</h2>
    </div>
    <div class="mb-6">
      <x-input-label for="name" :value="__('Event name')"/>
      <x-text-input id="name" name="name" placeholder="Enter your event name" />
      <x-input-error :messages="[]" />
    </div>
  </div>

  <!-- Date and Time -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">3</span>
      <h2 class="text-xl font-bold">Date and Time</h2>
    </div>
    <div class="grid grid-cols-2 gap-x-3">
      <div class="mb-6">
        <x-input-label for="start-date" :value="__('Start date')"/>
        <x-text-input type="date" id="start-date" name="start-date" />
        <x-input-error :messages="[]" />
      </div>
      <div class="mb-6">
        <x-input-label for="start-time" :value="__('Start time')"/>
        <x-text-input type="time" id="date" name="date" />
        <x-input-error :messages="[]" />
      </div>
      <div class="mb-6">
        <x-input-label for="end-date" :value="__('End date')"/>
        <x-text-input type="date" id="end-date" name="end-date" />
        <x-input-error :messages="[]" />
      </div>
      <div class="mb-6">
        <x-input-label for="end-time" :value="__('End time')"/>
        <x-text-input type="time" id="end-time" name="end-time" />
        <x-input-error :messages="[]" />
      </div>
    </div>
  </div>

  <!-- Location -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">4</span>
      <h2 class="text-xl font-bold">Location</h2>
    </div>
    <div class="mb-6">
      <x-input-label for="address" :value="__('Event location')"/>
      <x-text-input id="address" name="address" placeholder="Where is your event hosted?" />
      <x-input-error :messages="[]" />
    </div>
  </div>

  <!-- Description -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">5</span>
      <h2 class="text-xl font-bold">Description</h2>
    </div>
    <div class="mb-6">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Event description</label>
      <textarea id="description" class="ckeditor form-control" name="description"></textarea>
    </div>
  </div>

  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">6</span>
      <h2 class="text-xl font-bold">Question (Optional)</h2>
    </div>
    <div>
      <div class="mb-6">
        <x-input-label for="q1" :value="__('Question 1')"/>
        <x-text-input id="q1" name="q1" />
        <x-input-error :messages="[]" />
      </div>
    </div>
    <x-buttons.primary>Add more questions</x-buttons.primary>
  </div>

  <x-buttons.primary type="submit" class="w-full">Save</x-buttons.primary>
</form>
@endsection