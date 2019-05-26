<?php
use App\User;

Route::post('api/message', 'Api\MessageController@store');
Route::get('/messenger/{id}', 'Api\MessageController@show');
Route::get('/', function () {
    $users = User::where('id', '!=', auth()->user()->id)->get();
    return view('action.front.welcome', compact('users'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
