<?php
	ini_set('display_errors',1);
	
	// definir directori aplicació
	define("APP",__DIR__);
	define("APPSRC",APP.'/src');

	// carregar autoload
	require APP.'/vendor/autoload.php';
	// carregar front controller
	require APP.'/bootstrap.php';
	
	use App\App;

	$uri = $_SERVER['REQUEST_URI'];
	// iniciar sessió
	session_start();
	
	

	// carregar configuració bd
	$config = require APP.'/config.php';

	// carregar gestor de rutes
	require APPSRC.'/router.php';

	// enrutament
	$route_controller = getRoute($routes);

	require APPSRC."/controllers/" . $route_controller . '.php';

	
	
	
	// crida al controlador
	App::start();

?>
