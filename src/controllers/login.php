<?php
	// render template home
	require APPSRC.'/render.php';

	if (!isset($_SESSION['user'])) {
		// check if cookie consent is enabled
		$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);

		if (
			isset($cookie_consent) &&
			($cookie_consent || $cookie_consent == 'true')
		) {
			$email = filter_input(INPUT_COOKIE, 'rememberuser_email', FILTER_SANITIZE_STRING);
			$passwd = filter_input(INPUT_COOKIE, 'rememberuser_passwd', FILTER_SANITIZE_STRING);

			$lang = filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING);
			if (!isset($lang)) {
				$lang = 'en';
			}
			if (
				isset($email) && isset($passwd)
			) {
				header('location:?url=rememberuser');
			} else {
				echo render('login', [], getLanguage($lang));
			}
		} else {
			echo render('login');
		}
	} else {
		echo render('dashboard');
	}
?>