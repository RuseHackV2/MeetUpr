<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('home.index');
//});
//
////---- Test Routes ----//
//Route::get('/test', function () {
//    return view('test.index');
//});

//---- Auth Routes ----//
Route::get('/auth', 'AuthController@sendRequest');
Route::get('/test-auth', 'AuthController@testAuth');
Route::get('/test-auth1', 'AuthController@testAuth1');
Route::get('/auth/redirect', 'AuthController@requestCallback');
Route::get('/auth/logout', 'AuthController@logout');

//Route::get('boardgames', 'GamesController@index');
//Route::get('boardgames/details/{id?}', 'GamesController@details');

//---- Home Routes ----//
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::get('events/short-details/{id}', 'Events1Controller@shortDetails');
Route::get('events/get-near-location', 'Events1Controller@getNearLocation');

//---- Events Routes ----//
Route::get('events', 'EventsController@index');
Route::get('events/{id}', 'EventsController@show');

Route::get('event/{id?}', 'EventsController@edit');
Route::post('event/{id?}', 'EventsController@store');
Route::get('events/{id}/apply', 'EventsController@applyForEvent');

Route::get('notification/{id}', 'NotificationController@open');

Route::get('request/{userId}/{eventId}/{permit}', 'RequestsController@processRequest');

Route::get('user/tags/add/{user_id}/{tag_id}', 'UserController@addUserTag');
Route::get('user/tags/get/{user_id}', 'UserController@getUserTags');
Route::get('notification/{id}', 'NotificationController@open');

Route::get('boardgames/get', 'RequestsController@getBoardGames');