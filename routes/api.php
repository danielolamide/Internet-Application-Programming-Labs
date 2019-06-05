<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::apiResources([
	'cars' => 'Api\CarController'
]);
Route::apiResource('cars/{car}/reviews', 'Api\ReviewController')->except([
	'show','update','destroy'
]);
Route::apiResource('reviews', 'Api\ReviewController')->except([
	'store','index'
]);
