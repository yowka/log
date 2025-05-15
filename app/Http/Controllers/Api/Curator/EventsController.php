<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class EventsController
{
    public function index()
    {
        $events = Event::with('orders', 'manager')->get();
        return view('curator.events', compact('events'));
    }

    public function create()
    {
        $orders = Order::all();
        $curators = User::whereHas('role', function ($query) {
            $query->where('name', 'куратор');
        })->get();
        return view('curator.event-update', compact('orders', 'curators'));
    }

    public function edit($event_id)
    {
        $event = Event::with('orders', 'manager')->findOrFail($event_id);
        $orders = Order::all();
        $curators = User::whereHas('role', function ($query) {
            $query->where('name', 'куратор');
        })->get();

        return view('curator.event-update', compact('event', 'orders', 'curators'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_id' => 'required|exists:orders,order_id',
            'manager_id' => 'required|exists:users,id',
        ]);

        Event::create($validated);

        return redirect()->route('curator.events.index')->with('success', 'Мероприятие создано');
    }

    public function update(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_id' => 'required|exists:orders,order_id',
            'manager_id' => 'required|exists:users,id',
        ]);

        $event->update($validated);

        return redirect()->route('curator.events.index')->with('success', 'Мероприятие обновлено');
    }
}
