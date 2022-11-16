<nav>
	<?php
		if (isset($_SESSION['user'])) {
			include APPSRC.'/templates/partials/nav-user.tpl.php';
		} else {
			include APPSRC.'/templates/partials/nav-guest.tpl.php';
		}
	?>
</nav>