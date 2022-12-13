<?php

namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class SignupController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}

	public function index() {
		// renderitzar vista
		return view('signup', ['title' => 'Sign up']);
	}
	public function signup() {
		$email = $this->request->post('email');
	}
}