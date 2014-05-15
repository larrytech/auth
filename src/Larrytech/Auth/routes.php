<?php

Route::group(['prefix' => 'auth'], function()
{
	Route::any('login', ['as' => 'auth/login', 'uses' => 'Larrytech\Auth\Controllers\AuthController@login']);
	Route::get('logout', ['as' => 'auth/logout', 'uses' => 'Larrytech\Auth\Controllers\AuthController@logout']);
});