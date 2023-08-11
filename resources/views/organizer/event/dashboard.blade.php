@extends('layouts.event')

@section('title', 'Dashboard - Beam Organizer')

@section('content')
<div class="p-3">
    <h1 class="font-bold mb-8 text-2xl sm:text-3xl md:text-4xl my-3">Event Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Submission</h5>
            <p class="text-lg font-normal text-gray-700">{{ $event->participants()->count() }}</p>
        </div>
        <div href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Accepted</h5>
            <p class="text-lg font-normal text-gray-700">{{ $event->countAcceptedParticipants($event->id) }}</p>
        </div>
        <div href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Tasks</h5>
            <p class="text-lg font-normal text-gray-700">{{ $event->tasks()->count() }}</p>
        </div>
    </div>

</div>
@endsection