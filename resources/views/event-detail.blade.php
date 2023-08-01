@extends('layouts.main')

@section('content')
<div class="mx-auto">
    
    <div class="relative py-10 px-3 bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80')]">
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full flex flex-col justify-center items-center bg-black/50 backdrop-blur-lg"></div>
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-3">
        <img 
          src="https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" 
          alt="poster"
          class="object-cover w-full h-[500px] z-[2]"    
        >
        <div class="p-8 md:p-16 col-span-2 flex flex-col justify-center bg-white/70 backdrop-blur-lg z-[2]">
          <div class="space-y-3">
            <h1 class="text-4xl font-bold">KU First Meet</h1>
            <div class="flex gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
              <p>17 Jul 2023, 16:00 - 18:00</p>
            </div>
            <div class="flex gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
              <p class="max-w-[50ch]">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>  
          </div>
          <div class="flex items-center gap-3 mt-8">
            <img 
              src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1720&q=80" 
              alt="organizer avatar"
              class="rounded-full object-cover w-20 h-20"
            >
            <div>
              <p class="text-gray-600">Organized by</p>
              <p class="text-3xl font-bold">KU Tech</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="container mx-auto p-3 my-5">
      <h2 class="text-3xl font-bold my-3">Event Description</h2>
      <p>  
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores atque nemo necessitatibus consectetur maxime accusamus dignissimos commodi qui, mollitia harum fuga optio explicabo architecto corporis numquam nesciunt reprehenderit, maiores hic?
      </p>
      <form class="mt-8">
        @if(true)
          <h2 class="text-3xl font-bold my-3">Questions</h2>
          <div class="mb-6">
            <x-input-label for="q1" :value="__('Why do you want to join?')"/>
            <x-text-input id="q1" name="q1" />
            <x-input-error :messages="[]" />
          </div>
        @endif
        
        <x-buttons.primary type="submit" class="w-full">Submit</x-buttons.primary> 
      </form>
    </section>

</div>
@endsection