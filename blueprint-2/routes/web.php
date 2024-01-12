<?php

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


Route::resource('conference', App\Http\Controllers\ConferenceController::class);

Route::resource('venue', App\Http\Controllers\VenueController::class);

Route::resource('speaker', App\Http\Controllers\SpeakerController::class);

Route::resource('talk', App\Http\Controllers\TalkController::class);


Route::resource('conference', App\Http\Controllers\ConferenceController::class);

Route::resource('venue', App\Http\Controllers\VenueController::class);

Route::resource('speaker', App\Http\Controllers\SpeakerController::class);

Route::resource('talk', App\Http\Controllers\TalkController::class);


Route::resource('conference', App\Http\Controllers\ConferenceController::class);

Route::resource('venue', App\Http\Controllers\VenueController::class);

Route::resource('speaker', App\Http\Controllers\SpeakerController::class);

Route::resource('talk', App\Http\Controllers\TalkController::class);


Route::resource('conference', App\Http\Controllers\ConferenceController::class);

Route::resource('venue', App\Http\Controllers\VenueController::class);

Route::resource('speaker', App\Http\Controllers\SpeakerController::class);

Route::resource('talk', App\Http\Controllers\TalkController::class);
