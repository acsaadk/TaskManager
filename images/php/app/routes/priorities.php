<?php

/*
|--------------------------------------------------------------------------
| Priorities Routes
|--------------------------------------------------------------------------
*/

$app->group(['prefix' => 'priorities'], function () use ($app) {
    $app->get('', 'PriorityController@retrieveList');
    $app->post('', 'PriorityController@create');
    $app->delete('{pid}', 'PriorityController@delete');
});
