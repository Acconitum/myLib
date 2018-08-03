(function ($) {

	var sidebarStopElement,
		sidebar,
		spaceBelow,
		sidebarStop,
		topBefore;

	var isSidebarReady = false;

	function init() {
		if ($('[data-share-button-sidebar]').length === 1) {

			isSidebarReady = true;
			sidebarStopElement = $('[data-sidebar-stop]')
			sidebar = $('[data-social-media-sidebar]');

			if (sidebar.length > 0) {
				spaceBelow = $(window).height() - sidebar[0].getBoundingClientRect().bottom;
				topBefore = sidebar.css('top');
			}

			return;
		} else {

			setTimeout(function () {
				init();
			}, 500);
		}
	}

	var scrollBefore = $(window).scrollTop();
	function isScrollingUp() {
		if (scrollBefore < $(window).scrollTop()) {
			scrollBefore = $(window).scrollTop();
			return false;
		} else {
			scrollBefore = $(window).scrollTop();
			return true;
		}
	}

	init();

	$(document).on('scroll', function () {

		if ($(window).width() >= 768) {
			if (isSidebarReady && sidebar.length > 0) {

				sidebarStop = $(window).scrollTop() + $(window).height() - spaceBelow;

				if (parseInt(sidebarStopElement.offset().top) - parseInt($('.share-bar-wrap').outerHeight()) - sidebarStop <= 0) {
					sidebar.css('position', 'absolute');
					sidebar.css('top', (parseInt(sidebarStopElement.offset().top) - (parseInt(sidebar.outerHeight())) - parseInt($('.share-bar-wrap').outerHeight() + 160)) + 'px');
				} else {
					sidebar.css('position', 'fixed');
					sidebar.css('top', topBefore);
				}
			}
		} else {

			if (isScrollingUp()) {
				$('[data-social-media-sidebar]').addClass('is--visible');
			} else {
				$('[data-social-media-sidebar]').removeClass('is--visible');
			}
		}
	});

	$(document).ready(function () {
		$('[data-toggle-mobile-share]').on('click', function () {
			$('body').toggleClass('is--mobile-share-open');
		});
	});

})(jQuery);
