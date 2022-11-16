<?php
	require APPSRC . '/db.php';
	// Agafar $_REQUEST['email'] i $_REQUEST['passwd']

	// Comprovar si existeixen a la BD

	// Tenim dues possibilitats:
	// *	1. Existeix ==>		dashboard i obrim sessió usuari.
	// *	2. NO Existeix ==>	retornem a home o ens quedem a login.
	$db = connectMysql($dsn, $dbuser, $dbpass);

	if (!empty($_POST['email']) && !empty($_POST['passwd'])) {
		if (isset($_POST['email']) && isset($_POST['passwd'])) {
			$email = $_REQUEST['email'];
			$passwd = $_REQUEST['passwd'];
			
			if ( ($user = auth($db,$email,$passwd)) <> new stdClass() ) {
				// desar sessió
				$_SESSION['user'] = $user;

				if (($rememberMe = $_REQUEST['rememberMe'])) {
					setcookie('rememberuser_email', $user->email, time()+(3600*24*365), '/');
					setcookie('rememberuser_passwd', $user->passwd, time()+(3600*24*365), '/');
				}
				
				try {
					createNewUserSettingsEntry($db, $email);
				} catch (PDOException $ex) {}
				updateUserLastLoginWithUserId($db, $user->id, date("Y-m-d H:i:s"));
				
				// redirigir a dashboard
				header('location:?url=dashboard');
			} else {
				header('location:?url=login');
			}
		} else {
			header('location:?url=login');
		}
	} else {
		header('location:?url=login');
	}
	
?>