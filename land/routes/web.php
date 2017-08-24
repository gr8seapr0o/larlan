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

Route::group(['middleware'=>'web'], function () {
//маруш для главной страницы
    Route::match(['get', 'post'], '/', ['uses'=>'IndexController@execute', 'as'=>'home']);

    Route::get('/page/{alias}', ['uses'=>'PageController@execute', 'as'=>'page']);
    //для админки- закрыторй части
    Route::auth();
} );
//для админки- закрыторй части
//admin/service или тому подобное

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function () {
    //admin
    Route::get('/', function() {

    });
    //admin/pages
    Route::group(['prefix'=>'pages'], function () {

        Route::get('/',['uses'=>'PagesController@execute', 'as'=>'pages']);
        //admin/pages/add
        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute', 'as'=>'pagesAdd']);
        //admin/pages/adit/2
        Route::match(['get','post', 'delete'],'/edit/{page}',['uses'=>'PagesEditController@execute', 'as'=>'pagesEdit']);


    });
    //portfolio
    Route::group(['prefix'=>'portfolio'], function () {

        Route::get('/',['uses'=>'PortfolioController@execute', 'as'=>'portfolio']);
        //portfolio/add
        Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execute', 'as'=>'portfolioAdd']);
        //portfolio/edit/
        Route::match(['get','post', 'delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execute', 'as'=>'portfolioEdit']);

    });
    Route::group(['prefix'=>'services'], function () {

        Route::get('/',['uses'=>'ServiceController@execute', 'as'=>'services']);

        Route::match(['get','post'],'/add',['uses'=>'ServiceAddController@execute', 'as'=>'serviceAdd']);

        Route::match(['get','post', 'delete'],'/edit/{service}',['uses'=>'ServiceEditController@execute', 'as'=>'serviceEdit']);

    });



});