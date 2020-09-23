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

Route::get('/', function () {
	$user = request()->user()->roles[0];
    return view('welcome', ['user' => $user]);
})->middleware('auth');

Auth::routes();

Route::get('/home', function() {
	return redirect('/');
})->name('home')->middleware('auth');

Route::get('/users', 'UserController@index')->middleware('auth');

Route::resource('/tasks', 'TaskController')->middleware('auth');

Route::resource('/products', 'ProductController')->middleware('auth');

Route::match(['get', 'post'], '/logout', 'Auth\LoginController@logout')->name('logout');


