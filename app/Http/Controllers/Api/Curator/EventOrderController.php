<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\EventOrder;

class EventOrderController
{

    public function index()
    {
        $attendances = EventOrder::all();

        return view('curator.attendance', compact('attendances'));
    }
}
