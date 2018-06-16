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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::middleware('api')->get('/topics', 'TopicsController@index');
Route::middleware('auth:api')->post('/question/follower','QuestionFollowController@follower');
Route::middleware('auth:api')->post('/question/follow','QuestionFollowController@followThisQuestion');
Route::get('/user/followers','FollowerController@index');
Route::post('/user/follow','FollowerController@follow');
Route::post('/answer/{id}/votes/users','VotesController@users');
Route::post('/answer/vote','VotesController@vote');
Route::post('/message/store','MessagesController@store');
Route::get('/answer/{id}/comments','CommentsController@answer');
Route::get('/question/{id}/comments','CommentsController@question');
Route::post('comment','CommentsController@store');

