<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventOrder extends Model
{
    protected $fillable = [
        'student_id',
        'event_id',
        'curator_id',
        'is_attended',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function curator()
    {
        return $this->belongsTo(User::class, 'curator_id');
    }
}
