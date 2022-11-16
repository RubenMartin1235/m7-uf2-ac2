<?php
	// render template home
	require APPSRC.'/render.php';

	$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);
	//var_dump($_SESSION['user']);
	if (!isset($_SESSION['user']) && (isset($cookie_consent) && ($cookie_consent == 'true'))) {

		if (!(isset($_COOKIE['guest_colorTheme']) && isset($_COOKIE['guest_language']))) {
			setcookie('guest_colorTheme', "light_default", time()+(3600*24*365), '/');
			setcookie('guest_language', "en", time()+(3600*24*365), '/');
		}
		
		$lang = filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING);

		//var_dump(filter_input(INPUT_COOKIE, 'guest_colorTheme', FILTER_SANITIZE_STRING));
		echo render('guestsettings',[
			'colorTheme' => filter_input(INPUT_COOKIE, 'guest_colorTheme', FILTER_SANITIZE_STRING),
			'language' => filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING)
		], $lang);
	} else {
		header('location:?url=home');
	}
	
?>