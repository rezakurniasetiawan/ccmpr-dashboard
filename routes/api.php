<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ScoreTeam;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\GamePlay1Controller;
use App\Http\Controllers\GamePlay2Controller;
use App\Http\Controllers\GamePlay3Controller;
use App\Http\Controllers\PenyisihanController;

Route::get('/game1', [GamePlay1Controller::class, 'index']);
Route::get('/game2', [GamePlay2Controller::class, 'index']);

Route::get('/penyisihan', [PenyisihanController::class, 'index']);
Route::get('/decision-letter/{id}', [PenyisihanController::class, 'getDecisionLetter']);

// Where stage_id (stage_id) is the id of penyisihan
Route::get('/sesi/{id}', [SesiController::class, 'index']);
Route::get('/teams/{id}', [TeamsController::class, 'getTeams']);
Route::post('/login', [TeamsController::class, 'Login']);


// Game Play 1
Route::prefix('sesi1')->group(function () {
    // Where stageSession_id (sesi_id) is the id of stageSession
    Route::get('/theme/{id}', [GamePlay1Controller::class, 'getTheme']);
    // Where themes_id (theme_id) is the id of themes
    Route::get('/theme-answer/{id}', [GamePlay1Controller::class, 'getThemeAnswer']);
});


// Game Play 2
Route::prefix('sesi2')->group(function () {
    // Where stageSession_id (sesi_id) is the id of stageSession
    Route::get('/statements/{id}', [GamePlay2Controller::class, 'getStatements']);
    Route::post('/statements-answer', [GamePlay2Controller::class, 'getStatementsAnswers']);
});


// Game Play 3
Route::prefix('sesi3')->group(function () {
    // Where stageSession_id (sesi_id) is the id of stageSession
    Route::post('/play', [GamePlay3Controller::class, 'index']);
});


// Score Team

Route::post('/score', [ScoreTeam::class, 'getScore']);
