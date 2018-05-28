<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\AppHelper;
use App\Page;

class MainController extends Controller {
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function home() {
		return view("pages.home");
	}
	
	public function page(Request $request) {
		$page    = $request->page;
		$content = Page::where('alias', '=', $page)->first();
		
		return view("pages.static-page", ['content' => $content]);
	}
	
	public function pageList() {
		$pages = AppHelper::getPages();
		
		return view("pages.page-list", ['pages' => $pages]);
	}
}
