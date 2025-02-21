<?php

use App\Http\Controllers\ApiEventsController;
use App\Http\Controllers\ApiNewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['allowed.domain'])->group(function () {
    Route::post('/news', [ApiNewsController::class, 'index']);
    Route::post('/news/home', [ApiNewsController::class, 'home']);
    Route::post('/news/{id}', [ApiNewsController::class, 'show']);
    Route::post('/events', [ApiEventsController::class, 'index']);
    Route::post('/events/{id}', [ApiEventsController::class, 'show']);
    
});