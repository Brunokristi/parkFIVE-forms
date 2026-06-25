<?php

use App\Http\Controllers\CheckinController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ďakovná stránka musí byť definovaná PRED route so slugom apartmánu,
// inak by sa "dakujeme" interpretovalo ako slug apartmánu.
Route::get('/checkin/dakujeme/{checkin}', [CheckinController::class, 'thankyou'])
    ->name('checkin.thankyou');

Route::get('/checkin/{apartment:slug}', [CheckinController::class, 'show'])
    ->name('checkin.show');

Route::post('/checkin/{apartment:slug}', [CheckinController::class, 'store'])
    ->name('checkin.store');