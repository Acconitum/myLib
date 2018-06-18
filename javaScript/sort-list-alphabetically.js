// sort countrys in german alphabetically	
$(document).ready(function () {
	if ($('.location-select').length > 0) {
		var options = $('.location-select li');

			options.sort(function (a, b) {
			if ($(a).find('.text').text() > $(b).find('.text').text()) {
				return 1;
			}
			else if ($(a).find('.text').text() < $(b).find('.text').text()) {
				return -1;
			}
			else {
				return 0;
			}
		});
		$(".location-select").empty().append(options);
	}
});

