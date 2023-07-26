<?php

use App\Models\Country;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/* sign in / up Routes */
Route::post('auth/register', 'Auth\RegisteredUserController@store');
Route::post('auth/login', 'Auth\AuthenticatedSessionController@store');

Route::get('/user', 'HomeController@store');

Route::middleware('auth:api')->get('/userData', function () {
    return Auth::user()->makeVisible(['api_token']);
});
// Route::apiResource('profile', 'UserController');

Route::get('/profile/{user}', 'UserController@show');
Route::post('/profile/{user}', 'UserController@update')->middleware('auth:api');
Route::get('/user/jobs', 'UserController@userJobs')->middleware('auth:api');

Route::get('/countriesAndSkillsData', function () {
    return response()->json(['countries' => Country::get(['id', 'name']), 'skills' => Skill::get(['id', 'name'])]);
});

Route::get('jobs', 'JobController@index');
Route::get('job/view/{job}', 'JobController@show');
Route::post('job/create', 'JobController@create')->middleware('auth:api');
Route::get('job/{job}/edit', 'JobController@edit')->middleware('auth:api');
Route::post('job/{job}', 'JobController@update')->middleware('auth:api');
Route::delete('job/{job}', 'JobController@destroy')->middleware('auth:api');
Route::post('job/apply/{job}', 'JobController@apply')->middleware('auth:api');
Route::post('job/bookmark/{job}', 'JobController@bookmark')->middleware('auth:api');