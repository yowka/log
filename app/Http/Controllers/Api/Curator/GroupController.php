<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Groupa;
use App\Models\Student;
use App\Models\User;

class GroupController
{
    public function index()
    {
        $user = auth()->user();
        $groups = $user->group;
        return response()->json($groups);
    }
}
