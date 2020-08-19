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

Route::group(['middleware' => ['role:teacher|superadmin']], function () {
    
    Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
    Route::get('/dashboard/lessons', 'PagesController@dashboard_lessons')->name('dashboard.lessons');
    Route::get('/dashboard/categories', 'PagesController@dashboard_categories')->name('dashboard.categories');
    Route::get('/dashboard/students', 'PagesController@dashboard_students')->name('dashboard.students');
    Route::get('/dashboard/transactions', 'PagesController@dashboard_transactions')->name('dashboard.transactions');
    Route::get('/dashboard/emails', 'PagesController@dashboard_emails')->name('dashboard.emails');
    Route::get('/dashboard/coupons', 'PagesController@dashboard_coupons')->name('dashboard.coupons');
    Route::post('/subcategory/create', 'SubcategoryController@store');
    Route::get('/getcategory/{id}', 'LessonsController@getCategory');
   
});

Route::group(['middleware' => ['role:student']], function () {
    
    Route::get('/user/{id}', 'PagesController@user_panel')->name('user_panel')->middleware('auth');
   
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/lesson', 'LessonsController')->middleware('auth');

Route::get('/lessons', 'LessonsController@index')->name('lessons-list');

Route::get('/remove/{id}', 'LessonsController@remove')->name('remove');

Route::get('/unlock/{id}', 'LessonsController@isUnlocked')->name('is-unlocked');

Route::get('/subject/{id}', 'LessonsController@subjects')->name('subjects-view');

Route::get('/subject-view', 'LessonsController@subjectsView')->name('subjectsView');

Route::get('/buycredits', 'PagesController@buy_credits')->name('buy_credits')->middleware('auth');

Route::post('/topup', 'PagesController@topup');
