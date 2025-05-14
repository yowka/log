<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\Groupa;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CuratorController
{
    private function getLeaders()
    {
        return User::with(['personalData', 'groupa'])
            ->whereHas('role', function ($query) {
                $query->where('name', 'куратор');
            })->get();
    }

    /**
     * Главная страница
     */
    public function index()
    {
        $userId = auth()->id();

        // Кураторы
        $leaders = $this->getLeaders();

        // Мероприятия
        $events = Event::take(5)->get();

        // Посещения
        $attendances = EventOrder::with(['student.personalData', 'event'])
            ->where('curator_id', $userId)
            ->take(5)
            ->get();

        // Получаем ID групп текущего куратора
        $groupIds = Groupa::where('id_user', $userId)->pluck('group_id');

        // Получаем студентов только из этих групп
        $students = Student::with('personalData')
            ->whereIn('id_group', $groupIds)
            ->get();

        return view('curator.dashboard', compact('leaders', 'events', 'attendances', 'students'));
//        return response()->json(['leaders' => $leaders, 'events' => $events, 'attendances' => $attendances, 'group' => $group]);
    }

}
