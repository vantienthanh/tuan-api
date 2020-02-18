<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/mobile', 'middleware' => ['jwt.auth']], function (Router $router) {
    $router->get('list-news', [
        'as' => 'api.news.mobile.list',
        'uses' => 'NewsController@listNews',
    ]);

    $router->get('news-detail/{id}', [
        'as' => 'api.news.mobile.detail',
        'uses' => 'NewsController@newsDetail',
    ]);
});