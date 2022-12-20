<?php
namespace App;

use App\Container;
use App\Controller;
use App\Database\DB;
use App\Request;
use App\Session;

abstract class Controller {
	protected Request $request;
	protected Session $session;
	protected DB $qb;

	function __construct(Request $request, Session $session) {
		$this->request = $request;
		$this->session = $session;
		$this->qb = Container::get('database');
	}

	public function index() {
		$users = Container::get('database')->selectAll('USERS');

		return view('home', compact('USERS'));
	}

	public function redirect(string $url) {
		header('Location:' . $url);
	}
	
	public function error() {
		echo "Error";
	}
}