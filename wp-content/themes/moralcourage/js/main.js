$(document).ready(function() {

	function isMobileDevice() {
	    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
	};

	var mobile = isMobileDevice();

	if(mobile) {
		$('html').addClass('mobile');
	}
	$('.menu-mobile').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$(this).parents('.nav-menu').toggleClass('active');
	});
	$('.nav-menu').on('touchstart', function(event) {
		event.stopPropagation();
	});
	$('body').on('touchstart', function(event) {

		$('.nav-menu').removeClass('active');
	});
	$('.survey-tab').on('click', function() {
		var $surveyForm = $('.survey-form');
		if (!$surveyForm.length) {
			return false;
		}
		$(this).removeClass('active');
		$surveyForm.addClass('active')
			.find('.wpcf7-response-output').hide()
			.end()
			.find('.wpcf7-not-valid-tip').remove()
			.end()
			.find('.wpcf7-form').removeClass('invalid');
	});
	$('.survey-form .close').on('click', function(event) {
		var $surveyTab = $('.survey-tab');
		event.preventDefault();

		$(this).parents('.survey-form').removeClass('active');
		$surveyTab.addClass('active');
	});
	for (var submodule in MORAL) {
		if (MORAL.hasOwnProperty(submodule) === true) {
			MORAL[submodule].init();
		}
	}
});
