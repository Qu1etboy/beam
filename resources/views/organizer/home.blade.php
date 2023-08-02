@extends('layouts.main')

@section('content')
    <div class="container mx-auto p-3">
        <h1 class="font-bold text-4xl my-3">Select your organization</h1>

        @if ($organizations->isNotEmpty())
            <ul class="space-y-4">
                @foreach ($organizations as $organization)
                    <a href="{{ route('organizer.events', $organization->id) }}" >
                        <li
                            class="border rounded-lg px-6 py-4 mb-4 flex justify-between items-center hover:bg-gray-100 transition-colors duration-200">
                            <div>
                                <h2 class="font-bold text-xl">
                                    {{ $organization->organizer_name }}
                                </h2>
                            </div>
                            <div class="text-gray-600">
                                {{ $organization->owner->name }}
                            </div>
                        </li>
                    </a>
                @endforeach
            </ul>
        @else
            <div class="text-center">
                <img src="/_static/undraw_toy_car.svg" class="h-[250px] mx-auto my-8">
                <p>You don't have any organization yet</p>
                <p>Please create your organization to start hosting events!</p>
            </div>
        @endif
        <div class="text-center">
            <a href="/organizer/create"
                class="inline-block text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 ml-4">Create
                new organization</a>
        </div>
    </div>
@endsection
