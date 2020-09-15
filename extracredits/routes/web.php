<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\TransactionController;
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

Route::group(['middleware' => ['role:teacher|superadmin', 'auth']], function () {
    
    Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
    Route::get('/dashboard/lessons', 'PagesController@dashboard_lessons')->name('dashboard.lessons');
    Route::get('/dashboard/search', 'PagesController@dashboard_lessons_search')->name('dashboard.lessons.search');
    Route::get('/dashboard/filter', 'PagesController@dashboard_lessons_filter')->name('dashboard.lessons.filter');
    Route::get('/dashboard/subject/{name}', 'PagesController@dashboard_subjects')->name('dashboard.subjects');
    Route::get('/dashboard/categories', 'PagesController@dashboard_categories')->name('dashboard.categories');
    Route::get('/dashboard/students', 'PagesController@dashboard_students')->name('dashboard.students');
    Route::get('/dashboard/student/{id}', 'PagesController@dashboard_student_panel')->name('dashboard.student.panel');
    Route::get('/dashboard/transactions', 'PagesController@dashboard_transactions')->name('dashboard.transactions');
    Route::get('/dashboard/emails', 'PagesController@dashboard_emails')->name('dashboard.emails');
    Route::get('/dashboard/coupons', 'CouponController@index')->name('dashboard.coupons');
    Route::get('/dashboard/transactions', 'PagesController@dashboard_transactions')->name('dashboard.transactions');
    Route::get('/dashboard/emails', 'PagesController@dashboard_emails')->name('dashboard.emails');
    Route::get('/dashboard/coupons/enable/{id}', 'CouponController@enable')->name('dashboard.coupons.enable');
    Route::get('/dashboard/coupons/delete/{id}', 'CouponController@delete')->name('dashboard.coupons.delete');
    Route::post('/subcategory/create', 'SubcategoryController@store');
    Route::post('/subcategory/update', 'SubcategoryController@update');
    Route::get('/subcategory-remove/{category}', 'SubcategoryController@destroy');
    Route::post('/topic/create', 'TopicController@store');
    Route::post('/topic/update', 'TopicController@update');
    Route::get('/topic-remove/{id}', 'TopicController@destroy');
    Route::post('/coupon/create', 'CouponController@store');
    Route::get('/getcategory/{id}', 'LessonsController@getCategory');
    Route::get('/gettopic/{id}', 'SubcategoryController@getTopic');
    Route::get('/remove/{id}', 'LessonsController@remove')->name('remove');
    

   
});

Route::group(['middleware' => ['role:student|superadmin']], function () {
    
    Route::get('/user/student_{id}', 'PagesController@user_panel')->name('user_panel')->middleware('auth');
    Route::post('/topup/store', 'TransactionController@store')->name('transaction.store')->middleware('auth');
    Route::get('/buycredits', 'PagesController@buy_credits')->name('buy_credits')->middleware('auth');
    Route::post('/topup', 'PagesController@topup');
   
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/lesson', 'LessonsController')->middleware('auth');

Route::get('/{subject}/{category}/{topic}/{lesson}', 'PagesController@lesson_view')->name('lesson_canonical_view');

Route::get('/lessons', 'LessonsController@index')->name('lessons-list');


Route::get('/unlock/{id}', 'LessonsController@isUnlocked')->name('is-unlocked');

Route::get('/subject/{id}', 'LessonsController@subjects')->name('subjects-view');
Route::get('/{subject}/{id}', 'LessonsController@subject_category')->name('subject.category');
Route::get('/{subject}/{category}/{topic}', 'LessonsController@subject_category_topic')->name('subject.topic');

Route::get('/subject-view', 'LessonsController@subjectsView')->name('subjectsView');



// Route::get('test', function () {

//     $user = [
//         'name' => 'Mahedi Hasan',
//         'info' => 'Laravel Developer'
//     ];

//     \Mail::to('mail@codechief.org')->send(new \App\Mail\NewMail($user));

//     dd("success");

// });

Route::get('/how-it-works', function() {
    return view('pages.howitworks');
});

Route::get('/pricing', function() {
    return view('pages.pricing');
});

Route::get('testimonials', function() {
    return view('pages.testimonials');
});

Route::get('/contact', 'ContactController@show');
Route::post('/contact', 'ContactController@mailContactForm');