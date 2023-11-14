<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
->middleware('auth','verified');

// Ruta para filtrar por el channel que le venga como param.
Route::get('community/{channel:slug}', [App\Http\Controllers\CommunityLinkController::class, 'index']);

// Ruta para votar por el link
Route::post('/votes/{link}',  [App\Http\Controllers\CommunityLinkUserController::class, 'store'])->middleware('auth','verified');

// Ruta para el search

Route::get('search', [App\Http\Controllers\CommunityLinkController::class, 'index'])->middleware('auth','verified')->name('search');

//Ruta para el profile

Route::get('/profile/edit',[App\Http\Controllers\ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/store',[App\Http\Controllers\ProfileController::class, 'store'])->middleware('auth')->name('profile.store');



    
Route::resource('users', 'App\Http\Controllers\UserController')->middleware('can:viewAny,App\Models\User');






