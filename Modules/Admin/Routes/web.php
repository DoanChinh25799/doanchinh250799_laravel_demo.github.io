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

Route::prefix('authenticate')->group(function (){
    Route::get('/login','AdminAuthController@getLogin')->name('admin.login');
    Route::post('/login','AdminAuthController@postLogin');
    Route::get('/logout','AdminAuthController@getLogout')->name('admin.logout');
});

Route::prefix('admin')->middleware('CheckAdminLogin')->group(function() {
//Route::group(['middleware' => 'CheckAdminLogin', 'prefix' => 'admin'], function() {

    Route::get('/', 'AdminController@index')->name('admin.home');

    Route::group(['prefix'=>'category'], function (){
        Route::get('/','AdminCategoryController@index')->name('admin.get.list.category');
        Route::get('/create','AdminCategoryController@create')->name('admin.get.create.category');
        Route::post('/create','AdminCategoryController@store');

        Route::get('/update/{id}','AdminCategoryController@edit')->name('admin.get.edit.category');
        Route::post('/update/{id}','AdminCategoryController@update');

        Route::get('/{action}/{id}','AdminCategoryController@action')->name('admin.get.action.category');

    });

    Route::group(['prefix'=>'product'], function (){
        Route::get('/','AdminProductController@index')->name('admin.get.list.product');
        Route::get('/create','AdminProductController@create')->name('admin.get.create.product');
        Route::post('/create','AdminProductController@store');

        Route::get('/update/{id}','AdminProductController@edit')->name('admin.get.edit.product');
        Route::post('/update/{id}','AdminProductController@update');

        Route::get('/{action}/{id}','AdminProductController@action')->name('admin.get.action.product');

    });

    Route::group(['prefix'=>'article'], function (){
        Route::get('/','AdminArticleController@index')->name('admin.get.list.article');
        Route::get('/create','AdminArticleController@create')->name('admin.get.create.article');
        Route::post('/create','AdminArticleController@store');

        Route::get('/update/{id}','AdminArticleController@edit')->name('admin.get.edit.article');
        Route::post('/update/{id}','AdminArticleController@update');

        Route::get('/{action}/{id}','AdminArticleController@action')->name('admin.get.action.article');

    });

    Route::group(['prefix'=>'properties'], function (){
        Route::get('/','AdminPropertiesController@index')->name('admin.get.list.properties');
        Route::get('/create','AdminPropertiesController@create')->name('admin.get.create.properties');
        Route::post('/create','AdminPropertiesController@store');

        Route::get('/update/{id}','AdminPropertiesController@edit')->name('admin.get.edit.properties');
        Route::post('/update/{id}','AdminPropertiesController@update');

        Route::get('/{action}/{id}','AdminPropertiesController@action')->name('admin.get.action.properties');

    });

    Route::group(['prefix'=>'transaction'], function (){
        Route::get('/','AdminTransactionController@index')->name('admin.get.list.transaction');
        Route::get('/view/{id}','AdminTransactionController@viewOrder')->name('admin.get.view.order');
        Route::get('/active/{id}','AdminTransactionController@actionTransaction')->name('admin.get.active.transaction');
        Route::get('/{action}/{id}','AdminTransactionController@action')->name('admin.get.action.transaction');

    });

    Route::group(['prefix'=>'account'], function (){
        Route::get('/','AdminAccountController@index')->name('admin.get.list.account');
        Route::get('/{action}/{id}','AdminAccountController@action')->name('admin.get.action.account');
    });

    Route::group(['prefix'=>'contact'], function (){
        Route::get('/','AdminContactController@index')->name('admin.get.list.contact');
        Route::get('/{action}/{id}','AdminContactController@action')->name('admin.get.action.contact');
    });
});
