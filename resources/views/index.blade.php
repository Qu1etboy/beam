@extends('layouts.main')

@section('title', 'Beam')

@section('content')
<div>
    @if ($events->currentPage() === 1)
    <div class="relative flex flex-col justify-center h-[600px] bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1450849608880-6f787542c88a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2842&q=80')]">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full flex flex-col justify-center items-center bg-black/50 backdrop-blur-md"></div>
        <div class="container mx-auto z-[2] px-3">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold my-3 text-gray-100">Discover new experiences here</h1>
            <p class="text-lg md:text-xl mx-1 text-gray-100">Over 100+ events right here for you</p>
        </div>
    </div>
    @endif

    <section class="container mx-auto p-3 mt-5">
        <h1 class="font-bold text-4xl my-3">All Events</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-3 gap-y-6 place-items-center my-8">
            @foreach($events as $event)
                <x-event-card 
                    :href="route('event-detail', ['event' => $event])"
                    :poster="file_exists('storage/' . $event->poster_image) ? asset('storage/' . $event->poster_image) : $event->poster_image"
                    :start_date="$event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') : null" 
                    :end_date="$event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') : null"
                    :title="$event->event_name" 
                    :location="$event->location"
                />
            @endforeach
        </div>
        <div class="flex justify-center">
            {{ $events->links() }}
        </div>
    </section>

</div>
@endsection
