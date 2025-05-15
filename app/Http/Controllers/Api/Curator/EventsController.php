<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class EventsController
{
    public function index()
    {
        $events = Event::with('orders')->get();
        return response()->json($events);
    }


    public function store(Request $request)
    {
        $event = Event::create([
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'curator_id' => Auth::id(),
        ]);
        return response()->json($event, 201);
    }


    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            throw new Exception('Event not found', 404);
        }
        $event->update([
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
        ]);
        return response()->json($event);
    }
}
