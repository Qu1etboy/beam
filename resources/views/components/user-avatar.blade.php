@props([
  'profile_url'
])

<img 
  src="{{ file_exists('storage/' . $profile_url) ? asset('storage/' . $profile_url) : $profile_url }}" 
  alt="user avatar" 
  onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541'"
  {!! $attributes->merge(['class' => 'rounded-full object-cover']) !!}
>