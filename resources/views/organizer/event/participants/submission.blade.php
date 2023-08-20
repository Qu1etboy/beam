@extends('layouts.event')

@section('title', 'Participants - Beam Organizer')

@section('content')
<div class="p-3">
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl my-3">Participants</h1>
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
      <ul class="flex flex-wrap -mb-px">
          <li class="mr-2">
              <a href="{{ route('organizer.event.participants.submission', ['organizer' => $organizer, 'event' => $event]) }}" class="inline-block p-4 text-purple-600 border-purple-600 border-b-2 rounded-t-lg">Submission</a>
          </li>
          <li class="mr-2">
              <a href="{{ route('organizer.event.participants.accepted', ['organizer' => $organizer, 'event' => $event]) }}" class="inline-block p-4 hover:text-gray-600 hover:border-gray-300 border-transparent marker:border-b-2 rounded-t-lg active" aria-current="page">Accepted</a>
          </li>
      </ul>

      <div>
        <p>
          Before accept or reject the candidate you can write a draft email to use for sending to everyone. 
          If you not write it. We will use a default template for you
        </p>
        <a href="{{ route('organizer.event.participants.email', ['organizer' => $organizer, 'event' => $event]) }}">Draft Email</a>
      </div>

    </div>

    <div class="overflow-x-auto" 
      x-data="{ 
        show: false ,
        user: null,
        question: null,
        viewParticipantDetail(user, question) {
          this.user = user;
          this.question = question;
          console.log(question);
          this.show = true;
        }
      }"
      >
      <table class="w-full">
        <thead class="bg-gray-50 text-left">
          <tr>
            <th class="px-6 py-3">Avatar</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($participants as $participant)
            <tr>
              <td class="px-6 py-3">
                <x-user-avatar :profile_url="$participant->avatar" class="h-10 w-10" />
                <button @click="viewParticipantDetail(@js($participant), @js($participant->registrantQuestions))" class="underline hover:text-purple-600 text-sm">View Details</button>
              </td>
              <td class="px-6 py-3">{{ $participant->name }}</td>
              <td class="px-6 py-3">{{ $participant->email }}</td>
              <td class="flex items-center gap-2 px-6 py-3">
                <form action="{{ route('organizer.event.set-participants-status', ['organizer' => $organizer, 'event' => $event])}}" method="POST"> 
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="user_id" value="{{ $participant->id }}"/>
                  <input type="hidden" name="status" value="ACCEPTED"/>
                  <button type="submit" class="bg-green-500 hover:bg-green-600 duration-300 rounded-lg px-3 py-2 text-gray-100">Accept</button>
                </form>
                <form action="{{ route('organizer.event.set-participants-status', ['organizer' => $organizer, 'event' => $event])}}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="user_id" value="{{ $participant->id }}"/>
                  <input type="hidden" name="status" value="REJECTED"/>
                  <button class="bg-red-500 hover:bg-red-600 duration-300 rounded-lg px-3 py-2 text-gray-100">Reject</button>
                </form>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>

      <!-- Submission details dialog -->
      <x-modal :name="__('Dialog')">
        <div class="relative p-6 max-h-[600px] overflow-y-auto">
          <button @click="show = false" class="absolute top-0 right-0 m-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
          <h2 class="text-lg md:text-xl font-bold mb-3">Submission Details</h2>
          <div class="space-y-3">
            <div>
              <span class="text-sm text-gray-600">Name</span>
              <div x-text="user.name" class="text-gray-900"></div>
            </div>
            <div>
              <span class="text-sm text-gray-600">Email</span>
              <div x-text="user.email" class="text-gray-900"></div>
            </div>
            <div>
              <span class="text-sm text-gray-600">Social</span>
              <div x-text="user.social ?? '-'" class="text-gray-900"></div>
            </div>
            <div>
              <span class="text-sm text-gray-600">About</span>
              <div x-text="user.about ?? '-'" class="prose"></div>
            </div>
          </div>

          <template x-if="question.length > 0">
            <h2 class="text-lg font-semibold my-3">Response</h2>
          </template>
          <template x-for="q of question"">
            <div class="mb-2">
              <div x-text="q.question" class="block mb-2 text-sm font-medium text-gray-900"></div>
              <div x-text="q.pivot.answer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
            </div>
          </template>

        </div>
      </x-modal>

    </div>
</div>


@endsection