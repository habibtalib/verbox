<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

// the admin route group
Route::group([
    'namespace' => 'Admin',
    'prefix' => config('varbox.admin.prefix', 'admin'),
    'middleware' => [
        'varbox.auth.session:admin',
        'varbox.authenticated:admin',
        'varbox.check.roles',
        'varbox.check.permissions',
    ],
], function () {
    // the posts route group
    Route::group([
        'prefix' => 'posts',
    ], function () {
        // the crud routes
        Route::get('/', [
            'as' => 'admin.posts.index',
            'uses' => 'PostsController@index',
            'permissions' => 'posts-list',
        ]);

        Route::get('create', [
            'as' => 'admin.posts.create',
            'uses' => 'PostsController@create',
            'permissions' => 'posts-add',
        ]);

        Route::get('csv', [
            'as' => 'admin.posts.csv',
            'uses' => 'PostsController@csv',
            'permissions' => 'posts-export',
        ]);

        Route::post('store', [
            'as' => 'admin.posts.store',
            'uses' => 'PostsController@store',
            'permissions' => 'posts-add',
        ]);

        Route::patch('order', [
            'as' => 'admin.posts.order',
            'uses' => 'PostsController@order',
            'permissions' => 'posts-list',
        ]);

        Route::get('edit/{post}', [
            'as' => 'admin.posts.edit',
            'uses' => 'PostsController@edit',
            'permissions' => 'posts-edit',
        ]);

        Route::put('update/{post}', [
            'as' => 'admin.posts.update',
            'uses' => 'PostsController@update',
            'permissions' => 'posts-edit',
        ]);

        Route::delete('destroy/{post}', [
            'as' => 'admin.posts.destroy',
            'uses' => 'PostsController@destroy',
            'permissions' => 'posts-delete',
        ]);
    });
});