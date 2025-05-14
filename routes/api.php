<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Curator\CuratorController;
use App\Http\Controllers\Api\Curator\EventOrderController;
use App\Http\Controllers\Api\Curator\EventsController;
use App\Http\Controllers\Api\Curator\GroupController;
use App\Http\Controllers\Api\Curator\StudentController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth:api')->prefix('curator')->as('curator.')->group(function () {
    Route::get('/main', [CuratorController::class, 'index'])->name('main');

    Route::get('/groups', [GroupController::class, 'index'])->name('groups');
    Route::get('/group/{group}/students', [GroupController::class, 'students'])->name('group.students');

    Route::get('/students', [StudentController::class, 'index'])->name('students');

    Route::get('/events', [EventsController::class, 'index'])->name('events');
    Route::post('/events', [EventsController::class, 'store'])->name('events.store');

    Route::post('/attendance', [EventOrderController::class, 'update'])->name('attendance.update');
});
