@extends('layouts.base')

@section('title', 'Create - Beam Organizer')

@section('body')
<div class="w-full h-screen grid grid-cols-1 md:grid-cols-2">
  <div class="hidden md:flex w-full px-16 text-center text-white flex-col justify-center bg-black/60 h-screen bg-cover bg-center bg-blend-overlay bg-[url('https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80')]">
    <h1 class="font-bold text-7xl my-5">Welcome</h1>
    <p>
      Experience the power of seamless event creation and effortless event management with Beam, 
      the cutting-edge app designed to make your event planning journey an absolute breeze. 
    </p>
  </div>
  <div class="w-full px-16 flex flex-col justify-center">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-semibold my-4">Let's create your <span class="text-4xl font-bold text-purple-500">organization!</span></h2>
      <p class="text-gray-600">Publish your awesome event for everyone to join!</p>
    </div>
    <form action="{{ route('organizer.store-organization') }}" method="POST">
      @csrf
      <div class="mb-6">
        <x-input-label for="name" :value="__('Organization name')"/>
        <x-text-input id="name" name="name" placeholder="Enter your organization name" />
        <x-input-error :messages="$errors->get('name')" />
      </div>
      <button type="submit" class="w-full text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Create organization</button>
    </form>
  </div>


</div>
@endsection