<?php

namespace App\Helpers;

use App\Category;
use App\Page;
use App\Product;

use Illuminate\Support\Facades\Auth;

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
	
	/**
	 * @return mixed
	 */
	public static function getCategoriesWithProducts() {
		$categoriesWithProducts = Category::where([
			[self::IS_ACTIVE_TITLE, self::IS_ACTIVE_VALUE],
			['parent_id', '=', 0]
		])->get();
		
		return $categoriesWithProducts;
	}
	
	public static function getProducts() {
		$products = Product::all()->where(
			self::IS_ACTIVE_TITLE,
			self::IS_ACTIVE_VALUE
		);
		
		return $products;
	}
	
	public static function getCategories() {
		$categories = Category::all()->where(
			self::IS_ACTIVE_TITLE,
			self::IS_ACTIVE_VALUE
		);
		
		return $categories;
	}
	
	public static function getRootCategories() {
		$categories = Category::where([
			[self::IS_ACTIVE_TITLE, '=', self::IS_ACTIVE_VALUE],
			['parent_id', '=', 0]
		])->get();
		
		return $categories;
	}
	
	public static function getCurrentAdmin() {
		return Auth::user();
	}
}