<?php
namespace App;

use App\Container;
use App\Controller;
use App\Request;
use App\Session;

abstract class Controller {
	protected Request $request;
	protected Session $session;

	function __construct(Request $request, Session $session) {
		$this->request = $request;
		$this->session = $session;
	}

	public function index() {
		$users = Container::get('database')->selectAll('USERS');

		return view('home', compact('USERS'));
	}
}