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

Route::get('/subdiscip/list', 'SubDiscipline\SubDisciplineController@lists')->name('sub-discipline.list');

Route::get('discipline/{id}/subdiscip', 'SubDiscipline\SubDisciplineController@disc_subdisc')->name('sub-discipline.discipline');
Route::get('discipline/{id}/subdiscip/list', 'SubDiscipline\SubDisciplineController@disc_subdisc_list')->name('sub-discipline.discipline.list');

// Route::get('/project/list/{search}', 'Project\ProjectController@lists');