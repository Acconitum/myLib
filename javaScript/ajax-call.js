$.ajax({
    method: 'GET',
    url: '/url/where/call/goes.php',
    data: {
        someVariable: 'Sting or other types',
        someOtherStuff: 'blabla'            
    },
    success: function(response) {
        if (!$.isEmptyObject(response)) {
            $(window).trigger('ajaxsearch:hasresults', [response]); // Trigger custom event
        } else {
            $(window).trigger('ajaxsearch:hasnoresults'); // Trigger custom event
        }
    },
    fail: function(response, status) {
        $(window).trigger('ajaxsearch:failed', // Trigger custom event
    }
    statusCode: { // If you get a statuscode... hanlde it here
        500: function(response) {
        $(document).doSomeThing();
    }
});