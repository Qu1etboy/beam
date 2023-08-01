@props([
  'href' => '#', 
  'poster',
  'date' => '',
  'title',
  'location'
])

<a href="{{ $href }}" class="max-w-lg">
    <img 
        src="{{ $poster }}" 
        alt="{{ $title . ' poster'}}"
        class="rounded-lg object-cover h-[300px]"    
    >
    <div class="mt-3">
        <span class="text-sm text-red-500">{{ $date }}</span>
        <h2 class="font-semibold">{{ $title }}</h2>
        <p class="text-gray-600 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin inline-block"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ $location }}
        </p>
    </div>
</a>   