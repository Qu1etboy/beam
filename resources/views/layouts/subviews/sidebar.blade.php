<aside class="px-3 py-10 lg:h-screen lg:overflow-y-auto w-full" style="background-color:#18181A">
  <div class="mb-6">
    <h2 class="text-white text-2xl px-2.5 font-bold">{{ $event->event_name }}</h2>
    @if ($event->is_published)
      <span class="bg-green-100 text-green-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded-full">Published</span>
    @else 
      <span class="bg-blue-100 text-blue-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded-full">Draft</span>
    @endif
  </div>
  <form action="{{ route('organizer.event.publish', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
    @csrf 
    @if ($event->is_published)
      <button type="submit" class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Unpublish</button>
    @else 
      <button type="submit" class="w-full focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Publish</button>    
    @endif 
    </button>
  </form>
  
  <div class="space-y-2 py-4 text-white">
    <a href="{{ route('organizer.event.dashboard',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.dashboard') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }} flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gauge"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
      Dashboard
    </a>
    <a href="{{ route('organizer.event.information',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.information') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }} flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
      Information
    </a>
    <a href="{{ route('question.index',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('question.index') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }} flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-question"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><path d="M10 10.3c.2-.4.5-.8.9-1a2.1 2.1 0 0 1 2.6.4c.3.4.5.8.5 1.3 0 1.3-2 2-2 2"/><path d="M12 17h.01"/></svg>
      Registrant Questions
    </a>
    <a href="{{ route('organizer.event.participants.submission',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.participants.*') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }} flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-2"><path d="M14 19a6 6 0 0 0-12 0"/><circle cx="8" cy="9" r="4"/><path d="M22 19a6 6 0 0 0-6-6 4 4 0 1 0 0-8"/></svg>
      Participants
    </a>
    <a href="{{ route('organizer.event.tasks.list',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.tasks.*') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }} flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M12 11h4"/><path d="M12 16h4"/><path d="M8 11h.01"/><path d="M8 16h.01"/></svg>
      Tasks
    </a>
    <a href="{{ route('organizer.event.financial',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.financial', 'orders.*') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }} flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dollar-sign"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
      Financial
    </a>
  </div>
</aside>