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

        $user = User::where('login', $credentials['login'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'login' => 'Неверные учетные данные',
            ]);
        }

        $token = Str::random(60);
        $user->api_token = $token;
        $user->save();

        // Логиним пользователя
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended('/main');
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();
        response()->json([
            'message' => 'Выход выполнен успешно'
        ], 200);
        return redirect()->intended('/login');
    }
}
