<?php

namespace App\Controllers;

use App\Container;
use App\Controller;
use App\Request;
use App\Session;

final class AuthController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}

	public function index() {
		// renderitzar vista
		return view('auth', ['title' => 'Log in']);
	}
	public function signin() {
		$email = $this->request->post('email');
		$passwd = $this->request->post('passwd');

		try {
			$users = Container::get('database')->selectAll('USERS');
		} catch (\Exception $ex) {

		}
		

		var_dump($users);
	}
}