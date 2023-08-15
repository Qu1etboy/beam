<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Event extends Model
{
    use HasFactory, Searchable;

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