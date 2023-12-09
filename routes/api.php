<?php

use App\Http\Controllers\PositionListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/positions', PositionListController::class)->name('positions.list');
