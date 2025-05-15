<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Curator\CuratorController;
use App\Http\Controllers\Api\Curator\EventOrderController;
use App\Http\Controllers\Api\Curator\EventsController;
use App\Http\Controllers\Api\Curator\GroupController;
use App\Http\Controllers\Api\Curator\StudentController;
use App\Http\Controllers\Leader\AttendanceController;
use App\Http\Controllers\Leader\LeaderController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])
    ->prefix('starosta')
    ->as('starosta.')
    ->group(function () {
        Route::get('/main', [LeaderController::class, 'index'])->name('main');
        Route::get('/group', [LeaderController::class, 'group'])->name('group');
        Route::get('/events', [LeaderController::class, 'events'])->name('events');
        Route::get('/attendance', [LeaderController::class, 'attendances'])->name('attendance');
        Route::post('/attendance', [AttendanceController::class, 'update'])->name('update');
    });

Route::middleware('auth')
    ->prefix('curator')
    ->as('curator.')
    ->group(function () {
        Route::get('/main', [CuratorController::class, 'index'])->name('main');

        Route::get('/groups', [GroupController::class, 'index'])->name('groups');
        Route::get('/group/{group}/students', [GroupController::class, 'students'])->name('group');

        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/{id_students}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{id_students}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{id_students}', [StudentController::class, 'destroy'])->name('students.destroy');

        Route::get('/events', [EventsController::class, 'index'])->name('events.index');
        Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
        Route::post('/events', [EventsController::class, 'store'])->name('events.store');
        Route::get('/events/{event_id}', [EventsController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event_id}', [EventsController::class, 'update'])->name('events.update');

        Route::get('/attendance', [EventOrderController::class, 'index'])->name('attendance.index');
        Route::post('/attendance', [EventOrderController::class, 'update'])->name('attendance.update');
    });
