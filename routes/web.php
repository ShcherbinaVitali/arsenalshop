<?php

Route::get('/', 'MainController@home')->name('home');

Route::prefix('pages')->group(function () {
	Route::get('/', 'MainController@pageList')->name('static.page-list');
	Route::get('/{page}', 'MainController@page')->name('static.page');
});

Route::prefix('catalog')->group(function () {
	Route::get('/', 'CategoryController@categoryList')->name('catalog.category-list');
	Route::get('/{category}/{category2?}/{category3?}/{category4?}/{product?}', 'CategoryController@category')->name('catalog.category');
	Route::post('products-on-page', 'MainController@setProductOnPage')->name('set.count');
	Route::post('view-products', 'MainController@setViewProducts')->name('set.view-products');
});

Route::prefix('search')->group(function () {
	Route::get('/', 'MainController@search')->name('search');
	//Route::get('results/{query}', 'MainController@results')->name('search.results');
});

Auth::routes();
Route::prefix('admin')->group(function() {
	Route::get('/', 'AuthController@showLoginForm')->name('admin.login.form');
	Route::post('/login', 'AuthController@login')->name('admin.signin');
	Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
	
	Route::get('/main-info', 'AdminController@mainInfo')->name('admin.main-info');
	Route::get('/main-info/{id}', 'AdminController@info')->where('id', '[0-9]+')->name('admin.main-info.info');
	Route::get('/main-info/add', 'AdminController@addInfo')->name('admin.main-info.add');
	Route::get('/main-info/edit/{id?}', 'AdminController@editInfo')->where('id', '[0-9]+')->name('admin.main-info.edit');
	Route::post('/main-info/save', 'AdminController@saveInfo')->name('admin.main-info.save');
	Route::get('/main-info/delete/{id}', 'AdminController@deleteInfo')->where('id', '[0-9]+')->name('admin.main-info.delete');
	
	
	Route::get('/static-pages', 'AdminController@staticPages')->name('admin.static-pages');
	Route::get('/static-pages/{id}', 'AdminController@page')->where('id', '[0-9]+')->name('admin.static-pages.page');
	Route::get('/static-pages/add', 'AdminController@addPage')->name('admin.static-pages.add');
	Route::get('/static-pages/edit/{id?}', 'AdminController@editPage')->where('id', '[0-9]+')->name('admin.static-pages.edit');
	Route::post('/static-pages/save', 'AdminController@savePage')->name('admin.static-pages.save');
	Route::get('/static-pages/delete/{id}', 'AdminController@deletePage')->where('id', '[0-9]+')->name('admin.static-pages.delete');
	
	Route::get('/categories', 'AdminController@categories')->name('admin.categories');
	Route::get('/categories/{id}', 'AdminController@category')->where('id', '[0-9]+')->name('admin.categories.category');
	Route::get('/categories/add', 'AdminController@addCategory')->name('admin.categories.add');
	Route::get('/categories/edit/{id?}', 'AdminController@editCategory')->where('id', '[0-9]+')->name('admin.categories.edit');
	Route::post('/categories/save', 'AdminController@saveCategory')->name('admin.categories.save');
	Route::get('/categories/delete/{id}', 'AdminController@deleteCategory')->where('id', '[0-9]+')->name('admin.categories.delete');
	
	Route::get('/products', 'AdminController@products')->name('admin.products');
	Route::get('/products/{id}', 'AdminController@product')->where('id', '[0-9]+')->name('admin.products.product');
	Route::get('/products/add', 'AdminController@addProduct')->name('admin.products.add');
	Route::get('/products/edit/{id?}', 'AdminController@editProduct')->where('id', '[0-9]+')->name('admin.products.edit');
	Route::post('/products/save', 'AdminController@saveProduct')->name('admin.products.save');
	Route::get('/products/delete/{id}', 'AdminController@deleteProduct')->where('id', '[0-9]+')->name('admin.products.delete');
	
	Route::post('/image/delete', 'AdminController@deleteProductImage');
	
	Route::get('/logout', 'AuthController@logout')->name('admin.logout');
});