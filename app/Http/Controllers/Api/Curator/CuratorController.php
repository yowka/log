<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\User;

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

}
