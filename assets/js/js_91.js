$(function(){
	
	
	/*********��ͼ*********/
	
	var wid = $('.content_91 .banners').width();
	var hid = wid/(2.39);
	
	var spwi = $('.content_91 .banners .point .point_in span').width();
	$('.content_91 .banners .point .point_in').css('width',3*(spwi+4)+'px');
	
	$('.content_91 .banners').css('height',hid+'px');	
	$('.content_91 .banners .imgs').css('height',hid+'px');
	$('.content_91 .banners .imgs li').css('height',hid+'px');
	
	var l=$('.content_91 .banners .imgs li').length;
	$('.content_91 .banners .imgs').css("left",(-1)*wid+'px');
    $(".b-big div").eq(0).css("background","#0ac");
    var j=0;
	function run(){
        j++;
        if(j>=$(".b-big div").length)
        {
            j=0;
        }
		$('.content_91 .banners .imgs li').eq(0).insertAfter($('.content_91 .banners .imgs li').eq(l-1));
		$('.content_91 .banners .imgs').css("left","0px");
		$('.content_91 .banners .imgs').animate({left:(-1)*wid+'px'},1000);
        $(".b-big div").eq(j).css("background","#0ac");
        $(".b-big div").eq(j).siblings().css("background","#ccc");
	}
	var timer=setInterval(run,4000);

	
	/*********��ͼ*********/
	
	var ir_wid=$('.content_91 .i_reits .project').width();
	var ir_hid = wid/(2.356);
	$('.content_91 .i_reits .project .img').css('height',ir_hid+'px');
	
	var sreen_heig = document.documentElement.clientHeight;
	var foot_heig = $('.footer_91').height()+10;
	var pro_heig = $('.pro_header').height();

	$('.content_91').css('height',sreen_heig-(foot_heig)+'px');
	//$('.pro_content').css('height',sreen_heig-(pro_heig+foot_heig)+'px');
	//$('.i_reits').css('height',sreen_heig-(foot_heig+pro_heig)+'px');
	
//	�ײ�
	$('.footer_91 .inline .con').hover(function(){
		$(this).children('.list').css('display','block');
	},function(){
		$(this).children('.list').css('display','none');
	});
	
//	��Ŀ��ϸ��Ϣ�ĵ����
	$('.more_info .financ_info .fina_titles').click(function(){
		var cs=$(this).next('.contents').css('display');

	if(cs=='block'){
			$(this).next('.contents').css('display','none');
		}else{
			$(this).next('.contents').css('display','block');
		}
		
		$(this).parent('.financ_info').siblings('.financ_info').find('.contents').css('display','none');
		
	})
	
});
