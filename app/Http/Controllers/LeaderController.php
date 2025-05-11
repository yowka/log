<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\Groupa;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaderController extends Controller
{
    // Приватный метод для получения старост
    private function getLeaders()
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'староста');
        })->with(['personalData', 'group'])->get();

    }

    public function index(){
        $leaders = $this->getLeaders();
        $events = Event::take(5)->get();
        $attendances = EventOrder::take(5)->get();

        return view('main',compact('leaders', 'events', 'attendances'));
    }

    public function group()
    {
        $userId = auth()->id();
        $leaders = $this->getLeaders();

        $group = Groupa::where('id_user', $userId)->first();

        $students = Student::with('personalData')
            ->where('id_group', $group->group_id)
            ->get();

        return view('group', compact('students', 'group', 'leaders'));
    }

    public function events()
    {
        $leaders = $this->getLeaders();
        $events = Event::with('orders')->get();

        return view('events', compact('events', 'leaders'));
    }
    public function attendances()
    {
        $leaders = $this->getLeaders();
        $attendances = EventOrder::all(); // или с with(), если есть связи

        return view('attendance', compact('attendances', 'leaders'));
    }

}
