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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/employee', 'EmployeeController');

Route::resource('/job', 'JobController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/stamp', 'StampTimeController@index')->name('stamp.index');
Route::post('/stamp', 'StampTimeController@store')->name('stamp.store');


Route::get('/employee/{employee}/generateCard','EmployeeController@generateCard')->name('employee.generateCard');
Route::get('/employee/{employee}/showTimesheet','EmployeeController@showTimesheet')->name('employee.showTimesheet');