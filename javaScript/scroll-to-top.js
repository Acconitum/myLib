(function ($) {
	$(document).ready(function () {
		$("[data-scroll-to-top]").on('click touchstart', function () {
			//1 second of animation time
			$("html, body").animate({ scrollTop: 0 }, 1000);
		});
	});
})(jQuery);
