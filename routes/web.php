<?php

use app\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('/auth/login');
});

Route::get('/list', function () {
    return view('/list/index');
});

Route::get('/list/create', function () {
    return view('list/create');
});

Route::get('/list/edit', function () {
    return view('list/edit');
});

Route::get('/list/show', function () {
    return view('list/show');
});

Route::post("login", 'App\Http\Controllers\AuthController@login');