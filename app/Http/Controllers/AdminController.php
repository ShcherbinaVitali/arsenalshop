<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use App\Helpers\AppHelper;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
		$pages = Page::all();
		
		return view(
			'pages.panel.list',
			[
				'title'      => 'Список Страниц',
				'btn_title'  => 'Добавить страницу',
				'btn_route'  => 'admin.static-pages.add',
				'route_name' => 'admin.static-pages.page',
				'list'       => $pages
			]
		);
	}
	
	public function page($id) {
		$page = Page::findOrFail($id);
		
		return view(
			'pages.panel.static-pages.view',
			[
				'page' => $page
			]
		);
	}
	
	public function addPage() {
		$request = Request::create(route('admin.static-pages.edit'), 'GET');
		
		return Route::dispatch($request);
	}
	
	public function editPage($id = 0) {
		if ($id != 0) {
			$pageModel = Page::findOrFail($id);
			
			return view(
				'pages.panel.static-pages.edit',
				[
					'page' => $pageModel
				]
			);
		}
		else {
			return view(
				'pages.panel.static-pages.edit'
			);
		}
	}
	
	public function savePage(Request $request) {
		$data    = $request->all();
		$message = 'Error saving the Page';
		$id      = '';
		if (isset($data['id'])) {
			$id = $data['id'];
			unset($data['id']);
		}
		
		if ( count($data) > 0 ) {
			if ( $id ) {
				$pageModel = Page::findOrFail($id);
				
				$pageModel->fill($data);
				try {
					$pageModel->save();
					$message = "The Page ID: {$pageModel->id} successfully updated";
				}
				catch (\Exception $e) {
					$message = $e->getMessage();
				}
			}
			else {
				$pageModel = new Page;
				$pageModel->fill($data);
				
				try {
					$pageModel->save();
					$message = 'The Page successfully created';
				}
				catch (\Exception $e) {
					$message = $e->getMessage();
				}
			}
		}
		
		return redirect()->route('admin.static-pages')->with('message', $message);
	}
	
	public function deletePage($id) {
		$message = 'Error deleting the page';
		if ($id) {
			Page::destroy($id);
			$message = 'The page is deleted successfully';
		}
		
		return redirect()->route('admin.static-pages')->with('message', $message);
	}
	
	public function categories() {
		$categories = Category::all();
		
		return view(
			'pages.panel.list',
			[
				'title'      => 'Список Категорий',
				'btn_title'  => 'Добавить категорию',
				'btn_route'  => 'admin.categories.add',
				'route_name' => 'admin.categories.category',
				'list'       => $categories
			]
		);
	}
	
	public function category($id) {
		$category       = Category::findOrFail($id);
		$parentCategory = 'Корневая категория';
		
		if ( $category->parent_id != 0 ) {
			$parentId       = $category->parent_id;
			$parentModel    = Category::findOrFail($parentId);
			$parentCategory = $parentModel->title;
		}
		
		return view(
			'pages.panel.categories.view',
			[
				'category'        => $category,
				'parent_category' => $parentCategory
			]
		);
	}
	
	public function addCategory() {
		$request = Request::create(route('admin.categories.edit'), 'GET');
		
		return Route::dispatch($request);
	}
	
	public function editCategory($id = 0) {
		$categoryList  = Category::all()->where('id', '!=', $id);
		
		if ($id != 0) {
			$categoryModel = Category::findOrFail($id);
			
			return view(
				'pages.panel.categories.edit',
				[
					'category_list' => $categoryList,
					'category'      => $categoryModel
				]
			);
		}
		else {
			return view(
				'pages.panel.categories.edit',
				[
					'category_list' => $categoryList
				]
			);
		}
		
	}
	
	public function saveCategory(Request $request) {
		$data    = $request->all();
		$message = 'Error saving the Category';
		$id      = '';
		if (isset($data['id'])) {
			$id = $data['id'];
			unset($data['id']);
		}
		
		if ( count($data) > 0 ) {
			if ( $id ) {
				$categoryModel = Category::findOrFail($id);
				
				$categoryModel->fill($data);
				try {
					$categoryModel->save();
					$message = "The Category ID: {$categoryModel->id} successfully updated";
				}
				catch (\Exception $e) {
					$message = $e->getMessage();
				}
			}
			else {
				$categoryModel = new Category;
				$categoryModel->fill($data);
				
				try {
					$categoryModel->save();
					$message = 'The Category successfully created';
				}
				catch (\Exception $e) {
					$message = $e->getMessage();
				}
			}
		}
		
		return redirect()->route('admin.categories')->with('message', $message);
	}
	
	public function deleteCategory($id) {
		$message = 'Error deleting the Category';
		if ($id) {
			Category::destroy($id);
			$message = 'The Category is deleted successfully';
		}
		
		return redirect()->route('admin.categories')->with('message', $message);
	}
	
	public function products() {
		$products = Product::all();
		
		return view(
			'pages.panel.list',
			[
				'title'      => 'Список Продуктов',
				'btn_title'  => 'Добавить продукт',
				'btn_route'  => 'admin.products.add',
				'route_name' => 'admin.products.product',
				'list'       => $products
			]
		);
	}
}
