@extends('layouts.event')

@section('sub-content')
<div class="p-3">
    <div class="flex justify-between">
      <h1 class="font-bold text-4xl my-3">Financial</h1>
      <div class="flex items-center gap-3">
        <a href="{{ route('organizer.event.add-order') }}" class="underline ">Add order</a>
        <form>
          <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">Export</button>
        </form>
      </div>
    </div>

    <table class="w-full">
      <thead class="bg-gray-50 text-left">
        <tr>
          <th class="px-6 py-3">Id</th>
          <th class="px-6 py-3">Detail</th>
          <th class="px-6 py-3">Cost</th>
        </tr>
      </thead>

      <tbody>
        @for($i = 0; $i < 5; $i++)
          <tr>
            <td class="px-6 py-3">{{ $i }}</td>
            <td class="px-6 py-3">ป้ายไวนิล</td>
            <td class="px-6 py-3">40</td>
          </tr>  
        @endfor
      </tbody>
    
    </table>

    <div class="text-right mt-3">
      <p>Total cost : 999 Baht</p>
    </div>

</div>
@endsection