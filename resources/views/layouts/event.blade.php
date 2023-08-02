@extends('layouts.base')

@section('body')
  @include('layouts.subviews.organizer-navbar', ['organizer' => $organizer])
  <main>
    <div class="grid lg:grid-cols-5 w-full">
      @include('layouts.subviews.sidebar')
      <div class="p-4 col-span-4">
        @yield('sub-content')
      </div>
    </div>
  </main>
@endsection 