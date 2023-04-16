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
    return view('home');
})->name('/')->middleware('auth');


Route::post('/insert', 'App\Http\Controllers\InsertController@index');
Route::post('/generate', 'App\Http\Controllers\GenerateController@index');
Route::get('/setting', 'App\Http\Controllers\SettingController@view');
Route::post('/setting', 'App\Http\Controllers\SettingController@update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
