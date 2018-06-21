<?php

namespace App\Http\Controllers;

use App\Info;
use App\Mail\OrderCall;
use App\Mail\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Helpers\AppHelper;
use App\Page;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
	
	public function sendRequest(Request $request) {
		$redirectFailedCaptcha = redirect()
			->route('home')
			->with('p_message', 'Капча не пройдена');
		
		$name  = strip_tags($request->name);
		$phone = strip_tags($request->phone);
		$topic = strip_tags($request->topic);
		$recaptchaResponse = $request->get('g-recaptcha-response');
		
		$validator = Validator::make($request->all(), [
			'name'  => 'required|alpha|max:150',
			'phone' => [
				'required',
				'regex:/[d+ -]/'
			],
			'topic' => 'max:350'
		]);
		
		if ( $validator->fails() ) {
			return redirect()
				->route('home')
				->with('p_message', 'Имя или телефон указаны некорректно');
		}
		
		if ( empty($recaptchaResponse) ) {
			return $redirectFailedCaptcha;
		}
		else {
			$goggleResponse = AppHelper::checkCaptcha($recaptchaResponse);
			
			if ( !$goggleResponse || !$goggleResponse['success']) {
				return $redirectFailedCaptcha;
			}
		}
		
		$ownerEmail = Info::where('title', '=', 'owner_email')
			->get()
			->first()
			->content
		;
		
		Mail::to($ownerEmail)
			->send(new OrderCall($name, $phone, $topic));
		return redirect()->back()->with('p_message', 'Запрос звонка успешно заказан');
	}
	
	public function orderProduct(Request $request) {
		$redirectFailedCaptcha = redirect()
			->route('home')
			->with('p_message', 'Капча не пройдена');
		
		$name    = strip_tags($request->name);
		$phone   = strip_tags($request->phone);
		$count   = strip_tags($request->count);
		$prod_id = strip_tags($request->product_id);
		$recaptchaResponse = $request->get('g-recaptcha-response');
		
		$validator = Validator::make($request->all(), [
			'name'  => 'required|alpha|max:150',
			'phone' => [
				'required',
				'regex:/[d+ -]/'
			],
			'count' => 'required|numeric'
		]);
		
		if ( $validator->fails() ) {
			return redirect()
				->route('home')
				->with('p_message', 'Имя или телефон указаны некорректно');
		}
		
		if ( empty($recaptchaResponse) ) {
			return $redirectFailedCaptcha;
		}
		else {
			$goggleResponse = AppHelper::checkCaptcha($recaptchaResponse);
			
			if ( !$goggleResponse || !$goggleResponse['success']) {
				return $redirectFailedCaptcha;
			}
		}
		
		$ownerEmail = Info::where('title', '=', 'owner_email')
			->get()
			->first()
			->content
		;
		
		$product = Product::findOrFail($prod_id);
		
		Mail::to($ownerEmail)
			->send(new OrderProduct($name, $phone, $product, $count));
		return redirect()->back()->with('p_message', 'Запрос заказа успешно оформлен');
	}
}
