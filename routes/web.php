<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CuratorController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaderController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);


Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/curator/main', [CuratorController::class, 'index'])->name('curator');
    Route::get('/starosta/main', [LeaderController::class, 'index'])->name('starosta');
    Route::get('/group', [LeaderController::class, 'group'])->name('group');
    Route::get('/events', [LeaderController::class, 'events'])->name('events');
    Route::get('/attendance', [LeaderController::class, 'attendances'])->name('attendance');
    Route::post('/attendance', [AttendanceController::class, 'update'])->name('update');
});
