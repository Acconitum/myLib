(function ($) {

	/**
	 * @see https://css-tricks.com/slide-in-as-you-scroll-down-boxes/
	 */

	$.fn.isVisible = function (partial) {

		var $t = $(this),
			$w = $(window),
			viewTop = $w.scrollTop(),
			viewBottom = viewTop + $w.height(),
			_top = $t.offset().top,
			_bottom = _top + $t.height(),
			compareTop = partial === true ? _bottom : _top,
			compareBottom = partial === true ? _top : _bottom;

		return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

	};


	var allMods = $(".card.big, .card.small");

	$(document).ready(function () {
		$(window).scroll(function (event) {

			$('.card.big, .card.small').each(function (i, el) {
				var el = $(el);
				if (el.isVisible(true)) {
					el.addClass("come-in");
				}
			});
		});

		setTimeout(function () {
			// Already visible modules
			allMods.each(function (i, el) {
				var el = $(el);
				if (el.isVisible(true)) {
					el.addClass("already-visible");
				}
			});
		}, 500);
	});

})(jQuery);


.card {
	transform: translateX(-50px);
	opacity: 0;

	&.come-in {
		animation: come-in 0.8s ease forwards;
	}

	&.already-visible {
		transform: translateX(0);
		opacity: 1;
		animation: none;
	  }
}

@keyframes come-in {
	to {
		transform: translateX(0);
		opacity: 1;
	}
}
