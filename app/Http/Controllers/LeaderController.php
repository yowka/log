<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LeaderController
{
    public function index(){
        $leaders = User::whereHas('role', function ($query) {
            $query->where('name', 'староста');
        })->with(['personalData', 'group'])->get();
        $events = Event::take(3)->get();
        return view('general', compact('leaders', 'events'));

    }

}
