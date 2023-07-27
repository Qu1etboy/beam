@extends('layouts.organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Create New Event</h1>

    <form>
      @csrf
      <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Event name</label>
        <input type="text" id="name" placeholder="Enter your event name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>

      <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Event description</label>
        <input type="text" id="description" placeholder="Enter your event description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>

      <div class="mb-6">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Event address</label>
        <input type="text" id="address" placeholder="Where is your event hosted?" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>

      <div class="mb-6">
        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Event date</label>
        <input type="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>

      <div class="mb-6">
        <label for="poster" class="block mb-2 text-sm font-medium text-gray-900">Why do you want to join?</label>
        <input type="file" accept="image/*" id="poster" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full file:bg-gray-100 file:mr-4 file:border-0 file:transparent file:py-3 file:px-4">
      </div>

      <button type="submit" class="w-full text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Create new event</button>
    </form>

</div>
@endsection