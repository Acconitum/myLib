(function ($) {

	var sidebarStopElement,
		sidebar,
		spaceBelow,
		sidebarStop,
		topBefore;

	var	isSidebarReady = false;

	function init() {
		if($('.at-share-btn-elements').length === 1) {

			isSidebarReady = true;
			sidebarStopElement = $('[data-sidebar-stop]')
			sidebar = $('[data-social-media-sidebar]');

			if (sidebar.length > 0) {
				spaceBelow = $(window).height() - sidebar[0].getBoundingClientRect().bottom;
				topBefore = sidebar.css('top');
			}

			return;
		} else {

			setTimeout( function() {
				init();
			}, 500 );
		}
	}

	function getDistance(sidebarStop) {
		return sidebarStop - $(window).scrollTop();
	}

	init();

	$(document).on('scroll', function () {
		if (isSidebarReady && sidebar.length > 0) {

			sidebarStop = $(window).scrollTop() + $(window).height() - spaceBelow;

			if ( parseInt(sidebarStopElement.offset().top) - sidebarStop <= 0 ) {
				sidebar.css('position', 'absolute');
				sidebar.css('top', (parseInt(sidebarStopElement.offset().top) - 10 - (parseInt(sidebar.outerHeight()))) + 'px');
			} else {
				sidebar.css('position', 'fixed');
				sidebar.css('top', topBefore);
			}
		}
	});

})(jQuery);
