<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');

Route::middleware(['auth', 'web'])->group(function () {
    Route::apiResource('tasks', TaskController::class)->except(['update', 'destroy']);
});

