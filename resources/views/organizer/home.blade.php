@extends('layouts.main')

@section('title', 'Beam Organizer')

@section('content')
    <div class="container mx-auto p-3">
        <div class="flex flex-wrap gap-3 justify-between my-3">
            <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Select your organization</h1>
            <div class="text-center">
                <a href="/organizer/create"
                    class="inline-block text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 ml-4">Create
                    new organization</a>
            </div>
        </div>

        @if ($allOrganizations->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mt-8">
                @foreach ($allOrganizations as $allOrganization)
                    <a href="{{ route('organizer.events', $allOrganization->id) }}" class="border rounded-lg mb-4 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex justify-between items-center px-6 pt-4 pb-2">
                            <div class="flex items-center gap-3">
                                <x-user-avatar :profile_url="$allOrganization->organizer_profile" class="h-20 w-20" />
                                <h2 class="font-bold text-xl mt-3">
                                    {{ $allOrganization->organizer_name }}
                                </h2>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mt-3 border-t bg-gray-100 px-6 py-4">
                            <x-user-avatar :profile_url="$allOrganization->owner->avatar" class="h-5 w-5" />
                            <span class="text-gray-600 text-sm">
                                {{ $allOrganization->owner->name }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center">
                <img src="/_static/undraw_toy_car.svg" class="h-[250px] mx-auto my-8">
                <p>You don't have any organization yet</p>
                <p>Please create your organization to start hosting events!</p>
            </div>
        @endif
    </div>
@endsection
