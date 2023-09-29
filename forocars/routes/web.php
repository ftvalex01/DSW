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

Auth::routes(['verify' => 'true']);

Route::get('/home', function () {
    return view('home');
 })->middleware(['auth', 'verified'])->name('home');


 //Una para mostrar todos los enlaces que llamará al método index del controlador mediante GET 
Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);



//Otra para crear un link que llamará al método store del controlador mediante POST:
Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store'])
->middleware('auth');