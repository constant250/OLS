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
Route::resource('category', 'Category\CategoryController');

// Equipment List
Route::get('/cat/list', 'Category\CategoryController@lists')->name('category.list');

Route::get('subdiscip/{id}/category', 'Category\CategoryController@subdisc_category')->name('category.discipline');
Route::get('subdiscip/{id}/category/list', 'Category\CategoryController@subdisc_category_list')->name('category.discipline.list');
// Equipment List Search
// Route::get('/project/list/{search}', 'Project\ProjectController@lists');