<?php
	if (isset($_SESSION['user'])) {
		include APPSRC.'/templates/partials/user-profile-display-html.tpl.php';
	}
?>