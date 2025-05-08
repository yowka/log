<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderController
{
    public function index(){
        $leaders = User::whereHas('role', function ($query) {
            $query->where('name', 'староста');
        })->with(['personalData', 'group'])->get();
        return view('general', compact('leaders'));
    }
}
