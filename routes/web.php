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

Route::get('/', 'App\Http\Controllers\RegistrantionFromController@index');
Route::any('/combo-info', 'App\Http\Controllers\RegistrantionFromController@comboInfo');
Route::post('registration-save','App\Http\Controllers\RegistrantionFromController@store')->name('registration-save');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard','App\Http\Controllers\Admin\AdminController@index')->name('dashboard');
