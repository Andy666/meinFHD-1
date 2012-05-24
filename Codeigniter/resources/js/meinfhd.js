(function($) {
	// load head.js
	$.getScript("resources/headjs/src/core.js");
	
	// load scripts and assign labels to them due to better js management
	head.js(
		{bootstrap-alert: "resources/bootstrap/js/bootstrap-alert.js"},
		{bootstrap-button: "resources/bootstrap/js/bootstrap-button.js"},
	/*	{bootstrap-: "http://cnd.jquerytools.org/1.2.5/tiny/jquery.tools.min"},
		{heavy: "http://a.heavy.library/we/dont/want/to/wait/for.js"},
		
		// label is optional
		"http://can.be.mixed/with/unlabeled/files.js" */
	);
})(jQuery);