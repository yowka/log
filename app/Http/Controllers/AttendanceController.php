<?php

namespace App\Http\Controllers;

use App\Models\EventOrder;
use Illuminate\Http\Request;

class AttendanceController
{
    public function index()
    {
        $attendances = EventOrder::all();
        return view('attendance', compact('attendances'));
    }

    // Сохраняем изменения
    public function update(Request $request)
    {
        $attendanceData = $request->input('attendance', []);

        foreach (EventOrder::all() as $eventOrder) {
            $eventOrder->update([
                'is_attended' => isset($attendanceData[$eventOrder->event_order_id]) ? 1 : 0,
            ]);
        }

        return back()->with('success', 'Посещаемость успешно обновлена!');
    }
}
