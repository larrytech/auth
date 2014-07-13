<?php namespace Larrytech\Auth\Controllers;

use Controller;

class BaseController extends Controller {

	public function __construct()
	{
		$this->beforeFilter('csrf', ['on' => 'post']);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}