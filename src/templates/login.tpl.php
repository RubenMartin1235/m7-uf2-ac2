<?php
	include APPSRC.'/templates/partials/head.tpl.php';
?>

	<body>
		<header>
			<h1><?= $login_title ?></h1>
		</header>
		<hr>
		<?php include APPSRC.'/templates/partials/nav.tpl.php'; ?>
		<div id="breadcrumbs">
			<ul>
				<li><a href="?url=home"><?= $home_title ?></a></li>
				<li><a href="?url=login"><?= $login_title ?></a></li>
			</ul>
		</div>
		<main>
			<form method="POST" action="?url=loginaction">
				<label for="email"><?= $login_label_email; ?></label>
				<input id="email" name="email" type="email" placeholder="<?= $login_label_email_placeholder; ?>">
				<label for="passwd"><?= $login_label_passwd; ?></label>
				<input id="passwd" name="passwd" type="password" placeholder="<?= $login_label_passwd_placeholder; ?>">
				<button type="submit"><?= $login_loginbtn_label; ?></button>
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