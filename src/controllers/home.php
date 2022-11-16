<?php
	// render template home
	require APPSRC.'/render.php';
	require APPSRC.'/db.php';

	$db = connectMysql($dsn, $dbuser, $dbpass);

	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$settings = fetchUserSettingsWithUserId($db, $user->id);

		echo render('home',[
			'user'=>$user,
			'usersettings'=>$settings
		], getLanguage($settings));
	} else {
		$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);
		if ((isset($cookie_consent) && ($cookie_consent == 'true'))) {
			$lang = filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING);
			echo render('home', [], getLanguage($lang));
		} else {
			echo render('home');
		}
	}
	
?>