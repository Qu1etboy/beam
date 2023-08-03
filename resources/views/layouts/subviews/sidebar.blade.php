<aside class="px-3 py-10 bg-white">
  <h2 class="text-2xl px-2.5 font-bold">{{ $event->event_name }}</h2>
  <div class="space-y-2 py-4">
    <a href="{{ route('organizer.event.dashboard',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.dashboard') ? 'bg-purple-200 block hover:bg-purple-300 rounded-lg px-2.5 py-3' : 'block hover:bg-gray-100 rounded-lg px-2.5 py-3' }}">Dashboard</a>
    <a href="{{ route('organizer.event.information',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.information') ? 'bg-purple-200 block hover:bg-purple-300 rounded-lg px-2.5 py-3' : 'block hover:bg-gray-100 rounded-lg px-2.5 py-3' }}">Information</a>
    <a href="{{ route('organizer.event.participants',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.participants') ? 'bg-purple-200 block hover:bg-purple-300 rounded-lg px-2.5 py-3' : 'block hover:bg-gray-100 rounded-lg px-2.5 py-3' }}">Participants</a>
    <a href="{{ route('organizer.event.tasks.list',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.tasks.list') ? 'bg-purple-200 block hover:bg-purple-300 rounded-lg px-2.5 py-3' : 'block hover:bg-gray-100 rounded-lg px-2.5 py-3' }}">Tasks</a>
    <a href="{{ route('organizer.event.financial',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="{{ request()->routeIs('organizer.event.financial') ? 'bg-purple-200 block hover:bg-purple-300 rounded-lg px-2.5 py-3' : 'block hover:bg-gray-100 rounded-lg px-2.5 py-3' }}">Financial</a>
  </div>
</aside>