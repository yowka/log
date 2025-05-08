<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role'; // Твоя таблица в БД
    protected $primaryKey = 'role_id'; // Указываем кастомный первичный ключ

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
