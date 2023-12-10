<?php

use App\Http\Controllers\API\PositionListController;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/positions', PositionListController::class)->name('positions.list');

Route::controller(UserController::class)->group(function () {
    Route::name('users.')->group(function () {
        Route::get('/users', 'index')->name('list');
        Route::get('/users/{user}', 'show')->name('specific');
        Route::post('/users', 'store')->name('create');
    });
});

Route::get('/token', TokenController::class)->name('token.create');
