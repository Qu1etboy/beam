@extends('layouts.base')

@section('body')
    <main>
        <div class="lg:grid lg:grid-cols-5 w-full lg:h-screen">
            <div class="hidden lg:block">
                @include('layouts.subviews.sidebar')
            </div>
            <div class="col-span-4 lg:overflow-y-auto">
                <div class="top-0">
                    @include('layouts.subviews.organizer-navbar', ['organizer' => $organizer])
                    
                    <!-- Mobile Sidebar -->
                    <div class="hidden lg:hidden" id="mobile-sidebar">
                        @include('layouts.subviews.sidebar')
                    </div>
                </div>
                
                <div class="p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-sidebar');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden')
            } else {
                menu.classList.add('hidden')
            }
        }
    </script>
@endsection
