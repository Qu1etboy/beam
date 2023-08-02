@extends('layouts.event')

@section('title', 'Information - Beam Organizer')

@section('sub-content')
<form class="p-3">
  @csrf
  <div class="grid grid-cols-1 md:grid-cols-2">
    <img 
      src="https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" 
      alt="poster"
      class="rounded-lg object-cover w-full h-[600px]"    
    >
    <div class="md:px-8 py-4 flex flex-col justify-center">
      <h2 class="text-2xl font-bold mb-3">Edit Event</h2>
        <div class="mb-6">
          <x-input-label for="name" :value="__('Event name')"/>
          <x-text-input id="name" name="name" placeholder="Enter your event name" />
          <x-input-error :messages="[]" />
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
      </form>
    </div>
  </div>

  <div class="md:px-4 mt-5">
    <div class="mb-6">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Event description</label>
      <textarea id="description" class="ckeditor form-control" name="description"></textarea>
    </div>
    <x-buttons.primary type="submit" class="w-full">Save change</x-buttons.primary>
  </div>
</form>
@endsection