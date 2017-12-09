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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/issue/v/{id}', 'IssueController@view')->name('viewIssue');

Route::middleware(['auth'])->group(function () {
    Route::get('issue/create', 'IssueController@show')->name('issueForm');

    Route::post('issue/create', 'IssueController@create')->name('createIssue');

    Route::get('issue/list', 'IssueController@list')->name('listIssues');
	
	Route::get('/profile', 'ProfileController@index')->name('profile');
	
	Route::get('admin/users', 'AdminUsersController@index');
	
	Route::get('admin/issues', 'AdminIssuesController@index');
});