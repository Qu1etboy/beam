@extends('layouts.organizer')

@section('title', 'Events - Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <div class="flex flex-wrap gap-3 justify-between my-3">
        <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl">Your Events</h1>
        <a href="{{ route('organizer.create-event', $organizer) }}" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Click here to create your event</a>
    </div>

    {{-- Check if have any events --}}
    @if (count($events) > 0) 
    <section class="my-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-3 gap-y-6 place-items-center">

        @foreach($events as $event)
            <!-- Event card-->
            <x-event-card 
                {{-- :href="route('event.show', $event->id)"  --}}
                :href="route('organizer.event.dashboard', ['organizer' => $organizer->id, 'event' => $event->id])"
                :poster="asset('storage/' . $event->poster_image)"
                :start_date="$event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') : null"
                :end_date="$event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') : null"
                :title="$event->event_name"
                :location="$event->location"
            /> 
        @endforeach
    </section>
    @else
    <section class="text-center mt-16">
      <img src="/_static/undraw_children.svg" class="mx-auto" width="400"/>
      <p class="text-lg my-8">Oh, you don't have any event yet.</p>
    </section>
    @endif 

</div>
@endsection