<?php
$href;
if (isset($_SESSION['user']) && isset($usersettings)) {
	$href = $usersettings->colorTheme;
} else {
	$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);
	if ((isset($cookie_consent) && ($cookie_consent == 'true'))) {
		$href = filter_input(INPUT_COOKIE, 'guest_colorTheme', FILTER_SANITIZE_STRING);
	} else {
		$href = 'light_default';
	}
}
?>
<link rel="stylesheet" href="public/css/<?php echo $href;?>.css">