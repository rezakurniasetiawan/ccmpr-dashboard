<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamePlay1Controller;
use App\Http\Controllers\GamePlay2Controller;




Route::get('/game1', [GamePlay1Controller::class, 'index']);
Route::get('/game2', [GamePlay2Controller::class, 'index']);