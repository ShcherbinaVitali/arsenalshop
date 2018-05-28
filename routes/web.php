<?php

Route::get('/', 'MainController@home')->name('home');

Route::prefix('pages')->group(function () {
	Route::get('/', 'MainController@pageList')->name('static.page-list');
	Route::get('/{page}', 'MainController@page')->name('static.page');
});

Route::prefix('catalog')->group(function () {
	Route::get('/', 'CategoryController@categoryList')->name('catalog.category-list');
	Route::get('/{category}/{category2?}/{category3?}/{category4?}/{product?}', 'CategoryController@category')->name('catalog.category');
	
});

Auth::routes();
Route::prefix('admin')->group(function() {
	Route::get('/', 'AuthController@showLoginForm')->name('admin.login.form');
	Route::post('/login', 'AuthController@login')->name('admin.signin');
	Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
	Route::get('/logout', 'AuthController@logout')->name('admin.logout');
});