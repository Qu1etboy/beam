@extends('layouts.organizer')

@section('title', 'Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <div class="font-bold text-2xl sm:text-3xl md:text-4xl my-4">Welcome to <span class="text-purple-700">{{ $organizer->organizer_name }}</span> Organization</div>
    <p class="text-gray-600">Let's start hosting extraordinary events that everyone can join!</p>
    <hr class="my-8">
    
    <div class="flex flex-wrap gap-3 justify-between my-3">
        <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl">Your Events</h1>
        <a href="{{ route('organizer.create-event', $organizer) }}" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Click here to create your event</a>
    </div>

    {{-- Check if have any events --}}
    @if (count($events) > 0) 
    <section class="my-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-3 gap-y-6 place-items-center">

        @foreach($events as $event)
            <!-- Event card-->
            <div class="relative group">
                <x-event-card 
                    {{-- :href="route('event.show', $event->id)"  --}}
                    :href="route('organizer.event.dashboard', ['organizer' => $organizer->id, 'event' => $event->id])"
                    :poster="asset('storage/' . $event->poster_image)"
                    :start_date="$event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') : null"
                    :end_date="$event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') : null"
                    :title="$event->event_name"
                    :location="$event->location"
                /> 

                <div class="group-hover:block hidden absolute top-0 right-0 m-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal bg-gray-300/70 text-gray-700 rounded-lg "><circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /><circle cx="5" cy="12" r="1" /></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">            
                            <x-dropdown-link class="text-red-500 flex items-center gap-2">
                                <form action="{{ route('organizer.event.destroy', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="confirm('Are you sure you want to delete this event?')" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        Delete Event
                                    </button>
                                </form>
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

            </div>
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