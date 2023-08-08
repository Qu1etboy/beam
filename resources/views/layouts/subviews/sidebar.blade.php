<aside class="px-3 py-10 h-screen overflow-y-auto" style="background-color:#18181A">
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
    <a href="{{ route('organizer.event.dashboard',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.dashboard') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }}">Dashboard</a>
    <a href="{{ route('organizer.event.information',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.information') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }}">Information</a>
    <a href="{{ route('organizer.event.participants.submission',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.participants') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }}">Participants</a>
    <a href="{{ route('organizer.event.tasks.list',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.tasks.list') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }}">Tasks</a>
    <a href="{{ route('organizer.event.financial',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.financial') ? 'bg-purple-600 block hover:bg-purple-900 rounded-lg px-2.5 py-3' : 'block hover:bg-purple-900 rounded-lg px-2.5 py-3' }}">Financial</a>
  </div>
</aside>