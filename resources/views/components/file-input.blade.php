@props(['disabled' => false])

<input type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none block w-full file:bg-gray-100 file:mr-4 file:border-0 file:transparent file:py-3 file:px-4']) !!}>
