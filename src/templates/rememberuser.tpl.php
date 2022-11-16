<?php
	include APPSRC.'/templates/partials/head.tpl.php';
?>

	<body>
		<header>
			<h1><?=$rememberuser_title;?></h1>
		</header>
		<hr>
		<?php include APPSRC.'/templates/partials/nav.tpl.php'; ?>
		<div id="breadcrumbs">
			<ul>
				<li><a href="?url=home"><?=$home_title;?></a></li>
				<li><a href="?url=rememberuser"><?=$rememberuser_title;?></a></li>
			</ul>
		</div>
		<main>
			<form method="POST" action="?url=rememberuseraction">
				<p><?= $rememberuser_label_querytoremember; ?><b><?= $fullname; ?></b>?</p>
				<p><?= $rememberuser_label_lastlogin; ?><b>
					<?= (isset($lastLogin)) ? $lastLogin : "(not available)"; ?>
				</b></p>
				<button type="submit" name="rememberMeAction" value="1" class="rememberMeBtn">
					<?= $common_label_yes; ?>
				</button>
				<button type="submit" name="rememberMeAction" value="0" class="rememberMeBtn">
					<?= $common_label_no; ?>
				</button>
			</form>
		</main>
		<footer>
			
		</footer>
	</body>
</html>
