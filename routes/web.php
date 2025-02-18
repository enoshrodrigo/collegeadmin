<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/uses', function () {
        return view('uses');
    })->name('uses');

 

    Route::resource('news', NewsController::class);
    Route::resource('events', EventController::class);
    Route::delete('events/{event}/photos/{photo}', [EventController::class, 'destroyPhoto'])->name('events.photos.destroy');
});
  