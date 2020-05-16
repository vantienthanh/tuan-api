<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/review'], function (Router $router) {
    $router->bind('company', function ($id) {
        return app('Modules\Review\Repositories\CompanyRepository')->find($id);
    });
    $router->get('companies', [
        'as' => 'admin.review.company.index',
        'uses' => 'CompanyController@index',
        'middleware' => 'can:review.companies.index'
    ]);
    $router->get('companies/create', [
        'as' => 'admin.review.company.create',
        'uses' => 'CompanyController@create',
        'middleware' => 'can:review.companies.create'
    ]);
    $router->post('companies', [
        'as' => 'admin.review.company.store',
        'uses' => 'CompanyController@store',
        'middleware' => 'can:review.companies.create'
    ]);
    $router->get('companies/{company}/edit', [
        'as' => 'admin.review.company.edit',
        'uses' => 'CompanyController@edit',
        'middleware' => 'can:review.companies.edit'
    ]);
    $router->put('companies/{company}', [
        'as' => 'admin.review.company.update',
        'uses' => 'CompanyController@update',
        'middleware' => 'can:review.companies.edit'
    ]);
    $router->delete('companies/{company}', [
        'as' => 'admin.review.company.destroy',
        'uses' => 'CompanyController@destroy',
        'middleware' => 'can:review.companies.destroy'
    ]);
    $router->bind('review', function ($id) {
        return app('Modules\Review\Repositories\ReviewRepository')->find($id);
    });
    $router->get('reviews', [
        'as' => 'admin.review.review.index',
        'uses' => 'ReviewController@index',
        'middleware' => 'can:review.reviews.index'
    ]);
    $router->get('reviews/create', [
        'as' => 'admin.review.review.create',
        'uses' => 'ReviewController@create',
        'middleware' => 'can:review.reviews.create'
    ]);
    $router->post('reviews', [
        'as' => 'admin.review.review.store',
        'uses' => 'ReviewController@store',
        'middleware' => 'can:review.reviews.create'
    ]);
    $router->get('reviews/{review}/edit', [
        'as' => 'admin.review.review.edit',
        'uses' => 'ReviewController@edit',
        'middleware' => 'can:review.reviews.edit'
    ]);
    $router->put('reviews/{review}', [
        'as' => 'admin.review.review.update',
        'uses' => 'ReviewController@update',
        'middleware' => 'can:review.reviews.edit'
    ]);
    $router->delete('reviews/{review}', [
        'as' => 'admin.review.review.destroy',
        'uses' => 'ReviewController@destroy',
        'middleware' => 'can:review.reviews.destroy'
    ]);
// append


});
