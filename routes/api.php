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
    Route::ApiResource('/category', CategoryController::class);
    Route::ApiResource('/product', ProductController::class);
});
