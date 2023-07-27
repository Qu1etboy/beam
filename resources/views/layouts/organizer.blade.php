@extends('layouts.base')

@section('body')
  @include('layouts.subviews.organizer-navbar')
  <main>
    @yield('content')
  </main>
@endsection 