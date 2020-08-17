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

Route::resource('/lesson', 'LessonsController')->middleware('auth');

Route::get('/lessons', 'LessonsController@index')->name('lessons-list');

Route::get('/lesson/{id}/delete', 'LessonsController@destory')->name('delete');

Route::get('/unlock/{id}', 'LessonsController@isUnlocked')->name('is-unlocked');

Route::get('/subject/{id}', 'LessonsController@subjects')->name('subjects-view');

Route::get('/subject-view', 'LessonsController@subjectsView')->name('subjectsView');

Route::get('/getcategory/{id}', 'LessonsController@getCategory');

Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/user/{id}', 'PagesController@user_panel')->name('user_panel')->middleware('auth');

Route::get('/buycredits', 'PagesController@buy_credits')->name('buy_credits')->middleware('auth');

Route::post('/topup', 'PagesController@topup');

Route::post('/subcategory/create', 'SubcategoryController@store');