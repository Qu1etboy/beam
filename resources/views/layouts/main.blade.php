@extends('layouts.base')

@section('body')
    @include('layouts.subviews.navbar')
    <main>
        @yield('content')
    </main>
    <x-footer />
@endsection 
