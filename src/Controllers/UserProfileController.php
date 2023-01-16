<?php
namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class UserProfileController extends Controller {
	function __construct(Request $request, Session $session) {
		parent::__construct($request, $session);
	}
	
	public function index() {
		// obtenir dades
		$data = [];

		$email = $this->session->get('email');
		$passwd = $this->session->get('passwd');
		$user = $this->getUser($email, $passwd);
		if ($user) {
			$username = $user->username;
			$data['username'] = $username;
			$data['email'] = $email;
		}

		$title = "User Profile";
		$data['title'] = $title;

		// renderitzar vista
		return view('dashboard', $data);
	}
}
?>