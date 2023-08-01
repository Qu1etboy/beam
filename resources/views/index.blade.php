@extends('layouts.main')

@section('content')
<div>

    <div class="relative flex flex-col justify-center h-[600px] bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1450849608880-6f787542c88a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2842&q=80')]">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full flex flex-col justify-center items-center bg-black/50 backdrop-blur-md"></div>
        <div class="container mx-auto z-[2] px-3">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold my-3 text-gray-100">Discover new experiences here</h1>
            <p class="text-lg md:text-xl mx-1 text-gray-100">Over 100+ events right here for you</p>
        </div>
    </div>

    <section class="container mx-auto p-3 mt-5">
        <h1 class="font-bold text-4xl my-3">All Events</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-3 gap-y-6 place-items-center my-8">
            @for($i = 0; $i < 10; $i++)
                <x-event-card 
                    :href="__('/event')" 
                    :poster="__('https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80')" 
                    :date="__('Sat, 05 Aug')"
                    :title="__('KU First Meet')"
                    :location="__('Location')"
                />
            @endfor
        </div>

    </section>

</div>
@endsection