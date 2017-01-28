<?php

/*
|--------------------------------------------------------------------------
| Tasks Routes
|--------------------------------------------------------------------------
*/

$app->group(['prefix' => 'tasks'], function () use ($app) {
    $app->get('', 'TaskController@retrieveList');
    $app->get('{tid}', 'TaskController@retrieve');
    $app->post('', 'TaskController@create');
    $app->delete('{tid}', 'TaskController@delete');
    $app->put('{tid}', 'TaskController@update');
});
