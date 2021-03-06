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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('students',  ['uses' => 'StudentController@showAllstudents']);
    $router->get('students/{id}', ['uses' => 'StudentController@showOneStudent']);
    $router->post('students', ['uses' => 'StudentController@create']);
    $router->post('students/anu',['uses' => 'StudentController@anu']);
    // $router->delete('students/{id}', ['uses' => 'StudentController@delete']);
    $router->put('students/{id}', ['uses' => 'StudentController@update']);
});
