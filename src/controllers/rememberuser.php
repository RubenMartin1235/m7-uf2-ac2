<?php
	// render template home
	require APPSRC.'/render.php';

	require APPSRC.'/db.php';
	$db = connectMysql($dsn, $dbuser, $dbpass);

	$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);
	
	if (isset($cookie_consent) && ($cookie_consent == 'true')) {
		$email = filter_input(INPUT_COOKIE, 'rememberuser_email', FILTER_SANITIZE_STRING);

		$user = findUserByEmail($db, $email);
		
		if ($user <> new stdClass()) {
			$userid = $user->id;
			$user_settings = fetchUserSettingsWithUserId($db, $userid);
			$lastLogin;

			$fullname = $user->fullname;
			if ($user_settings <> new stdClass()) {
				$lastLogin = $user_settings->lastLogin;
			} else {
				$lastLogin = "(not available)";
			}

			$lang = filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING);
			if (!isset($lang)) {
				$lang = 'en';
			}
			echo render('rememberuser',[
				'fullname' => $fullname,
				'lastLogin' => $lastLogin
			], $lang);
			
		} else {
			header('location:?url=home');
		}
	} else {
		header('location:?url=home');
	}
?>