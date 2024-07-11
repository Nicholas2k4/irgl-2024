<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/coba', function () {
    return response()->json(['message' => 'Hello, World!']);
});




Route::post('login', [AuthController::class, 'login']);

Route::post('getUserData',[TeamController::class, 'getUserData'])->middleware('auth:sanctum');
Route::post('getUserDataByGamePass',[TeamController::class, 'getUserDataByGamePass']);
Route::post('uploadScoreWin',[TeamController::class, 'uploadScoreWin'])->middleware('auth:sanctum');
Route::post('uploadScoreLose',[TeamController::class, 'uploadScoreLose'])->middleware('auth:sanctum');
Route::post('getUserStreak',[TeamController::class, 'getUserStreak']);
Route::post('getUserGrandPrizeStreak',[TeamController::class, 'getUserGrandPrizeStreak']);
Route::post('updateResultOfRoulette',[TeamController::class, 'updateResultOfRoulette']);
Route::post('getGameLinkById',[TeamController::class, 'getGameLinkById']);
