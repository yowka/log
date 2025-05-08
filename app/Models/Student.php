<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id_personal_data',
        'id_personal_data_student',
        'id_group',
    ];

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'id_personal_data');
    }

    public function personalDataStudent()
    {
        return $this->belongsTo(PersonalDataStudent::class, 'id_personal_data_student');
    }

    public function group()
    {
        return $this->belongsTo(Groupa::class, 'id_group');
    }

    public function eventOrders()
    {
        return $this->hasMany(EventOrder::class);
    }
}
