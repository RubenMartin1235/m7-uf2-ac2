<?php
	include APPSRC.'/templates/partials/head.tpl.php';
?>
	<body>
		<header>
			<h1><?= $home_title; ?></h1>
			<?php include APPSRC.'/templates/partials/user-profile-display.tpl.php'; ?>
		</header>
		<hr>
		<?php include APPSRC.'/templates/partials/nav.tpl.php'; ?>
		<div id="breadcrumbs">
			<ul>
				<li><a href="?url=home"><?= $home_title; ?></a></li>
			</ul>
		</div>
		<main>
			
		</main>
		<footer>
			
		</footer>
		<?php
			include APPSRC.'/templates/partials/cookie-consent-banner.tpl.php';
		?>
	</body>
</html>