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

Route::get('/', 'PagesController@home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/lesson', 'LessonsController')->middleware('auth');

Route::get('/lessons', 'LessonsController@index')->name('lessons-list');

Route::get('/unlock/{id}', 'LessonsController@isUnlocked')->name('is-unlocked');

Route::get('/subject/{id}', 'LessonsController@subjects')->name('subjects-view');