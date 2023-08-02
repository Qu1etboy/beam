@extends('layouts.event')

@section('title', 'Add order - Beam Organizer')

@section('sub-content')
<div class="p-3">
    <h1 class="font-bold text-4xl my-3">Add Order</h1>

    <form>
      <div class="mb-6">
        <label for="detail" class="block mb-2 text-sm font-medium text-gray-900">Detail</label>
        <input type="text" id="detail" placeholder="Detail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>
      <div class="mb-6">
        <label for="cost" class="block mb-2 text-sm font-medium text-gray-900">Cost</label>
        <input type="number" min="0" id="cost" placeholder="Cost" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>

       <x-buttons.primary type="submit">Add order</x-buttons.primary>
    </form>

</div>
@endsection