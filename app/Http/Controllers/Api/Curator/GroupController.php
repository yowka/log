<?php

namespace App\Http\Controllers\Api\Curator;

use App\Exceptions\Api\ApiException;
use App\Http\Requests\GroupRequest;
use App\Models\Groupa;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GroupController
{
    public function index()
    {
        $userId = Auth::id();
        $groups = Groupa::where('id_user', $userId)->with('students')->get();
        return response()->json($groups);
    }

    public function show($id)
    {
        $group = Groupa::where('id_user', auth()->id())->find($id);
        if ($group) {
            return response()->json($group);
        } else {
            throw new ApiException('Group not found', 404);
        }
    }

    public function store(GroupRequest $request)
    {
        $validated = $request->validated();
        $validated['id_user'] = auth()->id(); // Associate with the curator
        $group = Groupa::create($validated);
        return response()->json($group, 201);
    }

    public function update(GroupRequest $request, $id)
    {
        $group = Groupa::where('id_user', auth()->id())->find($id);
        if (!$group) {
            throw new ApiException('Group not found', 404);
        }
        $group->update($request->validated());
        return response()->json($group, 200);
    }

    public function destroy($id)
    {
        $group = Groupa::where('id_user', auth()->id())->find($id);
        if (!$group) {
            throw new ApiException('Group not found', 404);
        }
        $group->delete();
        return response()->json([], 204);
    }
}
