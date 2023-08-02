@extends('layouts.base')

@section('body')
  @include('layouts.subviews.organizer-navbar', ['organizer' => $organizer])
  <main>
    @yield('content')
  </main>
@endsection 