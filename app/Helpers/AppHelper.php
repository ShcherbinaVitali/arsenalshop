<?php

namespace App\Helpers;

use App\Category;
use App\Info;
use App\Page;
use App\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class AppHelper {
	
	const IS_ACTIVE_TITLE = 'is_active';
	const IS_ACTIVE_VALUE = 1;
	
	const DEFAULT_PRODUCT_COUNT = 12;
	const PRODUCT_ON_PAGE_ARR   = [
		1,
		12,
		20,
		28
	];
	
	const DEFAULT_BESTSELLERS_COUNT = 4;
	
	/**
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public static function getPages() {
		$pages = Page::all();
		
		$activePages = $pages->where(
			self::IS_ACTIVE_TITLE,
			'=',
			self::IS_ACTIVE_VALUE
		)
		->where(
			'alias',
			'!=',
			'home'
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
	
	public static function setPagesCountOnPage($count) {
		Session::put('product-count', $count);
		
		return true;
	}
	
	public static function getFromInfoByTitle($title) {
		$infoModel = Info::where('title', '=', $title)->get()->first();
		
		return $infoModel;
	}
	
	public static function getParentCategory($category) {
		if ( $category->parentCategory ) {
			return $category->parentCategory;
		}
		
		return false;
	}
	
	public static function getFullUrlForItem($item) {
		$url = [];
		if ( $item instanceof Product ) {
			$url[]    = $item->alias;
			$category = $item->category;
		}
		elseif ($item instanceof Category) {
			$category = $item;
		}
		
		$url[] = $category->alias;
		
		$category = self::getParentCategory($category);
		if ( $category ) {
			$url[]    = $category->alias;
			
			while ($category->parentCategory) {
				$category = self::getParentCategory($category);
				$url[]    = $category->alias;
			}
		}
		$url = array_reverse($url);
		$url = implode('/', $url);
		
		if ( !$url ) {
			$url = '';
		}
		
		return $url;
	}
	
	public static function getBreadcrumbsByModel($model) {
		$breadcrumbs = [];
		if ( $model instanceof Product ) {
			$breadcrumbs[] = [
				'alias' => $model->alias,
				'title' => $model->title
			];
			
			$category = $model->category;
		}
		elseif ($model instanceof Category) {
			$category = $model;
		}
		
		$breadcrumbs[] = [
			'alias' => $category->alias,
			'title' => $category->title
		];
		
		$category = self::getParentCategory($category);
		if ( $category ) {
			$breadcrumbs[] = [
				'alias' => $category->alias,
				'title' => $category->title
			];
			
			while ($category->parentCategory) {
				$category = self::getParentCategory($category);
				$breadcrumbs[] = [
					'alias' => $category->alias,
					'title' => $category->title
				];
			}
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		
		if ( !$breadcrumbs ) {
			$breadcrumbs = '';
		}
		
		return $breadcrumbs;
	}
	
	public static function cutTextByChars($text, $chars = 200) {
		//$text = preg_replace('/\s+?(\S+)?$/', '', substr($text, 0, $chars));
		
		return $text;
	}
	
	public static function checkCaptcha($recaptchaResponse) {
		$url      = "https://www.google.com/recaptcha/api/siteverify";
		$config   = Config::get('additional.creds');
		$remoteIP = Request::server('REMOTE_ADDR');
		$secret   = $config['secret'];
		
		$postData = http_build_query([
			'secret'   => $secret,
			'response' => $recaptchaResponse,
			'remoteip' => $remoteIP
		]);
		
		$opts = [
			'http' => [
				'method'  => 'POST',
				'header'  => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $postData
			]
		];
		
		$gcontents = stream_context_create($opts);
		
		$response = file_get_contents($url, false, $gcontents);
		$result   = json_decode($response, true);
		
		if ( !$result ) {
			$result = false;
		}
		
		return $result;
	}
	
	public static function getCaptchaCreds() {
		$creds = Config::get('additional.creds');
		
		if ( $creds && is_array($creds) ) {
			return $creds;
		}
		
		return false;
	}
	
	public static function getBestSellerProducts() {
		$products = Product::all()
			->where(
				self::IS_ACTIVE_TITLE,
				'=',
				self::IS_ACTIVE_VALUE
			)
			->where(
				'bestseller',
				'=',
				'1'
			)
			->take(self::DEFAULT_BESTSELLERS_COUNT)
		;
		
		if ( !$products ) {
			$products = [];
		}
		
		return $products;
	} 
}