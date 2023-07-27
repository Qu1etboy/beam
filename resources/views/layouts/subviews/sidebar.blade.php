<aside class="px-3 py-10 bg-white">
  <h2 class="text-2xl px-2.5 font-bold">Event Name</h2>
  <div class="space-y-2 py-4">
    <a href="{{ route('organizer.event.dashboard') }}" class="block hover:bg-gray-100 rounded-lg px-2.5 py-3">Dashboard</a>
    <a href="{{ route('organizer.event.information') }}" class="block hover:bg-gray-100 rounded-lg px-2.5 py-3">Information</a>
    <a href="{{ route('organizer.event.participants') }}" class="block hover:bg-gray-100 rounded-lg px-2.5 py-3">Participants</a>
    <a href="{{ route('organizer.event.tasks.list') }}" class="block hover:bg-gray-100 rounded-lg px-2.5 py-3">Tasks</a>
    <a href="{{ route('organizer.event.financial') }}" class="block hover:bg-gray-100 rounded-lg px-2.5 py-3">Financial</a>
  </div>
</aside>