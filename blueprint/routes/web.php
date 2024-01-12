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


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');


Route::resource('video', App\Http\Controllers\VideoController::class)->only('index', 'show');

Route::resource('comment', App\Http\Controllers\CommentController::class)->only('create', 'store');

Route::resource('watch', App\Http\Controllers\Api\WatchController::class)->only('store');
