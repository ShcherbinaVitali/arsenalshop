<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use App\Helpers\AppHelper;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:admin');
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$admin = AppHelper::getCurrentAdmin();
		
		return view('pages.panel.admin', ['admin' => $admin]);
	}
	
	public function staticPages() {
		$admin = AppHelper::getCurrentAdmin();
		$pages = Page::all();
		
		return view(
			'pages.panel.list',
			[
				'admin'      => $admin,
				'title'      => 'Список Страниц',
				'btn_title'  => 'Добавить страницу',
				'btn_route'  => 'admin.static-pages.add',
				'route_name' => 'admin.static-pages.page',
				'list'       => $pages
			]
		);
	}
	
	public function categories() {
		$admin      = AppHelper::getCurrentAdmin();
		$categories = Category::all();
		
		return view(
			'pages.panel.list',
			[
				'admin'      => $admin,
				'title'      => 'Список Категорий',
				'btn_title'  => 'Добавить категорию',
				'btn_route'  => 'admin.categories.add',
				'route_name' => 'admin.categories.category',
				'list'       => $categories
			]
		);
	}
	
	public function products() {
		$admin    = AppHelper::getCurrentAdmin();
		$products = Product::all();
		
		return view(
			'pages.panel.list',
			[
				'admin'      => $admin,
				'title'      => 'Список Продуктов',
				'btn_title'  => 'Добавить продукт',
				'btn_route'  => 'admin.products.add',
				'route_name' => 'admin.products.product',
				'list'       => $products
			]
		);
	}
}
