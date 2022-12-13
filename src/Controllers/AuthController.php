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

	// Redirigeix al dashboard de l'usuari o a auth un altre cop.
	private function auth(string $email, string $passwd) {
		$passH = password_hash($passwd, PASSWORD_BCRYPT, ['cost'=>9]);
		
		$result = $this->qb->
			select(['email','passwd'])->
			from('users')->
			where(['email' => $email])->
			and_cond()->
			limit(1)->
			exec()
		;
		if ($result) {
			$this->redirect('/dashboard');
		} else {
			$this->redirect('/auth');
		}
	}
}