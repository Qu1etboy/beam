@extends('layouts.event')

@section('title', 'Information - Beam Organizer')

@section('sub-content')

<h1 class="font-bold text-4xl m-3">Event Information</h1>
<p class="text-gray-600 mx-3">Edit your event information before publish to everyone.</p>

<form action="{{ route('organizer.event.update-information', ['organizer' => $organizer, 'event' => $event]) }}" method="POST" class="p-3 space-y-5" enctype="multipart/form-data">
  @csrf
  @method("PUT")
  <!-- Upload poster -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">1</span>
      <h2 class="text-xl font-bold">Upload Poster</h2>
    </div>
    <div class="flex flex-col md:flex-row">
      <img 
        src="{{ asset('storage/' . $event->poster_image) }}" 
        alt="poster"
        class="rounded-lg object-cover w-[200px] h-[300px]" 
        onerror="this.src='https://placehold.co/800x1032';"   
      >
      <div class="my-6 md:my-0 md:px-3 col-span-2 w-full">
          <x-input-label for="poster" :value="__('Upload event poster')"/>
          <x-file-input accept="image/*" id="poster" name="poster" />
          <x-input-error :messages="$errors->get('poster')" />
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
      <x-text-input id="name" name="event_name" value="{{ $event->event_name }}" placeholder="Enter your event name" />
      <x-input-error :messages="$errors->get('event_name')" />
    </div>
  </div>

  <!-- Date and Time -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">3</span>
      <div>
        <h2 class="text-xl font-bold">Date and Time</h2>
        <p class="text-sm text-gray-600">If not specified, will be display as "To be announced"</p>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-x-3">
      <div class="mb-6">
        <x-input-label for="start-date" :value="__('Start date & time')"/>
        <x-text-input type="datetime-local" id="start-date" name="start_date" value="{{ $event->start_date }}" />
        <x-input-error :messages="$errors->get('start_date')" />
      </div>
      <div class="mb-6">
        <x-input-label for="end-date" :value="__('End date & time')" />
        <x-text-input type="datetime-local" id="end-date" name="end_date" value="{{ $event->end_date }}" />
        <x-input-error :messages="$errors->get('end_date')" />
      </div>
    </div>
  </div>

  <!-- Location -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">4</span>
      <div>
        <h2 class="text-xl font-bold">Location</h2>
        <p class="text-sm text-gray-600">If not specified, will be display as "To be announced"</p>
      </div>
    </div>
    <div class="mb-6">
      <x-input-label for="search-location" :value="__('Event location')"/>
      <x-text-input id="search-location" name="location" type="text" value="{{ $event->location }}" placeholder="Where is your event hosted?" />
      {{-- <x-text-input id="location" name="location" value="{{ $event->location }}" placeholder="Where is your event hosted?" /> --}}
      <x-input-error :messages="$errors->get('location')" />
      <div id="map" class="mt-3 rounded-lg h-[300px]"></div>
      <!-- Display location description on map-->
      <div id="infowindow-content" class="hidden">
        <span id="place-name" class="font-bold"></span><br />
        <span id="place-address"></span>
      </div>
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
      <textarea id="description" class="ckeditor form-control" name="event_description">{!! $event->event_description !!}</textarea>
    </div>
  </div>

  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">6</span>
      <h2 class="text-xl font-bold">Question 
      <span class="text-sm text-gray-600">(Optional)</span>
      </h2>
    </div>
    <div>
      <div class="mb-6">
        <x-input-label for="q" :value="__('Question')"/>
        <x-text-input id="q" name="q" />
        <x-input-error :messages="[]" />
      </div>
    </div>
    <x-buttons.primary>Add more questions</x-buttons.primary>
  </div>

  <x-buttons.primary type="submit" class="w-full">Save</x-buttons.primary>
</form>
@endsection