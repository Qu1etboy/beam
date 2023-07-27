@extends('layouts.event')

@section('sub-content')
<div class="p-3">
    <div class="grid grid-cols-1 md:grid-cols-2">
      <img 
        src="https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" 
        alt="poster"
        class="rounded-lg object-cover w-full h-[600px]"    
      >
      <div class="px-8 py-4 flex flex-col justify-center">
        <h2 class="text-2xl font-bold mb-3">Edit Event</h2>
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
            <label for="poster" class="block mb-2 text-sm font-medium text-gray-900">Upload poster image</label>
            <input type="file" accept="image/*" id="poster" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full file:bg-gray-100 file:mr-4 file:border-0 file:transparent file:py-3 file:px-4">
          </div>

          <button type="submit" class="w-full text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Save change</button>
        </form>
      </div>
    </div>

</div>
@endsection