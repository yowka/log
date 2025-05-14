<?php

namespace App\Http\Controllers\Api\Curator;

use App\Models\Groupa;
use App\Models\Student;

class GroupController
{
    public function index()
    {
        $user = auth()->user();

        $groups = $user->groups;


        return response()->json($groups);

    }
}
