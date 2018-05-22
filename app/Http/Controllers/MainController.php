<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller {
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function home() {
		return view("pages.home");
	}
}
