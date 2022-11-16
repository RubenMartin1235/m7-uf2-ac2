<?php
	/**
	 * renders template
	 *
	 * @param string $tpl
	 * @param array $data
	 * @return string
	 */
	function render(string $tpl, ?array $data = [], ?string $lang = 'en'):string {
		// extreure dades
		if ($data) {
			extract($data, EXTR_OVERWRITE);
		}
		if ($lang) {
			require APPSRC.'/lang/lang.'. $lang .'.php';
			extract($langlabels, EXTR_OVERWRITE);
		}

		ob_start();
		require APPSRC.'/templates/'.$tpl.'.tpl.php';
		$rendered = ob_get_clean();
		
		return (string)$rendered;
	}

	function getLanguage($settings) {
		if (isset($_SESSION['user'])) {
			if (isset($settings->language)) {
				return $settings->language;
			} else {
				return 'en';
			}
		} else {
			$cookie_consent = filter_input(INPUT_COOKIE, 'cookie-consent', FILTER_SANITIZE_STRING);
			if ((isset($cookie_consent) && ($cookie_consent == 'true'))) {
				return filter_input(INPUT_COOKIE, 'guest_language', FILTER_SANITIZE_STRING);
			} else {
				return 'en';
			}
		}
	}
?>