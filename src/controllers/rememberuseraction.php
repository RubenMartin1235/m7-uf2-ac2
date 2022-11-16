<?php
	require APPSRC . '/db.php';

	function deleteRememberedUserCookies() {
		unset($_COOKIE['rememberuser_email']);
		unset($_COOKIE['rememberuser_passwd']);
		setcookie('rememberuser_email', null, -1, '/');
		setcookie('rememberuser_passwd', null, -1, '/');
	}

	$rememberMeAction = filter_input(INPUT_POST, 'rememberMeAction', FILTER_SANITIZE_STRING);

	if (isset($rememberMeAction)) {
		$rememberMe = boolval($rememberMeAction);
		if ($rememberMe) {
			$db = connectMysql($dsn, $dbuser, $dbpass);

			$email = $_COOKIE['rememberuser_email'];
			$passwd = $_COOKIE['rememberuser_passwd'];

			if ( ($user = authHashed($db,$email,$passwd)) <> new stdClass() ) {
				// desar sessió
				$_SESSION['user'] = $user;
				
				setcookie('rememberuser_email', $user->email, time()+(3600*24*365), '/');
				setcookie('rememberuser_passwd', $user->passwd, time()+(3600*24*365), '/');

				updateUserLastLoginWithUserId($db, $user->id, date("Y-m-d H:i:s"));
				
				// redirigir a dashboard
				header('location:?url=dashboard');
			} else {
				deleteRememberedUserCookies();
				header('location:?url=login');
			}
		} else {
			deleteRememberedUserCookies();
			header('location:?url=login');
		}
	} else {
		header('location:?url=login');
	}
?>