<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupa extends Model
{
    protected $table = 'groupa';
    public $timestamps = false;
    protected $primaryKey = 'group_id';
    protected $fillable = [
        'name',
        'releas',
        'id_user',
    ];
    public function leader()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function starosta()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');

    }
    public function curator()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'id_group', 'group_id');
    }
}
