@extends('layouts.main')

@section('title', 'Beam')

@section('content')
<div>
    <section class="container mx-auto p-3 mt-5">
        <h1 class="font-bold text-4xl my-3">{{ $events->total() }} {{ $events->total() > 1 ? "Events" : "Event" }} for "{{ $search_query }}"</h1>
        
        @if ($events->count() > 0)
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
              {{ $events->appends(request()->query())->links() }}
          </div>
        @else 
          <div>No result found.</div>
        @endif 
    </section>

</div>
@endsection
