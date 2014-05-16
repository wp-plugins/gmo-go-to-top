(function ($) {
	$(document).ready(function(){
		$(".gotop").click(function () {
			$('html,body').animate({ scrollTop: 0 }, 'fast');
			return false;
		});
	});
})(jQuery);