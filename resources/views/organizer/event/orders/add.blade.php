@extends('layouts.event')

@section('title', 'Add ' . $event->event_name . "'s " . 'Order - Beam Organizer')

@section('content')
<div class="p-3">
    <a href="{{ route('organizer.event.financial',['organizer' => $organizer->id, 'event' => $event->id]) }}" class="flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
      Back
    </a>
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Add Order</h1>

    <form action="{{ route('orders.store', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
      @csrf
      <div class="mb-6">
        <label for="detail" class="block mb-2 text-sm font-medium text-gray-900">Detail</label>
        <input type="text" id="detail" name="detail" value="{{ old('detail', '') }}" placeholder="Detail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <x-input-error :messages="$errors->get('detail')" />

      </div>
      <div class="mb-6">
        <label for="cost" class="block mb-2 text-sm font-medium text-gray-900">Cost</label>
        <input type="number" min="0" id="cost" name="cost" value="{{ old('cost', '') }}" placeholder="Cost" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <x-input-error :messages="$errors->get('cost')" />
      </div>

       <x-buttons.primary type="submit">Add order</x-buttons.primary>
    </form>

</div>
@endsection