<?php namespace Larrytech\Auth\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class AuthController extends BaseController {

	public function login()
	{
		$title = Lang::get('auth::login.title');

		if (Request::isMethod('POST'))
		{
			if (Auth::attempt([
					'email' => Input::get('email'),
					'password' => Input::get('password'),
					'active' => 1,
					'suspended' => 0], Input::has('remember')))
			{
				return Redirect::intended(Config::get('auth::view.redirect'));
			}

			return Redirect::back()->with('attempt', false)->withInput();
		}

		return View::make(Config::get('auth::view.login'), compact('title'));
	}

	public function logout()
	{
		Auth::logout();

		return Redirect::to('/');
	}
}
