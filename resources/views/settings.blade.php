@extends('layouts.main')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">My Account</h1>

    <form class="mt-8">
      <div>
        <div class="flex gap-5">
          <img src="{{ $user->avatar }}" alt="user avatar" class="rounded-full object-cover h-20 w-20">
          <div class="mb-6">
            <label for="profile" class="block mb-2 text-sm font-medium text-gray-900">Upload profile picture</label>
            <input type="file" accept="image/*" id="profile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full file:bg-gray-100 file:mr-4 file:border-0 file:transparent file:py-3 file:px-4">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-3">

          <div class="mb-6">
            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900">First name</label>
            <input type="text" id="first-name" placeholder="Enter your first name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ $user->name }}">
          </div>

          <div class="mb-6">
            <label for="socials" class="block mb-2 text-sm font-medium text-gray-900">Socials</label>
            <input type="text" id="socials" placeholder="(Facebook, Instagram, Line)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
          </div>

          <div class="mb-6">
            <label for="certificate" class="block mb-2 text-sm font-medium text-gray-900">Upload certificates</label>
            <input type="file" accept="image/*" id="certificate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full file:bg-gray-100 file:mr-4 file:border-0 file:transparent file:py-3 file:px-4">
          </div>
        </div>
      </div>

      <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Save changed</button>
    
    </form>

</div>
@endsection