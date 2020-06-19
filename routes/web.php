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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::resource('board', 'BoardController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);

Route::resource('task', 'TaskController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);

Route::resource('list', 'ListController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);