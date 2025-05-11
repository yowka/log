<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = ['event_id', 'order_date', 'order_time', 'details'];

    public function events()
    {
        return $this->hasMany(Event::class, 'order_id', 'order_id');
    }
}
