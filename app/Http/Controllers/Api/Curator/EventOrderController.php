<?php

namespace App\Http\Controllers\Api\Curator;

use App\Http\Requests\EventOrderRequest;
use App\Models\EventOrder;
use App\Models\Student;
use Illuminate\Http\Request;

class EventOrderController
{

    public function index()
    {
        $attendances = EventOrder::with(['student.personalData', 'event', 'user.personalData'])->get();
        return view('curator.attendance', compact('attendances'));
    }

    public function update(Request $request)
    {
        $attendanceData = $request->input('attendance', []);

        foreach ($attendanceData as $eventOrderId => $status) {
            EventOrder::where('event_order_id', $eventOrderId)->update([
                'is_attended' => $status ? 1 : 0,
            ]);
        }

        return back()->with('success', 'Посещаемость успешно обновлена');
    }

    public function editStudent($id)
    {
        $student = Student::with('personalData')->findOrFail($id);
        return view('curator.student_edit', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $validated = $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
        ]);

        $student = Student::findOrFail($id);

        $student->personalData()->update([
            'surname' => $validated['surname'],
            'name' => $validated['name'],
            'patronymic' => $validated['patronymic'] ?? null,
        ]);

        return redirect()->route('curator.attendance')
            ->with('success', 'Данные студента успешно обновлены');
    }

}
