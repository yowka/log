<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Curator\AttendanceController;
use App\Http\Controllers\Api\Curator\CuratorController;
use App\Http\Controllers\Api\Curator\EventsController;
use App\Http\Controllers\Api\Curator\GroupController;
use App\Http\Controllers\Api\Curator\StudentController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth:api')->prefix('curator')->as('api.curator.')->group(function () {
    Route::get('/main', [CuratorController::class, 'index'])->name('main');
    Route::get('/groups', [GroupController::class, 'index'])->name('groups');
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/events', [EventsController::class, 'index'])->name('events');
    Route::post('/events', [EventsController::class, 'store'])->name('events.store');
    Route::post('/attendance', [AttendanceController::class, 'update'])->name('attendance');
});
