<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/news'], function (Router $router) {
    $router->bind('news', function ($id) {
        return app('Modules\News\Repositories\NewsRepository')->find($id);
    });
    $router->get('news', [
        'as' => 'admin.news.news.index',
        'uses' => 'NewsController@index',
        'middleware' => 'can:news.news.index'
    ]);
    $router->get('news/create', [
        'as' => 'admin.news.news.create',
        'uses' => 'NewsController@create',
        'middleware' => 'can:news.news.create'
    ]);
    $router->post('news', [
        'as' => 'admin.news.news.store',
        'uses' => 'NewsController@store',
        'middleware' => 'can:news.news.create'
    ]);
    $router->get('news/{news}/edit', [
        'as' => 'admin.news.news.edit',
        'uses' => 'NewsController@edit',
        'middleware' => 'can:news.news.edit'
    ]);
    $router->put('news/{news}', [
        'as' => 'admin.news.news.update',
        'uses' => 'NewsController@update',
        'middleware' => 'can:news.news.edit'
    ]);
    $router->delete('news/{news}', [
        'as' => 'admin.news.news.destroy',
        'uses' => 'NewsController@destroy',
        'middleware' => 'can:news.news.destroy'
    ]);
// append

});
