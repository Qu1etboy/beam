@extends('layouts.organizer')

@section('title', 'Create Event - Beam Organizer')

@section('content')
<div class="container mx-auto p-3">
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Settings</h1>
    <p class="text-gray-600">Update your organization informations</p>

    <form action="{{ route('organizer.update', ['organizer' => $organizer]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="flex gap-5 mt-6">
        <x-user-avatar :profile_url="$organizer->organizer_profile" class="w-20 h-20" />
        <div class="mb-6">
          <label for="profile" class="block mb-2 text-sm font-medium text-gray-900">Upload organization profile picture</label>
          <x-file-input accept="image/*" id="profile" name="profile" />
        </div>
      </div>
      <div class="mb-6">
        <x-input-label for="name" :value="__('Organization name')"/>
        <x-text-input id="name" name="name" value="{{ $organizer->organizer_name }}" placeholder="Enter your organization name" />
        <x-input-error :messages="$errors->get('name')" />
      </div>
      <x-buttons.primary type="submit" class="w-full">Save</x-buttons.primary> 
    </form>

    
    <h2 class="text-2xl mb-3 font-bold mt-8 text-red-800">Danger Zone</h2>
    <form action="{{ route('organizer.destroy', ['organizer' => $organizer ]) }}" method="POST" class="border border-red-800 text-red-800 p-3 rounded-lg">
      @csrf
      @method('delete')
      <p class="text-red-700 mb-6">Are you sure you want to delete your organization? Once your organization is deleted, all of its resources and data will be permanently deleted and can't be undone.</p>

      <button type="submit" onclick="return confirm('Are you sure you want to delete your organization? Once your organization is deleted, all of its resources and data will be permanently deleted and can\'t be undone.');" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Delete Organization</button>

    </form>

</div>
@endsection