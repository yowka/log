<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupa extends Model
{
    protected $table = 'groupa';
    protected $primaryKey = 'group_id';
    protected $fillable = [
        'name',
        'releas',
        'id_user',
    ];

    public function starosta()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');

    }

    public function students()
    {
        return $this->hasMany(Student::class, 'id_group', 'group_id');

    }
}
