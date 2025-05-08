<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'number',
        'date',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
