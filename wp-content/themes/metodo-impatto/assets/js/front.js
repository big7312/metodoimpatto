document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('.mi-copy-link').forEach(function (button) {
		button.addEventListener('click', function () {
			var url = button.getAttribute('data-url');

			if (!url || !navigator.clipboard) {
				return;
			}

			navigator.clipboard.writeText(url).then(function () {
				button.textContent = miThemeData.copiedLabel;
				window.setTimeout(function () {
					button.textContent = miThemeData.copyLabel;
				}, 1800);
			});
		});
	});
});

