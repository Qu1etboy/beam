<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'event_id',
    ];

    // Define task statuses
    const STATUS_TODO = 1;
    const STATUS_DOING = 2;
    const STATUS_DONE = 3;

    // Define priority levels
    const PRIORITY_LOW = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH = 3;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
