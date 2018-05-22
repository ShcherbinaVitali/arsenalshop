<?php

namespace App\Helpers;

use App\Category;
use App\Page;
use App\Product;

class AppHelper {
	
	const IS_ACTIVE_TITLE = 'is_active';
	const IS_ACTIVE_VALUE = 1;
	
	/**
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public static function getPages() {
		$pages = Page::all();
		
		$activePages = $pages->whereStrict(
			self::IS_ACTIVE_TITLE,
			self::IS_ACTIVE_VALUE
		);
		
		return $activePages;
	}
	
	public static function getCategoriesWithProducts() {
		$activeCategories = Category::where([
			[self::IS_ACTIVE_TITLE, self::IS_ACTIVE_VALUE],
			['parent_id', '=', 0]
		])->get();
		
		/*$products       = Product::all();
		$activeProducts = $products->whereStrict(
			self::IS_ACTIVE_TITLE,
			self::IS_ACTIVE_VALUE
		);*/
		
		$categoriesWithProducts = $activeCategories;
		
		return $categoriesWithProducts;
	}
}