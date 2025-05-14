<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Leader\AttendanceController;
use App\Http\Controllers\Leader\LeaderController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);


Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth'])->prefix('starosta')->as('starosta.')->group(function () {
    Route::get('/main', [LeaderController::class, 'index'])->name('main');
    Route::get('/group', [LeaderController::class, 'group'])->name('group');
    Route::get('/events', [LeaderController::class, 'events'])->name('events');
    Route::get('/attendance', [LeaderController::class, 'attendances'])->name('attendance');
    Route::post('/attendance', [AttendanceController::class, 'update'])->name('update');
});
