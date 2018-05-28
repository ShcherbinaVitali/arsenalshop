<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller {
	
	public function category(Request $request) {
		$category = $request->category;
		Session::put('category.active', $category);
		$counter  = 1;
		$max      = 5;
		for ($counter; $counter < $max; $counter++) {
			$q = 'category' . $counter;
			$temp = $request->$q;
			if (isset($temp)) {
				$category = $temp;
			}
		}
		$products = Product::all();
		
		foreach ($products as $product) {
			if ($category === $product->alias) {
				return view(
					'pages.product',
					[
						'content' => $product
					]
				);
			}
		}
		
		$categoryModel = Category::where('alias', '=', $category)->first();
		
		return view(
			'pages.category', ['content' => $categoryModel]
		);
	}
	
	public function categoryList() {
		$categories = AppHelper::getCategoriesWithProducts();
		
		return view('pages.category-list', ['categories' => $categories]);
	}
}
