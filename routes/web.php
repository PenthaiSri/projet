<?php

use app\Http\Controllers\AuthController;
use app\Http\Controllers\ModuleController as Module;
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

Route::view('/login', 'auth/login');

Route::get('/register', function () {
    return view('/auth/register');
});

Route::view('/list', 'list/index');

Route::view('/list/create', 'list/create');

Route::get('/list/edit', function () {
    return view('list/edit');
});

Route::get('/list/show', function () {
    return view('list/show');
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
 * Fait appel à la méthode create dans le controller createModule
 */
Route::post("list/createModule", 'App\Http\Controllers\ModuleController@createModule');