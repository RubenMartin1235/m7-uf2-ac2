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
		$newUser;

		$username = $this->request->post('username');
		$email = $this->request->post('email');
		$passwd = $this->request->post('passwd');
		$passwdConfirm = $this->request->post('passwd-confirm');
		$userRole = intval($this->request->post('user-role'));

		$alreadyExists = $this->auth($email, $passwd);

		if (!$alreadyExists) {
			if ($passwd == $passwdConfirm) {
				$newUser = $this->signupAction($username, $email, $passwd, $userRole);
				var_dump($newUser);
			}
			if ($newUser) {
				$this->session->set('email',$email);
				$this->session->set('passwd',$passwd);
				$this->redirect('/dashboard');
			}
			/*
			var_dump($username);
			var_dump($email);
			var_dump($passwd);
			var_dump($passwdConfirm);
			var_dump($userRole);
			*/
		}
		//var_dump($users);
	}
	private function auth(string $email, string $passwd) {
		$user = $this->getUser($email, $passwd);
		if ($user) {
			// If user already exists, redirect back to the signup page.
			$this->redirect('/signup');
			return true;
		}
		return false;
	}
	private function signupAction($username, $email, $passwd, $userRole) {
		$passH = password_hash($passwd, PASSWORD_BCRYPT, ['cost'=>9]);
		try {
			$this->qb->clearQuery();
			$userIdObj = ($this->qb->selectCount()->from('USERS')->exec()->fetch()[0]);
			$userId = array_values(get_object_vars($userIdObj))[0] + 1;
			$this->qb->clearQuery();
			var_dump($this->qb->insert('USERS', [[$userId,$username,$email,$passH,$userRole]]));
			$this->qb->exec();
			$this->qb->clearQuery();
			return $this->getUser($email, $passwd);
		} catch (\Exception $ex) {
			die($ex);
		}// I give up.
	}
}