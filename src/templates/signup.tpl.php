<?php
	include APPSRC.'/templates/partials/head.tpl.php';
?>

	<body>
		<header>
			<h1><?= $signup_title; ?></h1>
		</header>
		<hr>
		<?php include APPSRC.'/templates/partials/nav.tpl.php'; ?>
		<div id="breadcrumbs">
			<ul>
				<li><a href="?url=home"><?= $home_title; ?></a></li>
				<li><a href="?url=signup"><?= $signup_title; ?></a></li>
			</ul>
		</div>
		<main>
			<form method="POST" action="?url=signupaction">
				<label for="fullname"><?= $signup_label_fullname; ?>:</label>
				<input id="fullname" name="fullname" type="text" placeholder="<?= $signup_label_fullname; ?>">
				<br>
				<label for="email"><?= $signup_label_email; ?>:</label>
				<input id="email" name="email" type="email" placeholder="<?= $signup_label_email; ?>">
				<br>
				<label for="passwd"><?= $signup_label_passwd; ?>:</label>
				<input id="passwd" name="passwd" type="password" placeholder="<?= $signup_label_passwd; ?>">
				<br>
				<label for="passwdConfirm"><?= $signup_label_passwdconfirm; ?>:</label>
				<input id="passwdConfirm" name="passwdConfirm" type="password" placeholder="<?= $signup_label_passwdconfirm; ?>">
				<br>
				<label for="isProf"><?= $signup_label_isprof; ?></label>
				<input id="isProf" name="isProf" type="checkbox">
				<br>
				<button type="submit"><?= $signup_signupbtn_label; ?></button>
				<br>
				<?php
					if ($cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING) == 'true') {
						include APPSRC.'/templates/partials/field-rememberuser.tpl.php';
					}
				?>
			</form>
		</main>
		<footer>
			
		</footer>
	</body>
</html>