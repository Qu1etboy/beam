@extends('layouts.event')

@section('title', $event->event_name . "'s " . 'Financial - Beam Organizer')

@section('content')
<div class="p-3">
    <div class="flex flex-col md:flex-row justify-between">
      <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Financial</h1>
      <div class="flex items-center gap-3">
        <a href="{{ route('orders.create', ['organizer' => $organizer->id, 'event' => $event->id]) }}" class="underline ">Add order</a>
        
        <x-dropdown align="right" width="48" class="">
          <x-slot name="trigger">
              <x-buttons.primary type="submit" class="flex jutify-center items-center gap-2">
                <span>Export</span>
                <!-- Arrow down -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
              </x-buttons.primary>
          </x-slot>

          <x-slot name="content">
              <form id="pdf-form" action="{{ route('orders.export-order-pdf', ['organizer' => $organizer->id, 'event' => $event])}}" method="POST">
                  @csrf
                  <x-dropdown-link :href="route('orders.export-order-pdf', ['organizer' => $organizer->id, 'event' => $event])"
                          onclick="event.preventDefault(); document.getElementById('pdf-form').submit();">
                      {{ __('Export as PDF') }}
                  </x-dropdown-link>
              </form>
              <form id="csv-form" action="{{ route('orders.export-order-csv', ['organizer' => $organizer->id, 'event' => $event])}}" method="POST">
                  @csrf
                  <x-dropdown-link :href="route('orders.export-order-csv', ['organizer' => $organizer->id, 'event' => $event])"
                          onclick="event.preventDefault(); document.getElementById('csv-form').submit();">
                      {{ __('Export as CSV') }}
                  </x-dropdown-link>
              </form>
          </x-slot>
        </x-dropdown>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="text-left border-b">
          <tr>
            <th class="px-6 py-3">#</th>
            <th class="px-6 py-3">Detail</th>
            <th class="px-6 py-3">Cost</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>

        <tbody>
          @foreach($event->orders as $order)
            <tr>
              <td class="px-6 py-3">{{ $loop->iteration }}</td>
              <td class="px-6 py-3">{{ $order->detail }}</td>
              <td class="px-6 py-3">{{ $order->cost }}</td>
              <td class="px-6 py-3 flex">
                <a href="{{ route('orders.edit', ['order' => $order, 'organizer' => $organizer, 'event' => $event]) }}" class="flex items-center gap-1 hover:bg-gray-100 rounded-md duration-300 py-1 px-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen-square"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                  <span>Edit</span>
                </a>

                <form action="{{ route('orders.destroy', ['order' => $order, 'organizer' => $organizer, 'event' => $event]) }}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" onclick="return confirm('Are you sure you want to delete this order?');" class="text-red-600 flex items-center gap-1 hover:bg-gray-100 rounded-md duration-300 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    <span>Delete</span>
                  </button>
                </form>
              
              </td>
            </tr>  
          @endforeach
        </tbody>
      
      </table>
    </div>

    <div class="text-right mt-3">
      <p>Total cost : {{ $event->getTotalOrderCost() }} Baht</p>
    </div>

</div>
@endsection