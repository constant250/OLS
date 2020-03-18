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

Route::get('family-type/{id}/family', 'Family\FamilyController@familytype_family')->name('family.family');
Route::get('family-type/{id}/family/list', 'Family\FamilyController@familytype_family_list')->name('family.family.list');
// Equipment List Search
// Route::get('/project/list/{search}', 'Project\ProjectController@lists');