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

		$this->auth($email, $passwd);
		var_dump($users);
	}

	// Redirigeix al dashboard de l'usuari o a auth un altre cop.
	private function auth(string $email, string $passwd) {

		$user = $this->qb->
			select(['email','passwd'])->
			from('USERS')->
			where("email = '$email'")->
			limit(1)->
			exec()->
			fetch()[0]
		;

		//$passH = password_hash($passwd, PASSWORD_BCRYPT, ['cost'=>9]);
		$passVerified = password_verify($passwd, $user->passwd);

		if ($user && $passVerified) {
			$this->session->set('email',$email);
			$this->redirect('/dashboard');
		} else {
			$this->session->set('error',"Session failed");
			$this->redirect('/auth');
		}
	}
}