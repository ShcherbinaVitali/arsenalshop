<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller {
	
	const DEFAULT_AUTH_ERROR = 'Wrong Email or Password!';
	/**
	 * AuthController constructor.
	 */
	public function __construct() {
		$this->middleware('guest:admin')->except(['logout']);
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showLoginForm() {
		return view('pages.panel.admin-login');
	}
	
	/**
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function login(Request $request) {
		$validator = Validator::make(
			$request->all(),
			[
				'email'    => 'required|min:3',
				'password' => 'required|min:6'
			],
			[
				'email.required'    => 'The :attribute field is required.',
				'password.required' => 'The :attribute field is required.',
				'email.min'         => 'The :attribute should be longer than 2 characters.',
				'password.min'      => 'The :attribute should be longer than 5 characters.'
			]
		);
		
		$signingInSuccessful = Auth::guard('admin')
			->attempt(
				[
					'email'    => $request->email,
					'password' => $request->password
				], 
				$request->remember
			);
		
		if ( $signingInSuccessful ) {
			return redirect()->intended(route('admin.dashboard'));
		}
		
		if ( !$validator->errors()->any() ) {
			$validator->errors()->add('auth_error', self::DEFAULT_AUTH_ERROR);
		}
		
		return redirect()
			->back()
			->withErrors($validator)
			->withInput( $request->only('email', 'remember') );
	}
	
	public function logout(Request $request) {
		Auth::guard('admin')->logout();
		return redirect()->route('admin.login.form');
	}
}
