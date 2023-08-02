@extends('layouts.main')

@section('title', 'My Orders - Beam')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">My Orders</h1>

    <div class="mt-8 space-y-4">

      @foreach($events as $event)
        <div class="border">
          <div class="p-3 border-b">Order no. #{{ $loop->iteration }}</div>
          <div class="flex p-3">
            <img 
              src="{{ $event->poster_image }}" 
              alt="poster"
              class="rounded-lg object-cover" 
              width="125"
              height="200"
            >
            <div class="px-6 space-y-3">
              <h2 class="text-xl font-bold">{{ $event->event_name }}</h2>
              <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar inline-block"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
              
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
              </p>
              <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin inline-block"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                
                {{ $event->location }}
              </p>
              
              <div>
                @if ($event->pivot->status == 'accepted')
                  <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">Accepted</span>
                @else 
                  <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">Rejected</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    
    </div>

</div>
@endsection
