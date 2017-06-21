<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 1:29 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

Route::group(['prefix' => 'admin', 'namespace' => 'MonkiiBuilt\LaravelPages', 'middleware' => ['laravel-administrator-menus', 'web', 'auth']], function () {

    Route::get('/pages', ['as' => 'laravel-administrator-pages', 'uses' => 'Controllers\PagesAdminController@index']);

    Route::post('/pages', ['as' => 'laravel-administrator-pages-post', 'uses' => 'Controllers\PagesAdminController@store']);

    Route::get('/pages/create', ['as' => 'laravel-administrator-pages-create', 'uses' => 'Controllers\PagesAdminController@create']);

    Route::get('/pages/{id}/edit', ['as' => 'laravel-administrator-pages-edit', 'uses' => 'Controllers\PagesAdminController@edit']);

    Route::put('/pages/{id}', ['as' => 'laravel-administrator-pages-put', 'uses' => 'Controllers\PagesAdminController@update']);

    Route::delete('/pages/{id}', ['as' => 'laravel-administrator-pages-delete', 'uses' => 'Controllers\PagesAdminController@destroy']);

    Route::get('/pages/{pageId}/meta', ['as' => 'laravel-administrator-pages-meta', 'uses' => 'Controllers\MetaTagsController@create']);

    Route::post('/pages/{pageId}/meta-store', ['as' => 'laravel-administrator-pages-meta-store', 'uses' => 'Controllers\MetaTagsController@store']);

    Route::put('/pages/{pageId}/meta-update', ['as' => 'laravel-administrator-pages-meta-update', 'uses' => 'Controllers\MetaTagsController@update']);

    Route::get('/pages/{id}/meta-edit', ['as' => 'laravel-administrator-pages-meta-edit', 'uses' => 'Controllers\MetaTagsController@edit']);

    Route::delete('/pages/{id}/meta-delete', ['as' => 'laravel-administrator-pages-meta-delete', 'uses' => 'Controllers\MetaTagsController@delete']);

});