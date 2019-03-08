<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Route::get('/login', 'Auth\LoginController@top');
Route::get('/login/github', 'Auth\LoginController@redirectToProvider');
Route::get('/login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@top');
Route::get('/next', 'HomeController@next');
Route::get('/previous', 'HomeController@previous');

Route::get('/post', 'PostController@top');
Route::post('/upload', 'PostController@upload');
Route::post('/delete', 'PostController@delete');
Route::post('/like', 'PostController@like');
Route::post('/unlike', 'PostController@unlike');
Route::post('/whois', 'PostController@whoisliked');

Route::get('/{github_id}', 'UserController@top');
