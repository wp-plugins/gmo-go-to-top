(function($){
	$('#color_picker').farbtastic('#img_color');
		
	$('ul.icon_font li').click(function () {
		var $icon_id = $(this).children('i').attr('class');
		$('ul.icon_font li').removeClass('select_icon');
		$(this).addClass('select_icon');
		$('input[name="icon_fontstyle"]').val($icon_id);
	});
	$('ul.type_select li').click(function () {
		var $type_id = $(this).children('div').attr('class');
		$('ul.type_select li').removeClass('select_icon');
		$(this).addClass('select_icon');
		$('input[name="type"]').val($type_id);
		select();
	});
/*
	$('ul.type_select li').click(function() {
		$('input[name="type"]').removeAttr('checked');
		$(this).children('input[name="type"]').attr('checked', 'checked');
		$('ul.type_select li').removeClass('select_icon');
		select();
	});
*/
	function select(){
		var selectval = $('input[name="type"]').val();
		if( selectval == 'icon_select' ){
			$('#images_table').hide();
			$('#icon_table').show();
		}
		if( selectval == 'images_select' ){
			$('#icon_table').hide();
			$('#images_table').show();
		}
	}
	
	$(window).on('load',function(){
		select();
	});
	
})(jQuery);