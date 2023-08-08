@extends('layouts.main')

@section('title', 'Settings - Beam')


@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-4xl my-3">My Account</h1>

    <form action="{{ route('settings.update', Auth::user()) }}" method="POST" enctype="multipart/form-data" class="mt-8">
      @csrf
      @method('PUT')
      <div>
        <div class="flex gap-5">
          <x-user-avatar :profile_url="Auth::user()->avatar" class="w-20 h-20" />
          <div class="mb-6">
            <label for="profile" class="block mb-2 text-sm font-medium text-gray-900">Upload profile picture</label>
            <x-file-input accept="image/*" id="profile" name="profile" />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-3">

          <div class="mb-6">
            <x-input-label for="first-name" :value="__('First name')"/>
            <x-text-input id="first-name" name="first_name" placeholder="Enter your first name" value="{{ $first_name }}"/>
            <x-input-error :messages="$errors->get('first_name')" />
          </div>

          <div class="mb-6">
            <x-input-label for="last-name" :value="__('Last name')"/>
            <x-text-input id="last-name" name="last_name" placeholder="Enter your last name" value="{{ $last_name }}"/>
            <x-input-error :messages="$errors->get('last_name')" />
          </div>

          <div class="mb-6">
            <x-input-label for="socials" :value="__('Socials')"/>
            <x-text-input id="socials" name="socials" placeholder="Facebook, Instagram, Line" value="{{ Auth::user()->social }}"/>
            <x-input-error :messages="$errors->get('socials')" />
          </div>

          <div class="mb-6">
            <x-input-label for="certificates" :value="__('Upload certificates')"/>
            <x-file-input accept="image/*" id="certificate" name="certificates" />
            <x-input-error :messages="$errors->get('certificates')" />
          </div>
        </div>
      </div>

      <button type="submit" class="text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Save changed</button>
    
    </form>

</div>
@endsection