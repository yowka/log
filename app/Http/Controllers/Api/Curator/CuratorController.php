<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\Groupa;
use App\Models\Student;
use App\Models\User;

class CuratorController
{

    public function index()
    {
        $userId = auth()->id();

        $leaders = User::with(['personalData', 'groupa'])
            ->whereHas('role', function ($query) {
                $query->where('name', 'куратор');
            })
            ->get();

        $events = Event::take(5)->get();

        $attendances = EventOrder::with(['student.personalData', 'event', 'user.personalData'])
        ->where('curator_id', $userId)
            ->get();

        $groupIds = Groupa::where('id_user', $userId)->pluck('group_id');
        $students = Student::with('personalData')
            ->whereIn('id_group', $groupIds)
            ->get();

//        return response()->json(['leaders' => $leaders, 'events' => $events, 'attendances' => $attendances, 'group' => $group]);
        return view('curator.dashboard', compact('leaders', 'events', 'attendances', 'students'));
    }

}
