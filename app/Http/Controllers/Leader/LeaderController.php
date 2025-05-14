<?php

namespace App\Http\Controllers\Leader;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\Groupa;
use App\Models\Student;
use App\Models\User;
use Illuminate\Routing\Controller;

class LeaderController extends Controller
{
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

            return view('starosta.dashboard',compact('leaders', 'events', 'attendances'));
        }

    public function group()
    {
        $userId = auth()->id();
        $leaders = $this->getLeaders();

        $group = Groupa::where('id_user', $userId)->first();

        $students = Student::with('personalData')
            ->where('id_group', $group->group_id)
            ->get();

        return view('starosta.group', compact('students', 'group', 'leaders'));
    }

    public function events()
    {
        $leaders = $this->getLeaders();
        $events = Event::with('orders')->get();

        return view('starosta.events', compact('events', 'leaders'));
    }
    public function attendances()
    {
        $leaders = $this->getLeaders();
        $attendances = EventOrder::all();

        return view('starosta.attendance', compact('attendances', 'leaders'));
    }
}
