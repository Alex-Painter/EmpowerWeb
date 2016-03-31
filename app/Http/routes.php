<?php

use App\Issue;
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

Route::group(['middleware' => ['web']], function () {

    Route::get('/login', function () {
        return view('/auth/login');
    });

    Route::get('/', function () {
        return view('/auth/login');
    });

    Route::post('/loging', 'HomeController@doLogin');
    Route::get('/logout', 'HomeController@doLogout');

    Route::get('/issues', function () {

      $issues = Issue::orderBy('created_at')->get();

      return view('issues', $issues)->with('issues', $issues);
    });

    Route::get('/review/{id}', [
      'as' => 'review', 'uses' => 'IssueController@review']);

    Route::get('/forward/{id}', [
      'as' => 'forward', 'uses' => 'IssueController@forward']);

    Route::get('/close/{id}', [
      'as' => 'close', 'uses' => 'IssueController@close']);

});
