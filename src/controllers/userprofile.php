<?php
	// render template home
	require APPSRC.'/render.php';
	require APPSRC.'/db.php';

	$db = connectMysql($dsn, $dbuser, $dbpass);

	//var_dump($_SESSION['user']);
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$settings = fetchUserSettingsWithUserId($db, $user->id);

		echo render('userprofile',[
			'user'=>$user,
			'usersettings' => $settings
		],getLanguage($settings));
	} else {
		header('location:?url=home');
	}
	
?>