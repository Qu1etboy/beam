@extends('layouts.main')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">All Events</h1>

    <section class="my-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-3 gap-y-6 place-items-center">

        @for($i = 0; $i < 10; $i++)
            <x-event-card 
                :href="__('/event')" 
                :poster="__('https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80')" 
                :date="__('Sat, 05 Aug')"
                :title="__('KU First Meet')"
                :location="__('Location')"
            />
        @endfor

    </section>

</div>
@endsection