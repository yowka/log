<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $timestamps = false;
    protected $primaryKey = 'id_students';
    protected $fillable = [
        'id_personal_data',
        'id_personal_data_student',
        'id_group',
    ];

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'id_personal_data', 'personal_data_id');
    }

    public function studentData()
    {
        return $this->belongsTo(PersonalDataStudent::class, 'id_personal_data_student', 'personal_data_student_id');
    }

    public function groupa()
    {
        return $this->belongsTo(Groupa::class, 'id_group', 'group_id');
    }

    public function eventOrders()
    {
        return $this->hasMany(EventOrder::class, 'student_id', 'id_students');
    }
}
