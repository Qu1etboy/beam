@extends('layouts.main')

@section('title', 'Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Select your organization</h1>

    @if(false)
      {{-- Show list of user's organization --}}
    @else 
    <div class="text-center">
      <img src="/_static/undraw_toy_car.svg" class="h-[250px] mx-auto my-8">
      <p>You don't have any organization yet</p>
      <p>Please create your organization to start hosting events!</p>
    </div>
    @endif
    <div class="text-center">
      <a href="/organizer/create" class="inline-block text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 ml-4">Create new organization</a>
    </div>
</div>
@endsection