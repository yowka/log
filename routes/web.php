<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\LeaderController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/general', function () {
    return view('general');
})->middleware('auth');


Route::get('/general', [LeaderController::class, 'index'])->name('leader');
