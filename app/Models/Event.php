<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'title',
        'order_id',
        'location',
        'description',
        'manager_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function eventOrders()
    {
        return $this->hasMany(EventOrder::class);
    }
}
