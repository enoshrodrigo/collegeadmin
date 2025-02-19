<?php

use App\Http\Controllers\AddmissionController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IntakeController;
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
    /*Route::resource('admission', AdmissionController::class); */
    Route::resource('admissions', AdmissionController::class);
    Route::resource('intakes', IntakeController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
  
Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
Route::get('admissions/apply-now', [AdmissionController::class, 'applynow'])->name('admissions.applynow');
Route::post('admissions', [AdmissionController::class, 'store'])->name('admissions.store');