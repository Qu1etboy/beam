@extends('layouts.event')

@section('title', 'Draft Email - Beam Organizer')

@section('content')
<div class="p-3">
    <a href="{{ url()->previous() }}" class="flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
      Back
    </a>
    <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl mt-3 mb-6">Draft Email</h1>
    
    <div x-data="{ tab1: true }"> 
        <nav>
            <ul class="flex gap-5 border-b mb-3">
                <li>
                    <button @click="tab1 = true" class="pb-3" :class=" tab1 ? 'border-b border-purple-600 text-purple-600' : '' ">Accepted Email</button>
                </li>
                <li>
                    <button @click="tab1 = false" class="pb-3" :class=" !tab1 ? 'border-b border-purple-600 text-purple-600' : '' ">Rejected Email</button>
                </li>
            
            </ul>
        </nav>

        <template x-if="tab1">
            <div>
                <h2 class="text-xl">Write your accepted email</h2>
                <p class="text-gray-600 mb-3">Started by modifying the default email template below used for sending to accepted candidates</p>

                <div class="mb-6 text-gray-600">
                    <span>Special symbol for insert user name and event detail</span>
                    <ul class="mt-1 text-sm">
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ user.name }</code> - user name</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.name }</code> - event name</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.start_date }</code> - event start date</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.end_date }</code> - event end date</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.location }</code> - event location</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.organizer_name }</code> - event organizer name</li>
                    </ul>
                </div>

                <form class="space-y-3" action="{{ route('organizer.event.participants.email.accepted', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
                    @csrf
                    {{-- <div>
                        <x-input-label for="accepeted_email_subject" :value="__('From (owner email)')"/>
                        <div>{{ $organizer->owner->email }}</div>                        
                    </div>
                    <div>
                        <x-input-label for="accepeted_email_subject" :value="__('To')"/>
                        <div>Candidate email</div>                        
                    </div> --}}
                    <div>
                        <x-input-label for="accepeted_email_subject" :value="__('Subject')"/>
                        <x-text-input id="accepeted_email_subject" name="accepeted_email_subject" value="{{ $event->accepeted_email_subject ? $event->accepeted_email_subject : App\Models\Event::$DEFAULT_ACCEPTED_MAIL_SUBJECT }}" placeholder="Email subject" />
                        <x-input-error :messages="$errors->get('accepeted_email_subject')" />
                    </div>
                    <div>
                        <label for="accepeted_email_body" class="block mb-2 text-sm font-medium text-gray-900">Body</label>
                        <div x-data="editor(@js($event->accepeted_email_body ? $event->accepeted_email_body : App\Models\Event::$DEFAULT_ACCEPTED_MAIL_BODY), 'accepeted_email_body')">
                            <x-rich-text-editor />
                            <input :id="id" type="hidden" name="accepeted_email_body" />
                            <x-input-error :messages="$errors->get('accepeted_email_body')" />
                        </div>
                        
                    </div>
                    
                    <x-buttons.primary type="submit">Save</x-buttons.primary>
                </form>

            </div>
      
        </template>

        <template x-if="!tab1">
            <div>
                <h2 class="text-xl">Write your rejected email</h2>
                <p class="text-gray-600 mb-3">Started by modifying the default email template below used for sending to rejected candidates</p>

                <div class="mb-6 text-gray-600">
                    <span>Special symbol for insert user name and event detail</span>
                    <ul class="mt-1 text-sm">
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ user.name }</code> - user name</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.name }</code> - event name</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.start_date }</code> - event start date</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.end_date }</code> - event end date</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.location }</code> - event location</li>
                        <li><code class="bg-gray-100 text-purple-600 p-1">{ event.organizer_name }</code> - event organizer name</li>
                    </ul>
                </div>

                <form  class="space-y-3" action="{{ route('organizer.event.participants.email.rejected', ['organizer' => $organizer, 'event' => $event]) }}" method="POST">
                    @csrf
                    {{-- <div>
                        <x-input-label :value="__('From (owner email)')"/>
                        <div>{{ $organizer->owner->email }}</div>                        
                    </div>
                    <div>
                        <x-input-label :value="__('To')"/>
                        <div>Candidate email</div>                        
                    </div> --}}
                    <div>
                        <x-input-label for="rejected_email_subject" :value="__('Subject')"/>
                        <x-text-input id="rejected_email_subject" name="rejected_email_subject" value="{{ $event->rejected_email_subject ? $event->rejected_email_subject : App\Models\Event::$DEFAULT_REJECTED_MAIL_SUBJECT }}" placeholder="Email subject" />
                        <x-input-error :messages="$errors->get('rejected_email_subject')" />
                    </div>
                    <div>
                        <label for="rejected_email_body" class="block mb-2 text-sm font-medium text-gray-900">Body</label>
                        <div x-data="editor(@js($event->rejected_email_body ? $event->rejected_email_body : App\Models\Event::$DEFAULT_REJECTED_MAIL_BODY), 'rejected_email_body')">
                            <x-rich-text-editor />
                            <input :id="id" type="hidden" name="rejected_email_body" />
                            <x-input-error :messages="$errors->get('rejected_email_body')" />
                        </div>
                    </div>
                    <x-buttons.primary type="submit">Save</x-buttons.primary>
                </form>

            </div>
        </template>


    </div>


</div>


@endsection