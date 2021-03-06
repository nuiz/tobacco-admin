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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'login'=> 'LoginCTL',
	'content/video'=> 'ContentVideoCTL',
	'content'=> 'ContentCTL',
	'logout'=> 'LogoutCTL',
	'usercluster'=> 'UserClusterCTL',
	'userwriter'=> 'UserWriterCTL',
	'news'=> 'NewsCTL',
	'config'=> 'ConfigCTL',
	'faq'=> 'FAQCTL',
	'guru'=> 'GuruCTL',
	'kmcenter'=> 'KmcenterCTL',
	'ip'=> 'IPCTL',
	'exam'=> 'ContentExamCTL',
]);
