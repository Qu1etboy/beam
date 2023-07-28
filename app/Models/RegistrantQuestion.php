<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrantQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'event_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function respondents()
    {
        return $this->belongsToMany(User::class, 'registrant_question_user', 'registrant_question_id', 'user_id');
    }
}
