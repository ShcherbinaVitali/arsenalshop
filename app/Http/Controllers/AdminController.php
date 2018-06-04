<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use App\Helpers\AppHelper;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
		$data['content'] = e($data['content']);
		
		if (isset($data['id'])) {
			$id = $data['id'];
			unset($data['id']);
		}
		
		if ( $data && count($data) > 0 ) {
			if ( $id ) {
				$pageModel = Page::findOrFail($id);
				
				$pageModel->fill($data);
				try {
					$pageModel->save();
					$message = "The Page ID: {$pageModel->id} is updated successfully";
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
					$message = 'The Page is created successfully';
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
		
		if ( $data && count($data) > 0 ) {
			if ( $id ) {
				$categoryModel = Category::findOrFail($id);
				
				$categoryModel->fill($data);
				try {
					$categoryModel->save();
					$message = "The Category ID: {$categoryModel->id} is updated successfully";
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
					$message = 'The Category is created successfully';
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
				'title'      => 'Список Товаров',
				'btn_title'  => 'Добавить товар',
				'btn_route'  => 'admin.products.add',
				'route_name' => 'admin.products.product',
				'list'       => $products
			]
		);
	}
	
	public function product($id) {
		$product        = Product::findOrFail($id);
		$parentCategory = 'Корневая категория';
		
		if ( $product->category_id != 0 ) {
			$categoryId     = $product->category_id;
			$categoryModel  = Category::findOrFail($categoryId);
			$parentCategory = $categoryModel->title;
		}
		
		return view(
			'pages.panel.products.view',
			[
				'product'         => $product,
				'parent_category' => $parentCategory
			]
		);
	}
	
	public function addProduct() {
		$request = Request::create(route('admin.products.edit'), 'GET');
		
		return Route::dispatch($request);
	}
	
	public function editProduct($id = 0) {
		$categoryList  = AppHelper::getCategories();
		
		if ($id != 0) {
			$productModel = Product::findOrFail($id);
			
			return view(
				'pages.panel.products.edit',
				[
					'category_list' => $categoryList,
					'product'       => $productModel
				]
			);
		}
		else {
			return view(
				'pages.panel.products.edit',
				[
					'category_list' => $categoryList
				]
			);
		}
	}
	
	public function saveProduct(Request $request) {
		$data    = $request->all();
		$message = 'Error saving the Product';
		$id      = '';
		$data['description'] = e($data['description']);
		
		if ( isset($data['id']) ) {
			$id = $data['id'];
			unset($data['id']);
		}
		
		$productImages = $request->file('product_image');
		unset($data['product_image']);
		
		if ( $data && count($data) > 0 ) {
			if ( $id ) {
				$productModel = Product::findOrFail($id);
				
				$productModel->fill($data);
				try {
					$productModel->save();
					$message = "The Product ID: {$productModel->id} is updated successfully";
				}
				catch (\Exception $e) {
					$message = $e->getMessage();
				}
			}
			else {
				$productModel = new Product;
				$productModel->fill($data);
				
				try {
					$productModel->save();
					$message = 'The Product is created successfully';
				}
				catch (\Exception $e) {
					$message = $e->getMessage();
				}
				$id = $productModel->id;
			}
			
			if ( $productImages && count($productImages) > 0 ) {
				$done = $this->saveProductImages($id, $productImages);
				
				if (!$done) {
					$message = 'Error saving image(s)';
				}
			}
		}
		
		return redirect()->route('admin.products')->with('message', $message);
	}
	
	public function saveProductImages($id, array $productImages) {
		$imgName  = Carbon::now()->timestamp;
		
		for ($i = 0; $i < count($productImages); $i++) {
			$mimeType    = $productImages[$i]->getClientOriginalExtension();
			$fullImgName = $imgName . '_' . $i . '.' . $mimeType;
			
			$productImages[$i]
				->storeAs(
					'public/images/products/' . $id,
					$fullImgName
				);
			$imageModel = new ProductImage;
			$imageModel->product_id = $id;
			$imageModel->name       = $fullImgName;
			
			try {
				$imageModel->save();
			}
			catch (\Exception $e) {
				Log::error($e->getMessage());
				return false;
			}
		}
		
		return true;
	}
	
	public function deleteProductImages($product_id) {
		$productImages = ProductImage::all()
			->where('product_id', '=', $product_id);
		if ( count($productImages) > 0 ) {
			foreach ($productImages as $productImage) {
				try {
					Storage::delete('public/images/products/' . $product_id . '/' . $productImage->name);
					$productImage->delete();
				}
				catch (\Exception $e) {
					Log::error($e->getMessage());
					return false;
				}
			}
			return true;
		}
	}
	
	public function deleteProductImage(Request $request) {
		$success = false;
		$message = 'Error deleting image';
		$data    = $request->all();
		$id      = (int) $data['id'];
		$name    = $data['name'];
		
		$productImage = ProductImage::where([
			['name', '=', $name],
			['product_id', '=', $id]
		])->get()->first();
		
		if ($productImage) {
			Storage::delete('public/images/products/' . $productImage->product_id . '/' . $productImage->name);
			$productImage->delete();
			$success = true;
			$message = 'The image is deleted successfully';
		}
		
		return response()->json([
			'success' => $success,
			'message' => $message
		]);
	}
	
	public function deleteProduct($id) {
		$message = 'Error deleting the Product or related image(s)';
		if ($id) {
			$done = $this->deleteProductImages($id);
			
			if ($done) {
				Product::destroy($id);
				$message = 'The Product is deleted successfully';
			}
		}
		
		return redirect()->route('admin.products')->with('message', $message);
	}
}
