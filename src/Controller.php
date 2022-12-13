<?php
namespace App;

use App\Container;
use App\Controller;
use App\Database\QueryBuilder;
use App\Request;
use App\Session;

abstract class Controller {
	protected Request $request;
	protected Session $session;
	protected DB $qb;

	function __construct(Request $request, Session $session) {
		$this->request = $request;
		$this->session = $session;
		$this->qb = Container::get('query');
	}

	public function index() {
		$users = Container::get('database')->selectAll('USERS');

		return view('home', compact('USERS'));
	}

	public function redirect(string $url) {
		header('Location:' . $url);
	}
}