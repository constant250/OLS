<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Sub-Disciplines Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Resource
Route::resource('sub-discipline', 'SubDiscipline\SubDisciplineController');

// Equipment List
Route::get('/subdiscip/list', 'SubDiscipline\SubDisciplineController@lists')->name('sub-discipline.list');
// Equipment List Search
// Route::get('/project/list/{search}', 'Project\ProjectController@lists');