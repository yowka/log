<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\Groupa;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class CuratorController
{
    private function getLeaders()
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'куратор');
        })->with(['personalData', 'group'])->get();

    }

    public function index(){
        $leaders = $this->getLeaders();
        $events = Event::take(5)->get();
        $attendances = EventOrder::take(5)->get();

        return view('curator.dashboard',compact('leaders', 'events', 'attendances'));
    }

    public function group()
    {
        $userId = auth()->id();

        $group = Groupa::where('id_user', $userId)->first();

        $students = Student::with('personalData')
            ->where('id_group', $group->group_id)
            ->get();

        return view('curator.group', compact('students', 'group'));
    }

    public function events()
    {
        $events = Event::with('orders')->get();

        return view('curator.events', compact('events'));
    }
    public function attendances()
    {
        $attendances = EventOrder::all();

        return view('curator.attendance', compact('attendances'));
    }
}
