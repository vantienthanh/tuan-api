<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/review', 'middleware' => ['jwt.auth']], function (Router $router) {
    $router->get('company', [
        'as' => 'api.review.company.list',
        'uses' => 'ReviewController@listCompany',
    ]);

    $router->get('company/{id}', [
        'as' => 'api.review.company.detail',
        'uses' => 'ReviewController@companyDetail',
    ]);

    $router->post('company', [
        'as' => 'api.review.company.create',
        'uses' => 'ReviewController@createCompany',
    ]);

    $router->post('create-review', [
        'as' => 'api.review.review.create',
        'uses' => 'ReviewController@createReview',
    ]);

    $router->get('like-comment/{id}', [
        'as' => 'api.review.like.send',
        'uses' => 'ReviewController@likeComment',
    ]);

    $router->get('dislike-comment/{id}', [
        'as' => 'api.review.dislike.send',
        'uses' => 'ReviewController@dislikeComment',
    ]);

    $router->get('search', [
        'as' => 'api.review.search.name',
        'uses' => 'ReviewController@search',
    ]);
});