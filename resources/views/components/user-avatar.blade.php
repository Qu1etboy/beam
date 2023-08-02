@props([
  'profile_url'
])

{{-- If profile url is from google use that directly --}}
@if (strpos($profile_url, 'googleusercontent') !== false)
  <img src="{{ $profile_url }}" alt="user avatar" {!! $attributes->merge(['class' => 'rounded-full object-cover']) !!}>
@else 
{{-- Otherwise need to convert from our url --}}
  <img src="{{ asset('storage/' . $profile_url) }}" alt="user avatar" {!! $attributes->merge(['class' => 'rounded-full object-cover']) !!}>
@endif