<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Event;

class EventsController
{
    public function index()
    {
        $events = Event::with('orders')->get();

        return view('curator.events', compact('events'));
    }
}
