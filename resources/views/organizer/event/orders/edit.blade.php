@extends('layouts.event')

@section('title', 'Add order - Beam Organizer')

@section('content')
<div class="p-3">
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Edit Order</h1>

    <form action="{{ route('orders.update', ['order' => $order, 'organizer' => $organizer, 'event' => $event]) }}" method="POST">
      @csrf
      @method('put')
      <div class="mb-6">
        <label for="detail" class="block mb-2 text-sm font-medium text-gray-900">Detail</label>
        <input type="text" id="detail" name="detail" placeholder="Detail" value="{{ $order->detail }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <x-input-error :messages="$errors->get('detail')" />

      </div>
      <div class="mb-6">
        <label for="cost" class="block mb-2 text-sm font-medium text-gray-900">Cost</label>
        <input type="number" min="0" id="cost" name="cost" placeholder="Cost" value="{{ $order->cost }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <x-input-error :messages="$errors->get('cost')" />
      </div>

       <x-buttons.primary type="submit">Save</x-buttons.primary>
    </form>

</div>
@endsection