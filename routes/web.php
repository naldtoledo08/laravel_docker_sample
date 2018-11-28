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
    Route::resource('leave-credits','LeaveCreditController');
    Route::resource('timesheets','TimesheetController');   
    Route::post('timesheets/login','TimesheetController@login')->name('timesheet_login');
    Route::post('timesheets/logout','TimesheetController@logout')->name('timesheet_logout');

    Route::get('users/{user_id}/schedule', 'UserController@schedule')->name('user_schedule');
    Route::get('users/{user_id}/profile', 'UserController@profile')->name('user_profile');
    Route::put('users/{user_id}/schedule', 'UserController@schedule_update')->name('schedule_update');
    Route::get('users/{user_id}/file_leave', 'UserController@file_leave')->name('file_leave');
    Route::post('users/{user_id}/file_leave_create', 'UserController@file_leave_create')->name('file_leave_create');
});

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function() {
    Route::resource('remotes', 'RemoteController');
	Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('shifts', 'ShiftController');
    Route::resource('leave-types', 'LeaveTypeController');
    Route::resource('remote-access', 'RemoteAccessUserController');
    Route::post('remote-access/approve','RemoteAccessUserController@approve')->name('approve_remote_access');  
    Route::post('remote-access/deny','RemoteAccessUserController@deny')->name('deny_remote_access');  
    Route::post('users/{user_id}/approve_leave','UserController@approve_leave')->name('approve_leave');  
    Route::post('users/{user_id}/deny_leave','UserController@deny_leave')->name('deny_leave');  
    Route::post('users/{user_id}/verify','UserController@verify')->name('user_verify');  
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
	
    return view('admin_sample/index');
});


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
