<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController
{
    /**
     * Авторизация пользователя и выдача токена
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'login' => ['Неверные учётные данные'],
            ]);
        }

        $user = Auth::user();

        $roleName = $user->role->name;

        switch ($roleName) {
            case 'куратор':
                return redirect()->route('curator');
            case 'староста':
                return redirect()->route('starosta');
            default:
                return redirect('/login');
        }
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
