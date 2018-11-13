<?php

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
use App\Services\DBService;

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('dashboard','DashboardController@index')->name('dashboard');   
    Route::resource('departments','DepartmentController');
    Route::resource('positions','PositionController');
    Route::resource('products','ProductController');

    Route::resource('timesheets','TimesheetController');   
    Route::post('timesheets/login','TimesheetController@login')->name('timesheet_login');
    Route::post('timesheets/logout','TimesheetController@logout')->name('timesheet_logout');
});

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function() {
	Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
	
    return view('admin_sample/index');
});


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
