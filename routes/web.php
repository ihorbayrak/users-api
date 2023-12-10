<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('web.users.index');
Route::get('/create', [UserController::class, 'create'])->name('web.users.create');
