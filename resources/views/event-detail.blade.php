@extends('layouts.main')

@section('title', $event->event_name . ' - Beam')

@section('content')
<div class="mx-auto">
    
    <div class="relative py-10 px-3 bg-cover bg-center" 
     style="background-image: url('{{ file_exists('storage/' . $event->poster_image) ? asset('storage/' . $event->poster_image) : $event->poster_image }}');">
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full flex flex-col justify-center items-center bg-black/50 backdrop-blur-lg"></div>
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-3">
        <img 
          src="{{ file_exists('storage/' . $event->poster_image) ? asset('storage/' . $event->poster_image) : $event->poster_image }}"
          alt="poster"
          class="object-cover w-full h-[500px] z-[2]"    
          onerror="this.src='https://placehold.co/800x1032';"  
        >
        <div class="p-8 md:p-16 col-span-2 flex flex-col justify-center bg-white/70 backdrop-blur-lg z-[2]">
          <div class="space-y-3">
            <h1 class="text-4xl font-bold">{{ $event->event_name }}</h1>
            <div class="flex gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
              @if ($event->start_date && $event->end_date)
                <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') . ' - ' . \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') }}</p>
              @else 
                <p>To be announced</p>
              @endif
            </div>
            <div class="flex gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
              <p class="max-w-[50ch]">{{ $event->location ? $event->location : "To be announced" }}</p>
            </div>  
          </div>

          @if ($event->start_date && $event->end_date)
            <div>
              <a href="{{ route('event.calendar', ['event' => $event] )}}" class="inline-flex items-center gap-3 py-2.5 px-5 mt-4 font-medium text-gray-900 focus:outline-none bg-transparent rounded-lg border border-gray-900 hover:bg-gray-50/40 hover:text-purple-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-plus"><path d="M21 13V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><line x1="19" x2="19" y1="16" y2="22"/><line x1="16" x2="22" y1="19" y2="19"/></svg>
                Add to Calendar
              </a>
            </div>
          @endif

          <div class="flex items-center gap-3 mt-8">
            <x-user-avatar :profile_url="$event->organizer->organizer_profile" class="w-20 h-20"/>
            <div>
              <p class="text-gray-600">Organized by</p>
              <p class="text-3xl font-bold">{{ $event->organizer->organizer_name }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="border-b px-3 py-6 sticky top-0 bg-white/60 backdrop-blur-lg">
      <div class="container mx-auto">
        <ul class="flex gap-5">
          <li>
            <a href="#info" class="text-purple-900 hover:text-black duration-300">Info</a>
          </li
          <li>
            <a href="#register" class="text-purple-900 hover:text-black duration-300">Register</a>
          </li>
        </ul>
      </div>
    </nav>

    <section class="my-5">
      {{-- <h2 class="text-3xl font-bold my-3">Event Description</h2> --}}
      <div class="container mx-auto">
        <article id="info" class="prose mx-auto lg:max-w-6xl p-3">  
          {!! $event->event_description !!}
        </article>
      </div>
      
      <form action="{{ route('event-register', ['event' => $event]) }}" method="POST" class="mt-8">
        @csrf
        
        @if ($event->registrantQuestions->count() > 0)
          <div>
            <div class="container lg:max-w-6xl px-3 py-16 mx-auto">
              <h2 class="text-3xl font-bold mt-3 mb-1">Application Form</h2>
              <p class="text-gray-600">The event organizer wants you to answer these questions before register for the event.</p>
              <p class="text-gray-600 mb-6">After fill in the form, click <a href="#register" class="underline">Register</a> to register this event</p>
              @foreach($event->registrantQuestions as $question)
                <div class="mb-6">
                  <label for="{{ 'q' . $loop->iteration }}" class="mb-1">{{ $loop->iteration . '. ' . $question->question }}</label>
                  <textarea id="{{ 'q' . $loop->iteration }}" name="{{ 'q' . $loop->iteration }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5"></textarea>
                  <x-input-error :messages="[]" />
                </div>
              @endforeach
            </div>
          </div>
        @endif
        
        <div id="register" class="bg-gray-100">
          <div class="container px-3 py-24 mx-auto">
            <h2 class="text-3xl font-bold mt-3 mb-1">Register This Event</h2>
            <p class="text-gray-600 mb-6">After you register for this event. The information will be sent to the event organizer. This action can't be undone</p>
            
            @if ($event->register_start_date && $event->register_end_date )
              <div class="mb-6">
              Open for register from 
              <span class="text-purple-800">{{ \Carbon\Carbon::parse($event->register_start_date)->format('d M Y, H:i') }}</span>
              to 
              <span class="text-purple-800">{{ \Carbon\Carbon::parse($event->register_end_date)->format('d M Y, H:i') }}</span>
              </div>
            @endif  
            
            {{-- If user already registered this event remove register button --}}
            @if ($is_registered)
              <button type="button" class="w-full text-gray-600 bg-gray-300 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center" disabled>You are already registered this event</button>

            @elseif (!$event->allow_register || $event->register_start_date > date("Y-m-d"))
              <button type="button" class="w-full text-gray-600 bg-gray-300 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center" disabled>The application period hasn't started</button>
            
            @elseif ($event->register_end_date < date("Y-m-d") || ($event->start_date && $event->start_date < date("Y-m-d")))
              <button type="button" class="w-full text-gray-600 bg-gray-300 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center" disabled>The application period has closed</button>

            @elseif ($event->end_date && $event->end_date < date("Y-m-d"))
              <button type="button" class="w-full text-gray-600 bg-gray-300 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center" disabled>Event ended</button>
            
            {{-- If user not sign in ask to sign in first --}}
            @elseif (!Auth::user()) 
              <a href="{{ url('/auth/google') }}" class="w-full inline-block text-center text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg px-5 py-2.5 mr-2 mb-2">Please sign in to register this event</a>

            {{-- Okay, allow register  --}}
            @else
              <x-buttons.primary type="submit" class="w-full">Register</x-buttons.primary> 
            @endif
          
          </div>
        </div>
      
      
      </form>
    </section>

</div>
@endsection