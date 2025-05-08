<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    protected $fillable = [
        'surname',
        'name',
        'patronomic',
        'telephone',
        'date_of_birth',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'id_personal_data');
    }

    public function personalDataStudent()
    {
        return $this->hasOne(PersonalDataStudent::class, 'personal_data_student_id');
    }
}
