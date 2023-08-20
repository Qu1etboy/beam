@extends('layouts.event')

@section('title', $event->event_name . "'s " . 'Information - Beam Organizer')

@section('content')

<h1 class="font-bold text-2xl sm:text-3xl md:text-4xl m-3">Event Information</h1>
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
      @error('event_name')  
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-md shadow-md text-white text-sm animate-pulse">
                {{$message}}
            </div>
        @enderror
    </div>
  </div>

  <!-- Register Date and Time -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">3</span>
      <div>
        <h2 class="text-xl font-bold">Register Date and Time</h2>
        <p class="text-sm text-gray-600">Set the time period that allow candidate to register this event</p>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-x-3">
      <div class="mb-6">
        <x-input-label for="register_start_date" :value="__('Start date & time')"/>
        <x-text-input type="datetime-local" id="register_start_date" name="register_start_date" value="{{ $event->register_start_date }}" />
        <x-input-error :messages="$errors->get('register_start_date')" />
      </div>
      <div class="mb-6">
        <x-input-label for="register_end_date" :value="__('End date & time')" />
        <x-text-input type="datetime-local" id="register_end_date" name="register_end_date" value="{{ $event->register_end_date }}" />
        <x-input-error :messages="$errors->get('register_end_date')" />
      </div>
      <div class="col-span-2">
        <label class="relative inline-flex items-center cursor-pointer">
          <input type="checkbox" name="allow_register" class="sr-only peer" @if($event->allow_register) checked @endif >
          <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-purple-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
          <span class="ml-3 text-sm font-medium text-gray-900">Allow Register</span>
        </label>
        <x-input-error :messages="$errors->get('allow_register')" />
        <p class="text-sm text-gray-600 mt-1">*Allow the candidate to register until the end of the register date</p>
      </div>
    </div>
  </div>

  <!-- Date and Time -->
  <div class="border rounded-md p-3">
    <div class="flex items-center gap-3 mb-5">
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">4</span>
      <div>
        <h2 class="text-xl font-bold">Event Date and Time</h2>
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
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">5</span>
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
      <span class="bg-gray-200 rounded-full h-5 w-5 flex items-center justify-center p-5">6</span>
      <h2 class="text-xl font-bold">Description</h2>
    </div>
    <div class="mb-6">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Event description</label>
      {{-- <textarea id="description" class="ckeditor form-control" name="event_description">{!! $event->event_description !!}</textarea> --}}
      <div x-data="editor(@js($event->event_description), 'event_description')">
        <x-rich-text-editor />
        <input :id="id" type="hidden" name="event_description" />
      </div>
    </div>
  </div>

  <x-buttons.primary type="submit" class="w-full">Save</x-buttons.primary>
</form>
@endsection