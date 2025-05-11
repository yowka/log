<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    protected $primaryKey = 'personal_data_id';
    protected $fillable = [
        'surname',
        'name',
        'patronomic',
        'telephone',
        'date_of_birth',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_personal_data', 'personal_data_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'id_personal_data', 'personal_data_id');
    }
}
