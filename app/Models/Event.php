<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Event extends Model
{
    use HasFactory, Searchable;

    public static string $DEFAULT_ACCEPTED_MAIL_SUBJECT = "Your application's result for { event.name }";
    public static string $DEFAULT_ACCEPTED_MAIL_BODY = "<p>Dear { user.name },</p><p>We are excited to inform you that your application for the { event.name } has been accepted! Congratulations on this accomplishment.</p><p>Event Details</p><ul>    <li>Event Name: { event.name }</li>    <li>Date: from { event.start_date } to { event.end_date }</li>    <li>Location: { event.location }</li></ul><p>Your dedication and enthusiasm stood out to us during the selection process, and we believe that your participation will contribute greatly to the success of the event.</p><p>Thank you for choosing Beam as your partner in event organization. We're excited to embark on this journey together and create unforgettable experiences. Here's to a future filled with successful events and wonderful memories!</p><p>Best regards,</p><p>{ event.organizer_name }</p>";
    
    public static string $DEFAULT_REJECTED_MAIL_SUBJECT = "Your application's result for { event.name }";
    public static string $DEFAULT_REJECTED_MAIL_BODY = "<p>Dear { user.namme },</p><p>    I trust this email finds you well. Thank you for taking the time to apply for participation in { event.name }. We appreciate your interest in being a part of this event.</p><p>    After careful consideration and a thorough review of all applications, we regret to inform you that your application for participation has not been selected on this occasion. We understand the dedication and effort you put into your application, and we want to assure you that this decision was not made lightly.</p><p>    Our selection process was highly competitive, and unfortunately, we had a limited number of spots available. Please know that your application stood out, and we were impressed by your abilities.</p><p>    We genuinely appreciate your interest in { event.name } and the enthusiasm you expressed in your application. We encourage you to continue pursuing your passion and goals, and we hope that you'll consider applying for future events organized by us.</p><p>    Thank you once again for considering { event.name }. We wish you all the best in your future endeavors and hope to cross paths in the future.</p><p>Best regards,</p><p>{ event.organizer_name }</p>";

    protected $fillable = [
        'organizer_id',
        'event_name',
        'event_description',
        'poster_image',
        'location',
        'registrant_questions',
    ];

    // public function toSearchableArray()
    // {
    //     return [
    //         'id' => (int) $this->id,
    //         'event_name' => $this->event_name,
    //         'is_published' => (bool) $this->is_published,
    //     ];
    // }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'event_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'event_id');
    }

    public function registrantQuestions()
    {
        return $this->hasMany(RegistrantQuestion::class, 'event_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id')
            ->withPivot('status');
    }

    /**
     * Find a total cost of order in specified event
     */
    public function getTotalOrderCost() {
        return $this->orders->pluck('cost')->reduce(function ($carry, $num) {
            return $carry + $num;
        }, 0);
    }

    public function countAcceptedParticipants($eventId) {
        $events = $this::with(['participants' => function ($query) {
            $query->where('status', '=', 'ACCEPTED');
        }])->find($eventId);
        
        return $events->participants->count();
    }
}