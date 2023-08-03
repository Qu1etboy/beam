@extends('layouts.event')

@section('title', 'Financial - Beam Organizer')

@section('sub-content')
<div class="p-3">
    <div class="flex justify-between">
      <h1 class="font-bold text-4xl my-3">Financial</h1>
      <div class="flex items-center gap-3">
        <a href="{{ route('organizer.event.add-order', ['organizer' => $organizer->id, 'event' => $event->id]) }}" class="underline ">Add order</a>
        <form>
          <x-buttons.primary type="submit">Export</x-buttons.primary>
        </form> 
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