@extends('layouts.base')

@section('body')
    <main>
        <div class="grid lg:grid-cols-5 w-full">
            @include('layouts.subviews.sidebar')
            <div class="col-span-4">
                @include('layouts.subviews.organizer-navbar', ['organizer' => $organizer])
                <div class="p-4">
                    @yield('sub-content')
                </div>
            </div>
        </div>
    </main>
@endsection
