$(function(){
	
	$('.list_contents .out .in_cont .imgs').click(function(){
		var obj = $(this).parent().find('.content');
		var img_obj = $(this).parent().find('.imgs');
//		$(this).parent().find('.content').css('display','block');
		
		
		var is_hide = obj.css('display');
		if(is_hide == 'none'){
			obj.css('display','block');
			img_obj.attr('src','./images/helps/sj_btn_32.png');
			img_obj.css('top','0.6em');
		}else if(is_hide == 'block'){
			obj.css('display','none');
			img_obj.attr('src','./images/helps/sj_btn_28.png');
			img_obj.css('top','0.2em');
		}
	})

})
