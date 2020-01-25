<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Disciplines Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Resource
Route::resource('discipline', 'Discipline\DisciplineController');

// Equipment List
Route::get('/discip/list', 'Discipline\DisciplineController@lists')->name('discipline.list');
// Equipment List Search
// Route::get('/project/list/{search}', 'Project\ProjectController@lists');