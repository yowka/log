<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventOrder;
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
        $leaders = $this->getLeaders();
        $students = Student::where('id_group')->get();

        return view('group', compact('students', 'leaders'));
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
        $attendances = EventOrder::with('student', 'event')->get();

        return view('attendance', compact('attendances', 'leaders'));
    }
}
