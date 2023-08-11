@extends('layouts.event')

@section('title', 'Dashboard - Beam Organizer')

@section('content')
<div class="p-3">
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Registrant Questions</h1>
    <p class="text-gray-600 mb-4">Optionally you can add questions for registrants to answer before they can register for an event.</p>

    {{-- Display Questions --}}
    @foreach($event->registrantQuestions as $question)
      <div class="flex justify-between border rounded-md p-3 mb-3 gap-3" x-data="{ editing: false}">
        
        <template x-if="!editing">
          <h2 class="text-lg mt-1">{{ $loop->iteration }}. {{ $question->question }}</h2>
        </template>
        
        <template x-if="editing">
          <form action="{{ route('question.update', ['question' => $question, 'organizer' => $organizer, 'event' => $event] ) }}" method="POST" class="w-full">
            @csrf
            @method('put')
            <div class="mb-3">
              <x-input-label for="q" :value="__('Edit your question')"/>
              <x-text-input id="q" name="q" value="{{ $question->question }}"/>
              <x-input-error :messages="$errors->get('q')" />
            </div>
            <x-buttons.primary>Save</x-buttons.primary>
          </form>
        </template>
        
        <div class="flex items-start space-x-2 mt-1">
          
          <template x-if="editing">
            <button @click="editing = false" class="flex items-center gap-1 hover:bg-gray-100 rounded-md duration-300 py-1 px-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen-square"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
              <span>Cancel</span>
            </button>
          </template>

          <template x-if="!editing">
            <button @click="editing = true" class="flex items-center gap-1 hover:bg-gray-100 rounded-md duration-300 py-1 px-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen-square"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
              <span>Edit</span>
            </button>
          </template>
          
          <form action="{{ route('question.destroy', ['question' => $question, 'organizer' => $organizer, 'event' => $event]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="text-red-600 flex items-center gap-1 hover:bg-gray-100 rounded-md duration-300 p-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
              <span>Delete</span>
            </button>
          </form>
        </div>
      </div>
    @endforeach

    <form action="{{ route('question.store', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
      @csrf
      <div class="border rounded-md p-3">
        <div class="flex items-center gap-3 mb-5">
          <h2 class="text-xl font-bold">Question 
          <span class="text-sm text-gray-600">(Optional)</span>
          </h2>
        </div>
        <div>
          <div class="mb-6">
            <x-input-label for="q" :value="__('Question')"/>
            <x-text-input id="q" name="q" />
            <x-input-error :messages="$errors->get('q')" />
          </div>
        </div>
        <x-buttons.primary>Add more questions</x-buttons.primary>
      </div>
    </form>

</div>
@endsection