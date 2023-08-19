{{-- Beautiful Responsive menu --}}
<div class="lg:container mx-auto justify-between items-center py-3 px-6 border-b bg-white" id="menu">
    <div class="flex justify-between">
        <ul class=" items-center gap-5">
            <li><a href="{{ route('organizer.events', ['organizer' => $organizer]) }}" class="hover:text-purple-500 duration-300">Events</a></li>
            <li><a href="{{ route('organizer.members', ['organizer' => $organizer]) }}" class="hover:text-purple-500 duration-300">Members</a></li>
            @can('update', $organizer)
                <li><a href="{{ route('organizer.edit', ['organizer' => $organizer]) }}" class="hover:text-purple-500 duration-300">Settings</a></li>
            @endcan
        </ul>
        <div class="gap-1 lg:flex items-end">
            <x-dropdown align="right" width="48" class="z-20">
                <x-slot name="trigger">
                    <button class="flex items-center gap-2 hover:bg-gray-100 px-2 py-1 duration-300 rounded-md">
                        <x-user-avatar :profile_url="$organizer->organizer_profile" class="w-7 h-7" />
                        <span>{{ $organizer->organizer_name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"class="h-4 w-4 text-gray-400" aria-hidden="true"><path d="m7 15 5 5 5-5"></path><path d="m7 9 5-5 5 5"></path></svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <h2 class="text-sm text-gray-600 px-4 pt-4 mb-2">Your organizations</h2>
                    
                    @foreach(Auth::user()->joinedOrganizations as $joinedOrganization)
                        <x-dropdown-link :href="route('organizer.events', ['organizer' => $joinedOrganization])" class="flex items-center gap-2">
                            <x-user-avatar :profile_url="$joinedOrganization->organizer_profile" class="w-7 h-7" />
                            {{ $joinedOrganization->organizer_name }}
                            @if ($joinedOrganization->id === $organizer->id)
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round" class="lucide lucide-check"><polyline points="20 6 9 17 4 12"/></svg>
                            @endif
                        </x-dropdown-link>
                    @endforeach
                
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</div>