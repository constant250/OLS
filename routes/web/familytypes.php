<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Family Types Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Resource
Route::resource('family-type', 'FamilyType\FamilyTypeController');

// Family Type List
Route::get('/ft/list', 'FamilyType\FamilyTypeController@lists')->name('family-type.list');

Route::get('category/{id}/family-type', 'FamilyType\FamilyTypeController@category_familytype')->name('family-type.category');
Route::get('category/{id}/family-type/list', 'FamilyType\FamilyTypeController@category_familytype_list')->name('family-type.category.list');
// Equipment List Search
// Route::get('/project/list/{search}', 'Project\ProjectController@lists');