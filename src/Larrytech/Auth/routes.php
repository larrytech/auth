<?php

Route::group(array('namespace' => 'Larrytech\Auth\Controllers', 'prefix' => 'auth'), function()
{
	Route::any('login', array('as' => 'auth/login', 'uses' => 'AuthController@login'));
	Route::get('logout', array('as' => 'auth/logout', 'uses' => 'AuthController@logout'));
});