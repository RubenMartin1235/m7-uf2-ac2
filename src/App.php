<?php

namespace App;

use App\Request;
use App\Session;

final class App{
	protected Request $request;
	protected Session $session;

	function __construct(){
		// iniciar sessió.
		$this->session = new Session();
		// obtenir controlador a partir del REQUEST.
		$this->request = new Request();
		$controller = $this->request->getController();
		$action = $this->request->getAction();

		$this->dispatch($controller);
	}

	public function dispatch($controller) {
		// comprovar si tenim el controlador.
		try {
			$controllerName = '\\App\\Controllers\\'.ucfirst($controller).'Controller';
			$controllerObj = new $controllerName($this->request, $this->session);
			$controllerAction = $this->request->getAction();

			if (method_exists($controllerObj, $controllerAction)) {
				call_user_func([$controllerObj, $controllerAction]);
			} else {
				call_user_func([$controllerObj, 'error']);
			}
		} catch (\Exception $ex) {
			die($e->getMessage());
		}
	}
}
?>