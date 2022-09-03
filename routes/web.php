<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Route de test unitaire
 */
// Route::get('/login', function () {
//     return 'coucou';
// });

// Route::get('/list', function () {
//     return 'coucou';
// });

// Route::get('/admin/create', function () {
//     return 'coucou';
// });

Route::view('/weather', 'weather/index');

Route::view('/login', 'auth/login');

Route::view('/register', 'auth/register');

Route::view('/list', 'list/index');

Route::view('/list/create', 'list/create');

Route::view('/admin/create', 'admin/manage_user');

Route::get('/list/edit', function () {
    return view('list/edit');
});

Route::get('/list/remove', function () {
    return view('list/remove');
});

Route::get('/admin/removeUser', function () {
    return view('admin/remove_user');
});

Route::get('/admin/editUser', function () {
    return view('admin/edit_user');
});

Route::get('/list/show', function () {
    return view('list/show');
});

Route::get('/home/index', function () {
    return view('home/index');
});

/**
 * Route POST
 * Fait appel à la methode login dans le controller Auth
 */
Route::post("connect", 'App\Http\Controllers\AuthController@login');

/**
 * Route GET
 * Fait appel à la methode stopSession dans le controller Auth
 */
Route::get("logout", 'App\Http\Controllers\AuthController@stopSession');

/**
 * Route POST
 * Fait appel à la methode register dans le controller Auth
 */
Route::post("signin", 'App\Http\Controllers\AuthController@register');

/**
 * Route POST
 * Fait appel à la méthode create dans le controller Module
 */
Route::post("list/createModule", 'App\Http\Controllers\ModuleController@createModule');

/**
 * Route POST
 * Fait appel à la méthode modify dans le controller Module
 */
Route::post("list/editModule", 'App\Http\Controllers\ModuleController@modifyModule');


/**
 * Route POST
 * Fait appel à la méthode remove dans le controller Module
 */
Route::post("list/removeModule", 'App\Http\Controllers\ModuleController@removeModule');

/**
 * Route POST
 * Fait appel à la méthode addUser dans le controller User
 */
Route::post("admin/create", 'App\Http\Controllers\UserController@addUser');

/**
 * Route POST
 * Fait appel à la méthode removeUser dans le controller User
 */
Route::post("admin/removeUser", 'App\Http\Controllers\UserController@removeUser');

/**
 * Route POST
 * Fait appel à la méthode editUser dans le controller User
 */
Route::post("admin/editUser", 'App\Http\Controllers\UserController@editUser');