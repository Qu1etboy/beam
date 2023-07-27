<header class="p-3 border-b">
  <nav class="container mx-auto flex justify-between items-center">
    <div class="flex gap-5">
      <a href="{{ route('index') }}" class="text-3xl font-bold">Beam</a>
    </div>

    <div class="flex items-center gap-5">

      <ul class="flex items-center gap-5">
        <li><a href="{{ route('organizer.events') }}">Events</a></li>
        <li><a href="{{ route('organizer.members') }}">Members</a></li>
      </ul>
    
      @auth
          <div class="flex items-center gap-3">
            <div>
                  <x-dropdown align="right" width="48">
                      <x-slot name="trigger">
                          <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                              <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=928&q=80" alt="user avatar" class="rounded-full object-cover h-10 w-10">
                          </button>
                      </x-slot>

                      <x-slot name="content">
                          <h2 class="text-sm px-4 py-3">{{ Auth::user()->name }}</h2>
                          {{-- <x-dropdown-link :href="route('profile.edit')">
                              {{ __('Profile') }}
                          </x-dropdown-link> --}}

                          <x-dropdown-link :href="route('orders')">
                              {{ __('My Orders') }}
                          </x-dropdown-link>

                          <x-dropdown-link :href="route('settings')">
                              {{ __('Settings') }}
                          </x-dropdown-link>

                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf

                              <x-dropdown-link :href="route('logout')"
                                      onclick="event.preventDefault();
                                                  this.closest('form').submit();">
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
    </div>



  </nav>
</header>