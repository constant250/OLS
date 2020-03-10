<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Family Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Resource
Route::resource('family', 'Family\FamilyController');

// Families List
Route::get('/families/list', 'Family\FamilyController@lists')->name('families.list');

Route::get('/search-family', 'Family\FamilyController@search_family')->name('families.search_family');
// Equipment List Search
// Route::get('/project/list/{search}', 'Project\ProjectController@lists');