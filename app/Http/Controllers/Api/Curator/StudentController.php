<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Groupa;
use App\Models\PersonalData;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController
{
    // Список всех студентов
    public function index()
    {
        $userId = auth()->id();

        $groupIds = Groupa::where('id_user', $userId)
            ->pluck('group_id')
            ->toArray();

        $students = Student::with(['personalData', 'groupa'])
            ->whereIn('id_group', $groupIds)
            ->paginate(10);

        return view('curator.student', [
            'students' => $students,
            'groups' => Groupa::whereIn('group_id', $groupIds)->get()
        ]);
    }

    public function create()
    {
        return view('curator.student-update', [
            'groups' => Groupa::all()
        ]);
    }

    public function edit($id)
    {
        $student = Student::with(['personalData', 'groupa'])->findOrFail($id);

        return view('curator.student-update', [
            'student' => $student,
            'groups' => Groupa::all()
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'patronomic' => 'nullable|string|max:255',
            'telephone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'group_id' => 'required|exists:groupa,group_id',
        ]);

        // Создаем персональные данные
        $personalData = PersonalData::create([
            'surname' => $validated['surname'],
            'name' => $validated['name'],
            'patronomic' => $validated['patronomic'] ?? null,
            'telephone' => $validated['telephone'],
            'date_of_birth' => $validated['date_of_birth'],
        ]);

        if (!$personalData || !$personalData->id) {
            return back()->withErrors(['error' => 'Не удалось сохранить персональные данные']);
        }

        // Создаем студента
        $student = Student::create([
            'id_personal_data' => $personalData->id,
            'id_group' => $validated['group_id'],
        ]);

        if (!$student) {
            // Удаляем созданные персональные данные, если не удалось создать студента
            $personalData->delete();
            return back()->withErrors(['error' => 'Не удалось сохранить данные студента']);
        }

        return redirect()->route('curator.students.index')->with('success', 'Студент успешно добавлен');
    }

    public function update(Request $request, $id_students)
    {
        $student = Student::findOrFail($id_students);

        $validated = $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'patronomic' => 'nullable|string|max:255',
            'telephone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'group_id' => 'required|exists:groupa,group_id'
        ]);

        $student->update(['id_group' => $validated['group_id']]);

        $student->personalData()->update([
            'surname' => $validated['surname'],
            'name' => $validated['name'],
            'patronomic' => $validated['patronomic'],
            'telephone' => $validated['telephone'],
            'date_of_birth' => $validated['date_of_birth']
        ]);

        return redirect()->route('curator.students.index')
            ->with('success', 'Данные студента обновлены');
    }
}
