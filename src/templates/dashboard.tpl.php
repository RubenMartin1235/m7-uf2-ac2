<?php
	include APPSRC.'/templates/partials/head.tpl.php';
?>

	<body>
		<header>
			<h1><?= $dashboard_title; ?></h1>
			<?php include APPSRC.'/templates/partials/user-profile-display.tpl.php'; ?>
		</header>
		<hr>
		<?php include APPSRC.'/templates/partials/nav.tpl.php'; ?>
		<div id="breadcrumbs">
			<ul>
				<li><a href="?url=home"><?= $home_title; ?></a></li>
				<li><a href="?url=dashboard"><?= $dashboard_title; ?></a></li>
			</ul>
		</div>
		<main>
			<h2><?=	$dashboard_label_1 . ', ' . $user->fullname;?>!</h2>
			<table id="dashboard-users-table">
				<tr><th>
				<?=($user->isProf == 1) ? $dashboard_heading_all_teachers : $dashboard_heading_all_students;?>
				</th></tr>
				<?php
					foreach ($dashboard_userlist as $row) {
						print "<tr><td>".$row->fullname."</td></tr>";
					}
				?>
			</table>
		</main>
		<footer>
			
		</footer>
	</body>
</html>