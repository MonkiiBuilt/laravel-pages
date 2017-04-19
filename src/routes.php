<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 1:29 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

Route::group(['prefix' => 'admin', 'namespace' => 'MonkiiBuilt\LaravelPages', 'middleware' => ['laravel-administrator-menus', 'web']], function () {

    Route::get('/pages', ['as' => 'laravel-administrator-pages', 'uses' => 'Controllers\PagesAdminController@index']);

    Route::post('/pages', ['as' => 'laravel-administrator-pages-post', 'uses' => 'Controllers\PagesAdminController@store']);

    Route::get('/pages/create', ['as' => 'laravel-administrator-pages-create', 'uses' => 'Controllers\PagesAdminController@create']);

    Route::get('/pages/{id}/edit', ['as' => 'laravel-administrator-pages-edit', 'uses' => 'Controllers\PagesAdminController@edit']);

    Route::put('/pages/{id}', ['as' => 'laravel-administrator-pages-put', 'uses' => 'Controllers\PagesAdminController@update']);

    Route::delete('/pages/{id}', ['as' => 'laravel-administrator-pages-delete', 'uses' => 'Controllers\PagesAdminController@destroy']);

});