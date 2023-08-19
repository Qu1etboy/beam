<header class="py-3 px-6 border-b bg-white">
  <nav class="lg:container mx-auto flex justify-between items-center">
    <div class="relative flex items-end gap-5">
        <a href="{{ route('organizer.events', ['organizer' => $organizer] ) }}" class="text-3xl font-bold py-1">Beam <span class="text-base">for <span class="text-purple-800">Organizer</span></span></a>

        <div class="gap-1 hidden lg:flex items-end">
            <svg class="text-gray-300 my-1" data-testid="geist-icon" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="24" ><path d="M16.88 3.549L7.12 20.451"></path></svg>
            
            <x-dropdown align="right" width="48" class="z-20">
                <x-slot name="trigger">
                    <button class="flex items-center gap-2 hover:bg-gray-100 px-2 py-1 duration-300 rounded-md">
                        <x-user-avatar :profile_url="$organizer->organizer_profile" class="w-7 h-7" />
                        <span>{{ $organizer->organizer_name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-400" aria-hidden="true"><path d="m7 15 5 5 5-5"></path><path d="m7 9 5-5 5 5"></path></svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <h2 class="text-sm text-gray-600 px-4 pt-4 mb-2">Your organizations</h2>
                    
                    @foreach(Auth::user()->joinedOrganizations as $joinedOrganization)
                        <x-dropdown-link :href="route('organizer.events', ['organizer' => $joinedOrganization])" class="flex items-center gap-2">
                            <x-user-avatar :profile_url="$joinedOrganization->organizer_profile" class="w-7 h-7" />
                            {{ $joinedOrganization->organizer_name }}
                            @if ($joinedOrganization->id === $organizer->id)
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><polyline points="20 6 9 17 4 12"/></svg>
                            @endif
                        </x-dropdown-link>
                    @endforeach

                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <div class="flex items-center lg:gap-5">

      <ul class="hidden lg:flex items-center gap-5">
        <li><a href="{{ route('organizer.events', ['organizer' => $organizer]) }}" class="hover:text-purple-500 duration-300">Events</a></li>
        <li><a href="{{ route('organizer.members', ['organizer' => $organizer]) }}" class="hover:text-purple-500 duration-300">Members</a></li>
        @can('update', $organizer)
            <li><a href="{{ route('organizer.edit', ['organizer' => $organizer]) }}" class="hover:text-purple-500 duration-300">Settings</a></li>
        @endcan
      </ul>
    
      @auth
          <div class="flex items-center gap-3">
            <div>
                  <x-dropdown align="right" width="48" class="z-20">
                      <x-slot name="trigger">
                          <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <x-user-avatar :profile_url="Auth::user()->avatar" class="w-10 h-10" />
                          </button>
                      </x-slot>

                      <x-slot name="content">
                          <h2 class="text-sm px-4 pt-4">{{ Auth::user()->name }}</h2>
                          <p  class="text-gray-500 text-xs px-4 pb-3">{{ Auth::user()->email }}</p>
                           <x-dropdown-link :href="route('index')" class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                {{ __('Back To Main Site') }}
                            </x-dropdown-link>

                           <x-dropdown-link :href="route('organizer.home')" class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building-2"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                                {{ __('My Organization') }}
                            </x-dropdown-link>
                          
                          <x-dropdown-link :href="route('orders')" class="flex items-center gap-2">
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                              {{ __('My Orders') }}
                          </x-dropdown-link>

                          <x-dropdown-link :href="route('settings')" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                              {{ __('Settings') }}
                          </x-dropdown-link>

                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf

                              <x-dropdown-link :href="route('logout')"
                                      onclick="event.preventDefault();
                                                  this.closest('form').submit();" class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                  {{ __('Log Out') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
              </div>
          </div>
      @else
          <a href="{{ url('/auth/google') }}" class="text-white bg-black hover:bg-black/90 focus:ring-4 focus:outline-none focus:ring-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2">
              <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                  <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
              </svg>
              Sign in with Google
          </a>
      @endauth

        <x-menu-toggle onclick="toggleMenu()" class="block lg:hidden" />
    </div>



  </nav>
</header>

<div class="hidden lg:hidden" id="menu">
    @include('layouts.subviews.organizer-navbar-mobile')
</div>

<script>
function toggleMenu() {
    const menu = document.getElementById('menu');
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
    } else {
        menu.classList.add('hidden');
    }
}
</script>