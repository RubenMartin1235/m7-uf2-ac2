<?php
	include APPSRC.'/templates/partials/head.tpl.php';
?>

	<body>
		<header>
			<h1><?= $userprofile_title; ?></h1>
			<?php include APPSRC.'/templates/partials/user-profile-display.tpl.php'; ?>
		</header>
		<hr>
		<?php include APPSRC.'/templates/partials/nav.tpl.php'; ?>
		<div id="breadcrumbs">
			<ul>
				<li><a href="?url=home"><?= $home_title; ?></a></li>
				<li><a href="?url=dashboard"><?= $dashboard_title; ?></a></li>
				<li><a href="?url=userprofile"><?= $userprofile_title; ?></a></li>
			</ul>
		</div>
		<main>
			<div id="profile-settings-display-container">
				<table class="profile-display-table">
					<tr><th colspan='2'><?= $userprofile_profiledata_title; ?></th></tr>
					<tr>
						<td><?= $userprofile_profiledata_label_fullname; ?></td>
						<td><?= $user->fullname;?></td>
					</tr>
					<tr>
						<td><?= $userprofile_profiledata_label_email; ?></td>
						<td><?= $user->email;?></td>
					</tr>
					<tr>
						<td><?= $userprofile_profiledata_label_isprof; ?></td>
						<td><?= boolval($user->isProf)? $common_label_yes : $common_label_no;?></td>
					</tr>
					<tr>
						<td><?= $userprofile_profiledata_label_lastlogin; ?></td>
						<td><?= $usersettings->lastLogin;?></td>
					</tr>
				</table>
				<table class="profile-display-table">
					<tr><th colspan='2'><?= $userprofile_preferences_title; ?></th></tr>
					<tr>
						<td><?= $guestsettings_label_language; ?></td>
						<td><?= $langlabels['common_langname_'.$usersettings->language]; ?></td>
					</tr>
					<tr>
						<td><?= $guestsettings_label_colortheme; ?></td>
						<td><?= $langlabels['common_colorthemename_'.$usersettings->colorTheme]; ?></td>
					</tr>
				</table>
			</div>
			<button id="modify-user-settings-btn">
				<a href="?url=usersettings">
					<?= $userprofile_modifyprefs_btnlabel; ?>
				</a>
			</button>
		</main>
		<footer>
			
		</footer>
	</body>
</html>