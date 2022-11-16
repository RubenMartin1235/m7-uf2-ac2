function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}

let cookieConsentBanner = document.querySelector('#cookie-consent-banner');

if (getCookie('cookie-consent') != null) {
	cookieConsentBanner.style.display = "none";
}
cookieConsentBanner.addEventListener('click',
	(e) => {
		const btn = e.target;
		
		let expiryDate = new Date();
		expiryDate.setTime(expiryDate.getTime() + (365 * 24*60*60*1000));
		let expiresStr = "expires=" + expiryDate.toUTCString();

		let closeBannerAfterSelection = false;
		switch (btn.id) {
			case 'btn-cookie-consent-reject-all':
				closeBannerAfterSelection = true;
				document.cookie = `cookie-consent=false;${expiresStr}`;
				break;
		
			case 'btn-cookie-consent-accept-all':
				closeBannerAfterSelection = true;
				document.cookie = `cookie-consent=true;${expiresStr}`;

				document.cookie = `guest_colorTheme=light_default;${expiresStr}`;
				document.cookie = `guest_language=en;${expiresStr}`;
				break;
		}
		if (closeBannerAfterSelection) {
			cookieConsentBanner.style.display = "none";
		}
	}
);