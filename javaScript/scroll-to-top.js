(function ($) {
	$(document).ready(function () {
		$("[data-back-to-top]").on('click', function () {
			//1 second of animation time
			$("html").animate({ scrollTop: 0 }, 1000);
		});
	});
})(jQuery);
