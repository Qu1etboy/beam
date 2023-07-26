@extends('layouts.main')

@section('content')
<div class="container mx-auto p-3">
    
    <div class="grid grid-cols-1 md:grid-cols-2">
      <img 
        src="https://images.unsplash.com/photo-1690221129223-e5a996041fec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" 
        alt="poster"
        class="rounded-lg object-cover w-full h-[600px]"    
      >
      <div class="px-8 py-4 flex flex-col justify-center">
        <div class="space-y-3">
          <h1 class="text-4xl font-bold">KU First Meet</h1>
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar inline-block"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            
            17 Jul 2023, 16:00 - 18:00
          </p>
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin inline-block"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            
            Location
          </p>
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

    <section class="my-5">
      <h2 class="text-3xl font-bold my-3">Event Description</h2>
      <p>  
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores atque nemo necessitatibus consectetur maxime accusamus dignissimos commodi qui, mollitia harum fuga optio explicabo architecto corporis numquam nesciunt reprehenderit, maiores hic?
      </p>
    </section>

    <form>
      @if(true)
        <h2 class="text-3xl font-bold my-3">Questions</h2>
        <div class="mb-6">
          <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Why do you want to join?</label>
          <input type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
      @endif
      <button type="submit" class="w-full text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Submit</button>
    </form>
</div>
@endsection