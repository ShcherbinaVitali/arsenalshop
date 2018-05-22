<?php

Route::get('/', "MainController@home");


/** 
 * At first migration comment pages
 * these routes are created dynamically
 * 
 * ToDo - move to another place
 */

$pages = \App\Helpers\AppHelper::getPages();

foreach ($pages as $page) {
	Route::view('/' . $page->alias, 
		'pages.product', ['content' => $page->content]
	);
}


Auth::routes();
Route::prefix('admin')->group(function() {
	Route::get('/', 'AuthController@showLoginForm')->name('admin.login.form');
	Route::post('/login', 'AuthController@login')->name('admin.signin');
	Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
	Route::get('/logout', 'AuthController@logout')->name('admin.logout');
});