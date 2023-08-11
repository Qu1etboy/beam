<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\RegistrantQuestion;
use Illuminate\Http\Request;

class RegistrantQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Organizer $organizer, Event $event)
    {
        $event = Event::with('registrantQuestions')->find($event->id);

        return view('organizer.event.question', compact('organizer', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Organizer $organizer, Event $event)
    {
        $request->validate([
            'q' => ['required', 'string', 'min:1', 'max:255']
        ]);

        $question = new RegistrantQuestion();
        $question->question = $request->get('q');

        $event->registrantQuestions()->save($question);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organizer $organizer, Event $event, RegistrantQuestion $question)
    {
        $request->validate([
            'q' => ['required', 'string', 'min:1', 'max:255']
        ]);

        $question->question = $request->get('q');
        $question->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizer $organizer, Event $event, RegistrantQuestion $question)
    {
        $question->delete();

        return redirect()->back();
    }
}