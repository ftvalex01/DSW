<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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


Route::get('/consultas', function () {
    // Todos los usuarios que tengan en el nombre la cadena "Fer" (operador like)
    $usuario1 = DB::table('users')->where('name', 'like', '%Fer%')->get();

    //Todos los usuarios que tengan en el correo la palabra "laravel" y la cadena "com" (operador like con una array de condiciones en el where).
    $usuario2 = DB::table('users')->where('email', 'like', '%laravel%')
        ->where('email', 'like', '%com%')
        ->get();

    // Todos los usuarios que tengan en el correo la palabra "laravel" o la palabra "com" (operador like con orWhere).
    $usuario3 = DB::table('users')->where('email', 'like', '%laravel%')
        ->orWhere('email', 'like', '%com%')
        ->get();

    //  Haz un insert en la tabla usuarios.
    DB::table('users')->insert([
        'name' => 'Fer',
        'email' => 'fer@correo.com',
        'password' => bcrypt('password'),
    ]);

    // Haz un insert de dos usuarios al mismo tiempo en la tabla usuarios.
    DB::table('users')->insert([
        [
            'name' => 'Usuario 1',
            'email' => 'usuario1@correo.com',
            'password' => bcrypt('password'),
        ],
        [
            'name' => 'Usuario 2',
            'email' => 'usuario2@correo.com',
            'password' => bcrypt('password'),
        ],
    ]);

    // Haz un insert utilizando el método insertGetId. ¿Qué devuelve este método?
    $insertedId = DB::table('users')->insertGetId([
        'name' => 'Usuario con ID',
        'email' => 'conid@correo.com',
        'password' => bcrypt('password'),
    ]);

    // Actualiza el correo del usuario con id=2. ¿Qué devuelve este método?
    $updated = DB::table('users')->where('id', 2)->update(['email' => 'nuevoemail@correo.com']);

    // Borra el usuario con id 3.
    $deleted = DB::table('users')->where('id', 3)->delete();

    return [
        'user1' => $usuario1,
        'user2' => $usuario2,
        'user3' => $usuario3,
        'inserted_id' => $insertedId,
        'updated' => $updated,
        'deleted' => $deleted,
    ];
});
