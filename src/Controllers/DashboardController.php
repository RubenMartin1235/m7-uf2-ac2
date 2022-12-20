<?php
namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class DashboardController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$title = "Dashboard";
		// renderitzar vista
		return view('dashboard', ['title' => $title]);
	}
}
?>