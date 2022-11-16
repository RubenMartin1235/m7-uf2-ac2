<?php
	include APPSRC.'/templates/partials/head.tpl.php';
?>

	<body>
		<header>
			<h1><?= $usermodprefs_title; ?></h1>
			<?php include APPSRC.'/templates/partials/user-profile-display.tpl.php'; ?>
		</header>
		<hr>
		<?php include APPSRC.'/templates/partials/nav.tpl.php'; ?>
		<div id="breadcrumbs">
			<ul>
				<li><a href="?url=home"><?= $home_title; ?></a></li>
				<li><a href="?url=dashboard"><?= $dashboard_title; ?></a></li>
				<li><a href="?url=userprofile"><?= $userprofile_title; ?></a></li>
				<li><a href="?url=usersettings"><?= $usermodprefs_title; ?></a></li>
			</ul>
		</div>
		<main>
			<form action="?url=usersettingsaction" method="post">
				<div id="profile-settings-display-container">
					<table class="profile-display-table">
						<tr>
							<th colspan='2'><?= $guestsettings_title; ?></th>
						</tr>
						<tr>
							<td><?= $guestsettings_label_language; ?></td>
							<td>
								<select id="language-field" name="language">
									<option value="en">English</option>
									<option value="es">Español</option>
									<option value="ca">Català</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><?= $guestsettings_label_colortheme; ?></td>
							<td>
								<select id="color-theme-field" name="colorTheme">
								<option value="light_default">
										<?= $common_colorthemename_light_default; ?>
									</option>
									<option value="dark_default">
										<?= $common_colorthemename_dark_default; ?>
									</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<button id="modify-user-settings-btn" type="submit">
					<?= $guestsettings_applychanges; ?>
				</button>
			</form>
		</main>
		<footer>
			
		</footer>
	</body>
	<script type="text/javascript">
		let languageSelect = document.querySelector("select#language-field");
		let colorThemeSelect = document.querySelector("select#color-theme-field");
		let defaultLanguageOption = document.querySelector("select#language-field option[value='<?= $usersettings->language; ?>']");
		let defaultColorThemeOption = document.querySelector("select#color-theme-field option[value='<?= $usersettings->colorTheme; ?>']");
		
		defaultLanguageOption.selected = "selected";
		defaultColorThemeOption.selected = "selected";
	</script>
</html>