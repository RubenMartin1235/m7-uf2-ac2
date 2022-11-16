<?php
	// render template home

	//var_dump($_SESSION['user']);
	$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);

	if (!isset($_SESSION['user']) && (isset($cookie_consent) && ($cookie_consent == 'true'))) {
		$language = filter_input(INPUT_POST, 'language', FILTER_SANITIZE_STRING);
		$colorTheme = filter_input(INPUT_POST, 'colorTheme', FILTER_SANITIZE_STRING);

		if (isset($language) && isset($colorTheme)) {
			setcookie('guest_language', $language, time()+(3600*24*365), '/');
			setcookie('guest_colorTheme', $colorTheme, time()+(3600*24*365), '/');
			header('location:?url=guestsettings');
		} else {
			header('location:?url=home');
		}
	} else {
		header('location:?url=home');
	}
	
?>