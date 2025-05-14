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
        return User::whereHas('role', function ($query) {
            $query->where('name', 'куратор');
        })->with(['personalData', 'group'])->get();
    }

    /**
     * Главная страница
     */
    public function index()
    {
        $userId = auth()->id();

        // Получаем всех кураторов
        $leaders = $this->getLeaders();

        // Получаем последние 5 мероприятий
        $events = Event::take(5)->get();

        // Получаем посещения, связанные с текущим куратором
        $attendances = EventOrder::with(['student.personalData', 'event'])
            ->where('curator_id', $userId)
            ->take(5)
            ->get();
        $group = Groupa::where('id_user', $userId)->first();

        $students = Student::with('personalData')
            ->where('id_group', $group->group_id)
            ->get();

//        return response()->json(['leaders' => $leaders, 'events' => $events, 'attendances' => $attendances, 'group' => $group]);
        return view('curator.dashboard', compact('leaders', 'events', 'attendances', 'students'));
    }

}
