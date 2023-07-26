@extends('layouts.main')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">Your Events</h1>

    {{-- Check if have any events --}}
    @if (false) 
    <section class="my-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-3 gap-y-6 place-items-center">

        @for($i = 0; $i < 10; $i++)
            <!-- Event card-->
            <a href="/event" class="max-w-lg">
                <img 
                    src="https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" 
                    alt="poster"
                    class="rounded-lg object-cover h-[300px]"    
                >
                <div class="mt-3">
                    <span class="text-sm text-red-500">Sat, 05 Aug</span>
                    <h2 class="font-semibold">KU First Meet</h2>
                    <p class="text-gray-600 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin inline-block"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        Location
                    </p>
                </div>
            </a>    
        @endfor
    </section>
    @else
    <section class="text-center mt-16">
      <img src="/_static/undraw_children.svg" class="mx-auto" width="400"/>
      <p class="text-lg my-8">Oh, you don't have any event yet.</p>
      <a href="#" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Click here to create your event</a>
    </section>
    @endif 

</div>
@endsection