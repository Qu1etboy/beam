@extends('layouts.event')

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

      <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add order</button>
    </form>

</div>
@endsection