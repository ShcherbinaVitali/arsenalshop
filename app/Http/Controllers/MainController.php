<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\AppHelper;
use App\Page;
use Illuminate\Support\Facades\Session;

class MainController extends Controller {
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function home() {
		$content = Page::where('alias', '=', 'home')->get()->first();
		
		if ( !$content ) {
			return view("pages.home");
		}
		else {
			return view("pages.home", ['content' => $content]);
		}
	}
	
	public function page(Request $request) {
		$page    = $request->page;
		$content = Page::where('alias', '=', $page)->first();
		
		if (!$content) {
			return redirect()->route('static.page-list')->with('message', 'Такой страницы не найдено');
		}
		
		return view("pages.static-page", ['content' => $content]);
	}
	
	public function pageList() {
		$pages = AppHelper::getPages();
		
		return view("pages.page-list", ['pages' => $pages]);
	}
	
	public function search(Request $request) {
		$message = 'Пустой запрос';
		$query   = strip_tags($request->get('query'));
		if ( $query ) {
			$products = Product::all();
			
			$productResult = $products->filter(function ($product) use ($query) {
				return mb_strpos(strtolower($product->title), strtolower($query)) !== false
					|| mb_strpos(strtolower($product->description), strtolower($query)) !== false
					;
			});
			
			if ( $productResult && count($productResult) > 0 ) {
				return view(
					"pages.search",
					[
						'query'          => $query,
						'product_result' => $productResult
					]
				);
			}
			
			return view("pages.search", ['query' => $query]);
		}
		
		return redirect()->route('home')->with('p_message', $message);
	}
	
	public function setViewProducts(Request $request) {
		$viewType = $request->view_products;
		
		if ($viewType) {
			switch ($viewType) {
				case 'list':
					Session::put('product-list', true);
				break;
				default:
					$sessData = Session::get('product-list');
					if (isset($sessData)) {
						Session::forget('product-list');
					}
				break;
			}
		}
		
		return redirect()->back();
	}
	
	public function setProductOnPage(Request $request) {
		$count = $request->count;
		if ($count) {
			AppHelper::setPagesCountOnPage($count);
		}
		
		return redirect()->back();
	}
}
