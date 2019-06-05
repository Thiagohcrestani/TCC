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



$router->group(['prefix' => "api/tcc"], function() use ($router){
	$router->get("/", "tccController@getAll");
	$router->get("/{idberco}", "tccController@get");
	$router->post("/", "tccController@store");
	$router->put("/{idberco}", "tccController@update");
	$router->delete("/{idberco}", "tccController@destroy");
});

