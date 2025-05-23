<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalDataStudent extends Model
{
    protected $fillable = [
        'INN',
        'SNLS',
        'medical_certificate',
        'vaccinations',
        'illnesses',
        'email',
        'address',
        'dormitory_accommodation',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id_personal_data_student', 'personal_data_student_id');
    }
}
