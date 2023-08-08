@extends('layouts.event')

@section('title', 'Financial - Beam Organizer')

@section('content')
<div class="p-3">
    <div class="flex flex-col md:flex-rowjustify-between">
      <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Financial</h1>
      <div class="flex items-center gap-3">
        <a href="{{ route('organizer.event.add-order', ['organizer' => $organizer->id, 'event' => $event->id]) }}" class="underline ">Add order</a>
        
        <x-dropdown align="right" width="48" class="print:hidden">
          <x-slot name="trigger">
              <x-buttons.primary type="submit" class="flex jutify-center items-center gap-2">
                <span>Export</span>
                <!-- Arrow down -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
              </x-buttons.primary>
          </x-slot>

          <x-slot name="content">
              <form id="pdf-form" action="{{ route('organizer.event.export-order-pdf', ['organizer' => $organizer->id, 'event' => $event])}}" method="POST">
                  @csrf
                  <x-dropdown-link :href="route('organizer.event.export-order-pdf', ['organizer' => $organizer->id, 'event' => $event])"
                          onclick="event.preventDefault(); document.getElementById('pdf-form').submit();">
                      {{ __('Export as PDF') }}
                  </x-dropdown-link>
              </form>
              <form id="csv-form" action="{{ route('organizer.event.export-order-csv', ['organizer' => $organizer->id, 'event' => $event])}}" method="POST">
                  @csrf
                  <x-dropdown-link :href="route('organizer.event.export-order-csv', ['organizer' => $organizer->id, 'event' => $event])"
                          onclick="event.preventDefault(); document.getElementById('csv-form').submit();">
                      {{ __('Export as CSV') }}
                  </x-dropdown-link>
              </form>
              {{-- <form action="{{ route('organizer.event.export-order-pdf', ['organizer' => $organizer->id, 'event' => $event])}}" method="POST">
                  @csrf
                  <x-dropdown-link :href="route('organizer.event.export-order-pdf', ['organizer' => $organizer->id, 'event' => $event])"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Export as PDF') }}
                  </x-dropdown-link>
              </form> --}}
              {{-- <form action="{{ route('organizer.event.export-order-csv', ['organizer' => $organizer->id, 'event' => $event])}}" method="POST">
                  @csrf
                  <x-dropdown-link :href="route('organizer.event.export-order-csv', ['organizer' => $organizer->id, 'event' => $event])"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Export as CSV') }}
                  </x-dropdown-link>
              </form> --}}
          </x-slot>
        </x-dropdown>
      </div>
    </div>

    <table class="w-full">
      <thead class="bg-gray-50 text-left">
        <tr>
          <th class="px-6 py-3">#</th>
          <th class="px-6 py-3">Detail</th>
          <th class="px-6 py-3">Cost</th>
        </tr>
      </thead>

      <tbody>
        @foreach($event->orders as $order)
          <tr>
            <td class="px-6 py-3">{{ $loop->iteration }}</td>
            <td class="px-6 py-3">{{ $order->detail }}</td>
            <td class="px-6 py-3">{{ $order->cost }}</td>
          </tr>  
        @endforeach
      </tbody>
    
    </table>

    <div class="text-right mt-3">
      <p>Total cost : {{ $event->getTotalOrderCost() }} Baht</p>
    </div>

</div>
@endsection