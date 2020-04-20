<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/post'], function (Router $router) {
    $router->bind('post', function ($id) {
        return app('Modules\Post\Repositories\PostRepository')->find($id);
    });
    $router->get('posts', [
        'as' => 'admin.post.post.index',
        'uses' => 'PostController@index',
        'middleware' => 'can:post.posts.index'
    ]);
    $router->get('posts/create', [
        'as' => 'admin.post.post.create',
        'uses' => 'PostController@create',
        'middleware' => 'can:post.posts.create'
    ]);
    $router->post('posts', [
        'as' => 'admin.post.post.store',
        'uses' => 'PostController@store',
        'middleware' => 'can:post.posts.create'
    ]);
    $router->get('posts/{post}/edit', [
        'as' => 'admin.post.post.edit',
        'uses' => 'PostController@edit',
        'middleware' => 'can:post.posts.edit'
    ]);
    $router->put('posts/{post}', [
        'as' => 'admin.post.post.update',
        'uses' => 'PostController@update',
        'middleware' => 'can:post.posts.edit'
    ]);
    $router->delete('posts/{post}', [
        'as' => 'admin.post.post.destroy',
        'uses' => 'PostController@destroy',
        'middleware' => 'can:post.posts.destroy'
    ]);
// append

});
