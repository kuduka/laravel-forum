<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/threads', 'ThreadsController@index');
Route::post('/threads', 'ThreadsController@store');
Route::get('/threads/{thread}', 'ThreadsController@show');
Route::post('/threads/{thread}/replies', 'RepliesController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');