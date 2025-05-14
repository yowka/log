<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'user'; // Твоя таблица в БД
    protected $primaryKey = 'user_id'; // или другое имя вашего первичного ключа

    public $timestamps = false; // Если нет created_at / updated_at

    protected $fillable = [
        'login',
        'password',
        'api_token',
        'id_role',
        'id_personal_data'
    ];

    protected $hidden = [
        'password',
    ];
    public function isCurator()
    {
        return $this->role && $this->role->name === 'куратор';
    }


    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'id_personal_data', 'personal_data_id');
    }

    public function groupa()
    {
        return $this->hasOne(Groupa::class, 'id_user', 'user_id');
    }

}
