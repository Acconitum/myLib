(function ($) {

	var sidebarStopElement = $('[data-sidebar-stop]')
	var sidebar = $('[data-social-media-sidebar]');
	var spaceBelow = $(window).height() - sidebar[0].getBoundingClientRect().bottom;
	var sidebarStop = parseInt(sidebarStopElement.offset().top) + parseInt(spaceBelow) - parseInt(sidebar.height());
	var topBefore = sidebar.css('top');

	function getDistance(sidebarStop) {
		return sidebarStop - $(window).scrollTop();
	}

	$(document).on('scroll', function () {
		if (sidebar && sidebarStop) {

			if (getDistance(sidebarStop) <= 10) {
				sidebar.css('position', 'absolute');
				sidebar.css('top', (parseInt(sidebarStopElement.offset().top) - (parseInt(sidebar.height()) / 2)) + 'px');
			} else {
				sidebar.css('position', 'fixed');
				sidebar.css('top', topBefore);
			}
		}
	});
})(jQuery);
