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
			$lang = filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING);
			if (!isset($lang)) {
				$lang = 'en';
			}
			echo render('signup', [], $lang);
		} else {
			echo render('signup');
		}
	} else {
		echo render('dashboard');
	}
	
?>