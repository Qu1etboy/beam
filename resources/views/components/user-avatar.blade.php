@props([
  'profile_url'
])

<img src="{{ file_exists('storage/' . $profile_url) ? asset('storage/' . $profile_url) : $profile_url }}" alt="user avatar" {!! $attributes->merge(['class' => 'rounded-full object-cover']) !!}>