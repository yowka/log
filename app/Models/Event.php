<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event'; // Явно указываем имя таблицы
    protected $primaryKey = 'event_id'; // Указываем правильный первичный ключ

    protected $fillable = ['title', 'location', 'description'];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'user_id');
    }

    public function eventOrders()
    {
        return $this->hasMany(EventOrder::class, 'event_id', 'event_id');
    }
}
