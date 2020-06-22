<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/post', 'middleware' => ['jwt.auth']], function (Router $router) {
    $router->get('employer', [
        'as' => 'api.post.employer.list',
        'uses' => 'PostController@listEmployer',
    ]);

    $router->get('employer/{id}', [
        'as' => 'api.post.employer.detail',
        'uses' => 'PostController@employerDetail',
    ]);

    $router->post('employer', [
        'as' => 'api.post.employer.create',
        'uses' => 'PostController@createEmployer',
    ]);

    $router->get('employer/search/{string}', [
        'as' => 'api.post.employer.search',
        'uses' => 'PostController@searchEmployer',
    ]);

    $router->get('member', [
        'as' => 'api.post.member.list',
        'uses' => 'PostController@listMember',
    ]);

    $router->get('member/{id}', [
        'as' => 'api.post.member.detail',
        'uses' => 'PostController@memberDetail',
    ]);

    $router->post('member', [
        'as' => 'api.post.member.create',
        'uses' => 'PostController@createMember',
    ]);

    $router->get('member/search/{string}', [
        'as' => 'api.post.member.search',
        'uses' => 'PostController@searchMember',
    ]);

    $router->post('comment', [
        'as' => 'api.post.member.create',
        'uses' => 'PostController@postComment',
    ]);

    $router->get('like/{id}', [
        'as' => 'api.post.like.send',
        'uses' => 'PostController@likeOrrUnlike',
    ]);
});