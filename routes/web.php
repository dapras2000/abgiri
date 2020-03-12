<?php

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

Route::get('/', 'FrontendController@index');

Route::get('/admin', function () {
    return view('admin.index');
});



Route::group(['prefix' => 'category'], function () {
    Route::get('', [
        'uses' => 'CategoryController@index',
        'as'   => 'category.index',
    ]);

    Route::get('/{id}', [
        'uses' => 'CategoryController@show',
        'as'   => 'category.show',
    ]);

    Route::post('/', [
        'uses' => 'CategoryController@store',
        'as'   => 'category.store',
    ]);

    Route::put('/{id}', [
        'uses' => 'CategoryController@update',
        'as'   => 'category.update',
    ]);

    Route::delete('/{id}', [
        'uses' => 'CategoryController@destroy',
        'as'   => 'category.destroy',
    ]);
});

Route::group(['prefix' => 'menu'], function () {
    Route::get('', [
        'uses' => 'MenuController@index',
        'as'   => 'menu.index',
    ]);

    Route::get('/{id}', [
        'uses' => 'MenuController@show',
        'as'   => 'menu.show',
    ]);

    Route::post('/', [
        'uses' => 'MenuController@store',
        'as'   => 'menu.store',
    ]);

    Route::put('/{id}', [
        'uses' => 'MenuController@update',
        'as'   => 'menu.update',
    ]);

    Route::delete('/{id}', [
        'uses' => 'MenuController@destroy',
        'as'   => 'menu.destroy',
    ]);
});


Route::group(['prefix' => 'setup'], function () {
    Route::get('', [
        'uses' => 'SetupController@index',
        'as'   => 'setup.index',
    ]);

    Route::get('/{id}', [
        'uses' => 'SetupController@show',
        'as'   => 'setup.show',
    ]);

    Route::post('/', [
        'uses' => 'SetupController@store',
        'as'   => 'setup.store',
    ]);

    Route::put('/{id}', [
        'uses' => 'SetupController@update',
        'as'   => 'setup.update',
    ]);

    Route::delete('/{id}', [
        'uses' => 'SetupController@destroy',
        'as'   => 'setup.destroy',
    ]);
});

Route::group(['prefix' => 'content'], function () {
    Route::get('', [
        'uses' => 'ContentController@index',
        'as'   => 'content.index',
    ]);

    Route::get('/{id}', [
        'uses' => 'ContentController@show',
        'as'   => 'content.show',
    ]);

    Route::post('/', [
        'uses' => 'ContentController@store',
        'as'   => 'content.store',
    ]);

    Route::put('/{id}', [
        'uses' => 'ContentController@update',
        'as'   => 'content.update',
    ]);

    Route::delete('/{id}', [
        'uses' => 'ContentController@destroy',
        'as'   => 'content.destroy',
    ]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
