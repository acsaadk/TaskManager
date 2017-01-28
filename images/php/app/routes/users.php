<?php

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/

$app->group(['middleware' => 'auth:api', 'prefix' => 'users'], function () use ($app) {
    $app->get('me', 'UserController@retrieve');
    $app->get('me/tasks', 'UserController@getTasks');
    $app->put('me', 'UserController@update');
    $app->get('{uid}', 'UserController@retrieve');
    $app->get('', 'UserController@retrieveList');
    $app->post('', 'UserController@create');
    $app->delete('{uid}', 'UserController@delete');
    $app->put('{uid}', 'UserController@update');
    $app->get('{uid}/tasks', 'UserController@getTasks');
});
