<div class="relative block max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="absolute right-0 top-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
        </x-slot>

        <x-slot name="content">            
            <x-dropdown-link>Mark as Todo</x-dropdown-link>
            <x-dropdown-link>Mark as Doing</x-dropdown-link>
            <x-dropdown-link>Mark as Done</x-dropdown-link>
        </x-slot>
    </x-dropdown>
    
    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-90">Planning</h5>

    @if (true)
        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Low</span>
    @elseif (true)
        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Medium</span>
    @else 
        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">High</span>
    @endif

    <div class="flex justify-between">
        <!-- Due date -->
        <div class="flex mt-4 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
            <p class="font-normal text-sm text-gray-700">
                27 Jul 2023
            </p>
        </div>
        <!-- Assginee-->
        <div class="flex -space-x-4 mt-3">
            <img class="w-8 h-8 border-2 border-white rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="">
            <img class="w-8 h-8 border-2 border-white rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="">
            <span class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600">+3</span>
        </div>
    </div>
</div>