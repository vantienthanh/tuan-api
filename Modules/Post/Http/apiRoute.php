<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/post', 'middleware' => ['jwt.auth']], function (Router $router) {
    $router->get('employer', [
        'as' => 'api.post.employer.list',
        'uses' => 'PostController@listEmployer',
    ]);

    $router->post('employer', [
        'as' => 'api.post.employer.create',
        'uses' => 'PostController@createEmployer',
    ]);

    $router->get('news-detail/{id}', [
        'as' => 'api.news.mobile.detail',
        'uses' => 'NewsController@newsDetail',
    ]);
});