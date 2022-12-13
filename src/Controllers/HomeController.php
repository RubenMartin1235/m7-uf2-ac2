<?php
namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class HomeController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$title = "Home";
		// renderitzar vista
		return view('home', ['title' => $title]);
	}

	public function prueba() {
		echo "Prueba - HomeController";
	}

	public function error() {
		echo "Error";
	}
}
?>