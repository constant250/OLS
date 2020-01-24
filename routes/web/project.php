<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Project Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Resource
Route::resource('project', 'Project\ProjectController');

// Equipment List
Route::get('/proj/list', 'Project\ProjectController@lists')->name('project.list');
// Equipment List Search
// Route::get('/project/list/{search}', 'Project\ProjectController@lists');