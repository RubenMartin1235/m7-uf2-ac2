<?php
	// render template home
	require APPSRC.'/render.php';
	require APPSRC.'/db.php';

	$db = connectMysql($dsn, $dbuser, $dbpass);

	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$settings = fetchUserSettingsWithUserId($db, $user->id);

		// If user is a student, get all student names.
		// If user is a teacher, get all teacher names.
		$stmt = $db->prepare(
			"SELECT fullname from users WHERE isProf = :isProf
			ORDER BY fullname ASC"
		);
		$stmt->execute([':isProf'=>$user->isProf]);
		$userlist = $stmt->fetchAll();
		

		echo render('dashboard',[
			'user'=>$user,
			'usersettings'=>$settings,
			'dashboard_userlist'=>$userlist
		], getLanguage($settings));
	} else {
		header('location:?url=home');
	}
	
?>