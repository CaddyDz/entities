<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/entities', 'EntitiesController@index');
Route::post('/entities', 'EntitiesController@store');
Route::delete('/entities/{id}', 'EntitiesController@delete');
Route::get('/entities/{entity}/children', 'EntitiesController@getChildren')
	->where('entity', '[0-9]+');
Route::get('/getLastBarcode', 'EntitiesController@getLastBarCode');
