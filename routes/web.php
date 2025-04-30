<?php

use Illuminate\Support\Facades\Route;

Route::get('/general', function () {
    return view('general');
});
