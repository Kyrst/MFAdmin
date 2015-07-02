<?php
App::setLocale('se');

Route::group(['namespace' => 'Front'], function()
{
	get('/', ['uses' => 'HomeController@home', 'as' => 'home']);
	post('/sign-in', ['uses' => 'HomeController@signIn', 'as' => 'sign-in']);
});

get('/dashboard/sign-out', ['uses' => 'DashboardController@signOut', 'as' => 'dashboard/sign-out', 'middleware' => 'auth']);

Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth'], function()
{
	get('/dashboard', ['uses' => 'HomeController@home', 'as' => 'dashboard']);
	get('/dashboard/{tab}/get', ['uses' => 'HomeController@getTableItems']);
	get('/dashboard/{tab}/modal', ['uses' => 'HomeController@getModal']);
});