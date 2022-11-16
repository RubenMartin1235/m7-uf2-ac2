<?php
	require APPSRC . '/db.php';

	// Tenim possibilitats:
	// *	1. No existeix usuari i és vàlid:
	//		Inserim usuari en taula users, obrim sessió usuari,
	//		i redirigim a dashboard. 
	// *	2. Ja existeix ==>	ens quedem a signup.
	// *	3. No és vàlid ==>	ens quedem a signup.

	if (
		!empty($_POST['fullname']) &&
		!empty($_POST['email']) &&
		!empty($_POST['passwd']) && !empty($_POST['passwdConfirm'])
	) {
		if (
			isset($_POST['fullname']) &&
			isset($_POST['email']) &&
			isset($_POST['passwd']) && isset($_POST['passwdConfirm'])
		) {
			$db = connectMysql($dsn, $dbuser, $dbpass);
			/*
			$fullname = $_REQUEST['fullname'];
			$email = $_REQUEST['email'];
			$passwd = $_REQUEST['passwd'];
			$passwdConfirm = $_REQUEST['passwdConfirm'];
			$isProf = $_REQUEST['isProf'];
			*/
			$fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$passwd = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);
			$passwdConfirm = filter_input(INPUT_POST, 'passwdConfirm', FILTER_SANITIZE_STRING);
			$isProf = filter_input(INPUT_POST, 'isProf', FILTER_SANITIZE_STRING);
			if (!isset($isProf)) {$isProf = false;}
			
			if (
				(
					$user = signupUser($db,
						$fullname,$email,
						$passwd,$passwdConfirm,
						$isProf
					)
				) <> new stdClass()
			) {
				// crear registre de configuració
				$settings = createNewUserSettingsEntry($db, $email);
				
				$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);
				
				if ((isset($cookie_consent)) && ($cookie_consent == 'true')) {
					$rememberMe = $_REQUEST['rememberMe'];
					if (isset($rememberMe) && ($rememberMe == 'true' || $rememberMe == 'on')) {
						setcookie('rememberuser_email', $user->email, time()+(3600*24*365), '/');
						setcookie('rememberuser_passwd', $user->passwd, time()+(3600*24*365), '/');
					}
					$guest_language = filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING);
					$guest_colorTheme = filter_input(INPUT_COOKIE, 'guest_colorTheme', FILTER_SANITIZE_STRING);
					if (isset($guest_colorTheme) && isset($guest_language)) {
						updateUserSettingsWithUserId($db,
							$user->id, $settings->lastLogin, $settings->lastLogout,
							$guest_language, $guest_colorTheme
						);
					}
				}
				// desar sessió
				$_SESSION['user'] = $user;
				
				// redirigir a dashboard
				header('location:?url=dashboard');
			} else {
				header('location:?url=signup');
			}
		} else {
			header('location:?url=signup');
		}
	} else {
		header('location:?url=signup');
	}
	
?>