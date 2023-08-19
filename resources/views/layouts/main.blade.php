@extends('layouts.base')

@section('body')
<div class="flex flex-col min-h-screen">
    @include('layouts.subviews.navbar')
    <main class="flex-grow">
        @yield('content')
    </main>
    <x-footer />
</div>
@endsection
