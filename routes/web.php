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
	
	Route::get('/static-pages', 'AdminController@staticPages')->name('admin.static-pages');
	Route::get('/static-pages/{id}', 'AdminController@page')->name('admin.static-pages.page');
	Route::get('/static-pages/add', 'AdminController@addPage')->name('admin.static-pages.add');
	Route::get('/static-pages/edit/{id?}', 'AdminController@editPage')->name('admin.static-pages.edit');
	
	Route::get('/categories', 'AdminController@categories')->name('admin.categories');
	Route::get('/categories/{id}', 'AdminController@category')->name('admin.categories.category');
	Route::get('/categories/add', 'AdminController@addCategory')->name('admin.categories.add');
	Route::get('/categories/edit/{id?}', 'AdminController@editCategory')->name('admin.categories.edit');
	
	Route::get('/products', 'AdminController@products')->name('admin.products');
	Route::get('/products/{id}', 'AdminController@product')->name('admin.products.product');
	Route::get('/products/add', 'AdminController@addProduct')->name('admin.products.add');
	Route::get('/products/edit/{id?}', 'AdminController@editProduct')->name('admin.products.edit');
	
	Route::get('/logout', 'AuthController@logout')->name('admin.logout');
});