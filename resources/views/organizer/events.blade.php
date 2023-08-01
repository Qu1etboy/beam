@extends('layouts.organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Your Events</h1>

    {{-- Check if have any events --}}
    @if (false) 
    <section class="my-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-3 gap-y-6 place-items-center">

        @for($i = 0; $i < 10; $i++)
            <!-- Event card-->
            <x-event-card 
                :href="__('/event')" 
                :poster="__('https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80')" 
                :date="__('Sat, 05 Aug')"
                :title="__('KU First Meet')"
                :location="__('Location')"
            /> 
        @endfor
    </section>
    @else
    <section class="text-center mt-16">
      <img src="/_static/undraw_children.svg" class="mx-auto" width="400"/>
      <p class="text-lg my-8">Oh, you don't have any event yet.</p>
      <a href="/organizer/events/create" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Click here to create your event</a>
    </section>
    @endif 

</div>
@endsection