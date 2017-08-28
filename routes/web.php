<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


$app->group(['prefix' => 'v1'], function ($app) {
	$app->get('/book', 'BooksController@index');
	$app->post('/book', 'BooksController@store');
	$app->get('/book/{slug}', 'BooksController@show');
	$app->put('/book/{id}', 'BooksController@update');
	$app->delete('/book/{id}', 'BooksController@destroy');

	$app->get('/author', 'AuthorsController@index');
	$app->post('/author', 'AuthorsController@store');
	$app->get('/author/{id}', 'AuthorsController@show');
	$app->put('/author/{id}', 'AuthorsController@update');
	$app->delete('/author/{id}', 'AuthorsController@destroy');
});
