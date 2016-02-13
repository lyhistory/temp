<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="c">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<base href="<?=$this->config->item('base_url')?>assets/" />
<link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
<link rel="stylesheet" type="text/css" href="css/project.css"/>
<script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>

<script src="js/js_91.js" type="text/javascript" charset="utf-8"></script>
    <style>
       *{margin: 0; padding: 0;}
               .menu{width: 70px; height: 70px;position: relative; bottom:0px; right: 20px;  position: fixed;z-index: 100;margin-bottom:25px;}
               .q{ display: block; width:70px; border-radius: 50%;                       /*菜单和子菜单样式*/
                   font-size:1em; text-align: center; 
                   font-family: "微软雅黑"; position: absolute; top: 0px; left: 0px; height:90px;}
               .q p{ background: #000; opacity: .6; width: 70px;height:20px; border-radius: 10px;    /*子菜单文字样式*/
                   font-size: .8em; position: absolute;bottom: 0;color: #fff;
                   line-height:20px; left: 0;}
               .menu-img{ width: 100%;}
               .menu-img img{ max-width: 100%;}
			   a:hover{
				   color:#8D8D8E;
				   }
			   a:visited{
				   color:#8D8D8E;
				   }
			   a:link{
				   color:#8D8D8E;
				   }
			   a:active{
				   color:#8D8D8E;
				   }
    </style>
<script src="js/change.js"></script>
<script>
    $(function() {
            $('.circle').each(function(index, el) {
                var num = $(this).find('span').text() * 3.6;
                if (num<=180) {
                    $(this).find('.right').css('transform', "rotate(" + num + "deg)");
                } else {
                    $(this).find('.right').css('transform', "rotate(180deg)");
                    $(this).find('.left').css('transform', "rotate(" + (num - 180) + "deg)");
                }
            });
        });
</script>

</head>
<body>
	
	
    <div class="content_91">
<!-- -------------首页菜单------------- -->
    	<div class="top_menu">    
    		<div class="top_log"><img src="images/left_top_logo.png" width="" height="35px" alt="" /></div>
        	<div id="menu_ind" class="top_menu_log"><img src="images/menu.png" width="25px" height="25px" alt="" /></div> 
   		</div>
        
        <div id="menu_content" class="top_menu_content">
        	<div class="menu_close">
            	<img src="images/close_ind.png" id="close_menu" width="" height="27px" alt="" style="margin-top:15px; float:right; margin-right:10px; cursor:hand; " />
            </div>
            
        <center>
            <div class="menu_content">
            	<table>
                	<tr style="height:60px;">
                    	<td class="menu_content_td1"><img src="images/tubiao/home.png" height="20px" alt="" /></td>
                        <td class="menu_content_td2"><a href="<?php echo site_url('home') ?>">首&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</a></td>
                    </tr>
                    <tr style="height:60px;">
                    	<td class="menu_content_td1"><img src="images/tubiao/user.png" height="20px" alt="" /></td>
                        <td class="menu_content_td2"> <a href="<?php echo site_url('myaccount/setting') ?>">个人中心</a></td>
                    </tr>
                    <tr style="height:60px;">
                    	<td class="menu_content_td1"><img src="images/tubiao/help.png" height="20px" alt="" /></td>
                    	<td class="menu_content_td2"><a href="<?php echo site_url('helps') ?>">帮助中心</a></td>
                    </tr>
                    <tr style="height:60px;">
                    	<td class="menu_content_td1"><img src="images/tubiao/about.png" height="20px" alt="" /></td>
                    	<td class="menu_content_td2"><a href="<?php echo site_url('helps/ourteam') ?>">关于我们</a></td>
                    </tr>
                    <tr style="height:70px;">
                    	<td style=" width:50px; text-align:center; font-size:19px;"><div class="menu_content_td3" style="margin-left:10px;"><a href="<?php echo site_url('login') ?>">登录</a></div></td>
                    	<td style=" width:50px;  font-size:19px;"><div class="menu_content_td3" style="margin-left:20px;"><a href="<?php echo site_url('register/phoneRegister') ?>">注册</a></div></td>
                    </tr>
                </table>    
            </div>
            </center>
        </div>
        
        
            <div id="footer">
        <div class="menu">
            <a href="<?php echo site_url('home') ?>" id="q" class="q" style="opacity:0;">
                <div class="menu-img"><img src="images/home/1.png" alt=""/></div>
                <p>主页</p>
            </a>
            <a href="<?php echo site_url('myaccount/setting') ?>" id="w" class="q" style="opacity:0;">
                <div class="menu-img"><img src="images/home/2.png" alt=""/></div>
                <p>我</p>
            </a>
            <a href="<?php echo site_url('ireits') ?>" id="e" class="q" style="opacity:0;">
                <div class="menu-img"><img src="images/home/3.png" alt=""/></div>
                <p>投资</p>
            </a>
            <a href="<?php echo site_url('helps') ?>" id="r" class="q" style="opacity:0;">
                <div class="menu-img"><img src="images/home/4.png" alt=""/></div>
                <p>帮助中心</p>
            </a>
            <div id="t" class="q">
                <div class="menu-img"><img src="images/home/menu.png" alt=""/></div>
            </div>
        </div>
<!-- -------------首页菜单结束------------- -->
<!-- ------------首页挂图------------- -->
        <div id="wrapper" style="height:100%; margin-top:30px;">
            <div id="scroller">
                <div class="banners">
                <center>
                    <div class="b-big">
                        <div class="b-big-div"></div>
                        <div class="b-big-div"></div>
                        <div class="b-big-div"></div>
                        <div class="b-big-div"></div>
                    </div>
                 </center>
                    <ul class="imgs" >
                        <input id ="i_totalPage"   type="hidden" value = "<?php echo $total_page?>">
                        <?php foreach ($player as $item):?>
                            <li ><a href="<?= $item["link"]?>"><img  src="<?= $item["img"]?>"  /></a></li>
                        <?php endforeach?>
                    </ul>
                </div>
				<div class="tf_huabian"><img src="images/huabian.png" width="100%" alt="" /></div>
<!--            <div id="pullDown">
                    <span class="pullDownIcon"></span><span class="pullDownLabel">Pull down to refresh...</span>
                </div>
-->

<!--新主体开始-->

<div style="">
	<!--投房1号开始-->
	<div class="tf_content">
        <div class="tf_id">
        <center>
        	<div style="width:610px;">
        		<div id="tf1" class="tf_ida">
            		<div>
                    	<center>
                    		<img id="tf1loga" src="images/toufang_1.png" height="40px" width="95px" style="display:block;" alt="" />
                            <img id="tf1logb" src="images/toufang_11.png" height="40px" width="95px" style="display:none;" alt="" />
                         </center>
                    </div>
                	<div><center><h2 style="bottom:0px;">投房一号</h2></center></div>
        		</div>
            	<div style="float:left;">
            		<img src="images/line_shu.png" height="90px" width="2px" alt="" />
            	</div>
           	 	<div id="tf2" class="tf_ida">
            		<div>
                    	<center>
                    		<img id="tf2loga" src="images/toufang_2.png" height="40px" width="95px" style="display:none;" alt="" />
                            <img id="tf2logb" src="images/toufang_22.png" height="40px" width="95px" style="display:block;" alt="" />
                    	</center>
                    </div>
                	<div><center><h2>投房二号</h2></center></div>
        		</div>
            	<div style="float:left;">
            		<img src="images/line_shu.png" height="90px" width="2px" alt="" />
            	</div>
            	<div  id="tf3" class="tf_ida">
            		<div>
                    	<center>
                        	<img id="tf3loga" src="images/toufang_3.png" height="40px" width="95px" style="display:none;" alt="" />
                            <img id="tf3logb" src="images/toufang_33.png" height="40px" width="95px" style="display:block;" alt="" />
                        </center>
                    </div>
                	<div><center><h2>投房三号</h2></center></div>
       			</div>
            </div>
         </center>
        </div>
<!--投房详情部分-->

        <center>
        <div style="width:458px;">
    <!--tf1号开始-->
        	<div id="tf1h" style="width:100%px; position:absolute; display:block;">
        		<div class="tfid_a">
                <center>
            		<div><img src="images/tf_bg.png" width="300px" height="300px" alt="" /></div>
                	<div  class="tfid_b">
                		<p class="tfid_b_p1">项目投资进度</p>
                		<p class="tfid_b_p2">100.0%</p>
                		<p ><img src="images/line_tf2.png" alt=""/></p>
                		<p class="tfid_b_p3">剩余金额：0万</p>
                	</div>
                </center>
            	</div>
                
        		<div class="tfid_c">
            	<center>
            	<table>
                	<tr>
                    	<td class="tfid_td1"><span class="tfid_sp1">1</span><span class="tfid_sp2">个月</span></td>
                        <td class="tfid_td1"><span class="tfid_sp1">100万</span><span class="tfid_sp2">元</span></td>
                        <td class="tfid_td1"><span class="tfid_sp3">10.5%+</span><span class="tfid_sp4">5.5%</span></td>
                    </tr>
                    <tr>
                    	<td class="tfid_td2">项目期限</td>
                        <td class="tfid_td2">项目总额</td>
                        <td class="tfid_td2">项目收益</td>
                    </tr>
                </table>
                </center>
            	</div>
            
           		<div class="tfid_d">
            	<center>
            		<img src="images/tf_jx.png" width="400px" height="60px" alt="" />
                	<p class="tfid_d1">马上投入</p>
                </center>
            	</div>
        	</div>
     <!--tf1号结束--> 
     <!--tf2号开始-->
        	<div id="tf2h" style="width:100%px; position:absolute; display:none;">
        		<div class="tfid_a">
                <center>
            		<div><img src="images/tf_bg.png" width="300px" height="300px" alt="" /></div>
                	<div  class="tfid_b">
                		<p class="tfid_b_p1">项目投资进度</p>
                		<p class="tfid_b_p2">80%</p>
                		<p ><img src="images/line_tf2.png" alt=""/></p>
                		<p class="tfid_b_p3">剩余金额：60万</p>
                	</div>
                </center>
            	</div>
                
        		<div class="tfid_c">
            	<center>
            	<table>
                	<tr>
                    	<td class="tfid_td1"><span class="tfid_sp1">3</span><span class="tfid_sp2">个月</span></td>
                        <td class="tfid_td1"><span class="tfid_sp1">300万</span><span class="tfid_sp2">元</span></td>
                        <td class="tfid_td1"><span class="tfid_sp3">15%+</span><span class="tfid_sp4">3%</span></td>
                    </tr>
                    <tr>
                    	<td class="tfid_td2">项目期限</td>
                        <td class="tfid_td2">项目总额</td>
                        <td class="tfid_td2">项目收益</td>
                    </tr>
                </table>
                </center>
            	</div>
            
           		<div class="tfid_d">
            	<center>
            		<img src="images/tf_jx.png" width="400px" height="60px" alt="" />
                	<p class="tfid_d1">马上投入</p>
                </center>
            	</div>
        	</div>
     <!--tf2号结束--> 
     <!--tf3号开始-->
        	<div id="tf3h" style="width:100%px; position:absolute; display:none;">
        		<div class="tfid_a">
                <center>
            		<div><img src="images/tf_bg.png" width="300px" height="300px" alt="" /></div>
                	<div  class="tfid_b">
                		<p class="tfid_b_p1">项目投资进度</p>
                		<p class="tfid_b_p2">55%</p>
                		<p ><img src="images/line_tf2.png" alt=""/></p>
                		<p class="tfid_b_p3">剩余金额：225万</p>
                	</div>
                </center>
            	</div>
                
        		<div class="tfid_c">
            	<center>
            	<table>
                	<tr>
                    	<td class="tfid_td1"><span class="tfid_sp1">6</span><span class="tfid_sp2">个月</span></td>
                        <td class="tfid_td1"><span class="tfid_sp1">500万</span><span class="tfid_sp2">元</span></td>
                        <td class="tfid_td1"><span class="tfid_sp3">18%+</span><span class="tfid_sp4">2%</span></td>
                    </tr>
                    <tr>
                    	<td class="tfid_td2">项目期限</td>
                        <td class="tfid_td2">项目总额</td>
                        <td class="tfid_td2">项目收益</td>
                    </tr>
                </table>
                </center>
            	</div>
            
           		<div class="tfid_d">
            	<center>
            		<img src="images/tf_jx.png" width="400px" height="60px" alt="" />
                	<p class="tfid_d1">马上投入</p>
                </center>
            	</div>
        	</div>
     <!--tf3号结束--> 
        </div> 
        </center>
    </div>
    <!--投房1号结束-->  
  
    <!--新手专享开始-->
    <div style="width:100%px;">
    	<center>
        <div style="width:500px;">
        	<div style="width:100%px; position:; display:block;">
        		<div style="width:100%px; height:340px; margin-top:20px;">
                <center>
            		<div><img src="images/xszx_bg.png" width="500px" height="590px" alt="" /></div>
                	<div style="position:relative; top:-540px;">
                		<p class="tfid_b_p1" >项目投资进度</p>
                		<p class="tfid_b_p2" >85.0%</p>
                		<p style=" margin-top:0px;"><img src="images/line_tf2.png" alt=""/></p>
                		<p class="tfid_b_p3" >剩余金额：1.5万</p>
                	</div>
                </center>
            	</div>
                
        		<div class="tfid_c" style="margin-top:50px;">
            	<center>
            	<table>
                	<tr>
                    	<td class="tfid_td1"><span class="tfid_sp1">7</span><span class="tfid_sp2">天</span></td>
                        <td class="tfid_td1"><span class="tfid_sp1">10万</span><span class="tfid_sp2">元</span></td>
                        <td class="tfid_td1"><span class="tfid_sp3"></span><span class="tfid_sp4">50%</span></td>
                    </tr>
                    <tr>
                    	<td class="tfid_td2">项目期限</td>
                        <td class="tfid_td2">项目总额</td>
                        <td class="tfid_td2">项目收益</td>
                    </tr>
                </table>
                </center>
            	</div>
            
           		<div class="tfid_d">
            	<center>
            		<img src="images/tf_jx.png" width="400px" height="60px" alt="" />
                	<p class="tfid_d1" >马上投入</p>
                </center>
            	</div>
        	</div>
     
        </div> 
        </center>
    </div>
    <!--新手专享结束-->
    
    <!--众筹租房开始-->
    <div style="width:100%px;">
    	<center>
        <div style="width:500px;">
        	<div style="width:100%px; position:; display:block;">
        		<div style="width:100%px; height:340px; margin-top:100px;">
                <center>
            		<div><img src="images/zczf_bg.png" width="500px" height="590px" alt="" /></div>
                	<div style="position:relative; top:-380px;">
                		<p style=" color:#FFF; font-size:22px;">众筹租房</p><br>
                		<p style=" margin-top:0px;"><img src="images/aczf_logo.png" width="50px" alt=""/></p>
                	</div>
                </center>
            	</div>
                
        		<div style="width:100%px; height:80px; border:0px solid #000; margin-top:50px;" >
            	<center>
            	<table>
                	<tr>
                    	<td class="tfid_td1"><span class="tfid_sp1">6</span><span class="tfid_sp2">个月</span></td>
                        <td class="tfid_td1"><span class="tfid_sp1">300万</span><span class="tfid_sp2">元</span></td>
                        <td class="tfid_td1"><span class="tfid_sp3"></span><span class="tfid_sp4">15%</span></td>
                    </tr>
                    <tr>
                    	<td class="tfid_td2">项目期限</td>
                        <td class="tfid_td2">项目总额</td>
                        <td class="tfid_td2">项目收益</td>
                    </tr>
                </table>
                </center>
            	</div>
            
           		<div class="tfid_d">
            	<center>
            		<img src="images/tf_jx.png" width="400px" height="60px" alt="" />
                	<p class="tfid_d1" >马上投入</p>
                </center>
            	</div>
        	</div>
     
        </div> 
        </center>
    </div>
    <!--众筹租房结束-->
    
    <!--投房股神开始-->
    
    <div  style="margin-top:50px; width:100%px;">
    	<div class="gs_content">
        	<center>
    		<div style="width:250px;">
        		<div style="float:left; margin-top:15px;"><img src="images/tfgs_line.png" width="" height="" alt="" /></div>
        		<div style="font-size:28px; line-height:50px;float:left; ">&nbsp;投房股神&nbsp;</div>
        		<div style="float:left; margin-top:15px;"><img src="images/tfgs_line.png" width="" height="" alt="" /></div>
        	</div>
        	</center>
        </div>
        
        <div style="width:100%px; height:260px;">
        <center>
        	<div><img src="images/tfgs1.png" width="500px" height="" alt="" /></div>
            <div class="tfgs_cont"><p class="tf_con_p1">30<span style="font-size:25px;">%</span></p><p class="tf_con_p2">预期收益</p></div>
            <div class="tfgs_cont_i">
            	<table>
                	<tr class="tftr">
                    	<td >可投金额：</td>
                        <td><span class="sp" style="color:#87C8FF;font-size:20px;">480000.00</span>元</td>
                    </tr>
                    <tr class="tftr">
                    	<td>期<span style="margin-left:36px;">限</span>：</td>
                        <td><span class="sp" style="color:#87C8FF;font-size:20px;">2</span>年</td>
                    </tr>
                    <tr class="tftr">
                    	<td >总<span style="margin-left:9px;">金</span><span style="margin-left:9px;">额</span>：</td>
                        <td><span class="sp" style="color:#87C8FF;font-size:20px;">1200000.00</span>元</td>
                    </tr>
                    <tr class="tftr">
                    	<td >进<span style="margin-left:36px;">度</span>：</td>
                        <td>
                        <p>
                        	<i class="jd_down">
    							<i class="jd_up">
    							</i>
                            </i>
                            <span style="color:#000; font-size:15px;">&nbsp;<!--{$var.borrow_account_scale}-->60%</span>
                        </p>
                        </td>
                    </tr>
                </table>
                <div class="tfgs_anbg">
                	<div><img src="images/tf_jx.png" width="200px" height="45px" alt="" /></div>
                    <div class="tfgs_anft">立刻投标</div>
                </div>
            </div>
        </center>
        </div>
        
        <div style="width:100%px; height:260px;">
        <center>
        	<div><img src="images/tfgs1.png" width="500px" height="" alt="" /></div>
            <div class="tfgs_cont"><p class="tf_con_p1">40<span style="font-size:25px;">%</span></p><p class="tf_con_p2">预期收益</p></div>
            <div class="tfgs_cont_i">
            	<table>
                	<tr class="tftr">
                    	<td >可投金额：</td>
                        <td><span class="sp" style="color:#87C8FF;font-size:20px;">1400000.00</span>元</td>
                    </tr>
                    <tr class="tftr">
                    	<td>期<span style="margin-left:36px;">限</span>：</td>
                        <td><span class="sp" style="color:#87C8FF;font-size:20px;">3</span>年</td>
                    </tr>
                    <tr class="tftr">
                    	<td >总<span style="margin-left:9px;">金</span><span style="margin-left:9px;">额</span>：</td>
                        <td><span class="sp" style="color:#87C8FF;font-size:20px;">2000000.00</span>元</td>
                    </tr>
                    <tr class="tftr">
                    	<td >进<span style="margin-left:36px;">度</span>：</td>
                        <td>
                        <p>
                        	<i class="jd_down">
    							<i style="width:30%;border-radius: 3px;display: inline-block;height: 6px;background-color: #049FF1;  position:relative; bottom:13px;">
    							</i>
                            </i>
                            <span style="color:#000; font-size:15px;">&nbsp;<!--{$var.borrow_account_scale}-->30%</span>
                        </p>
                        </td>
                    </tr>
                </table>
                <div class="tfgs_anbg">
                	<div><img src="images/tf_jx.png" width="200px" height="45px" alt="" /></div>
                    <div class="tfgs_anft">立刻投标</div>
                </div>
            </div>
        </center>
        </div>
    
    </div>
   
    <!--投房股神结束-->
</div>
<!--新主体内容结束-->

	
    
 	<!--手指滑动-->   
    <div id="pullUp"><span class="pullUpIcon"></span><span class="pullUpLabel"></span></div>
    <!--手指滑动-->
    </div>
    
</body>

<script type="text/javascript">

/*!
 * iScroll v4.2.5 ~ Copyright (c) 2012 Matteo Spinelli, http://cubiq.org
 * Released under MIT license, http://cubiq.org/license
 */
 	window.onload=function ()
		{
	 var menu_ind=document.getElementById('menu_ind');
	 
	 var menu_content=document.getElementById('menu_content');
	 
	 menu_ind.onclick=function ()
			{
				menu_content.style.display="block";
			}
	 var close_menu=document.getElementById('close_menu');
	 close_menu.onclick=function()
			{
				menu_content.style.display="none";
			}
			
	 var tf1=document.getElementById('tf1');
	 var tf2=document.getElementById('tf2');
	 var tf3=document.getElementById('tf3');
	 var tf1h=document.getElementById('tf1h');
	 var tf2h=document.getElementById('tf2h');
	 var tf3h=document.getElementById('tf3h');
	 
	 var tf1loga=document.getElementById('tf1loga');
	 var tf1logb=document.getElementById('tf1logb');
	 var tf2loga=document.getElementById('tf2loga');
	 var tf2logb=document.getElementById('tf2logb');
	 var tf3loga=document.getElementById('tf3loga');
	 var tf3logb=document.getElementById('tf3logb');
	 		
			
	 tf1.onclick=function ()
	 		{
				tf1h.style.display="block";
				tf2h.style.display="none";
				tf3h.style.display="none";
				
				tf1loga.style.display="block";
				tf1logb.style.display="none";
				tf2loga.style.display="none";
				tf2logb.style.display="block";
				tf3loga.style.display="none";
				tf3logb.style.display="block";
			}
	 tf2.onclick=function ()
	 		{
				tf1h.style.display="none";
				tf2h.style.display="block";
				tf3h.style.display="none";
				
				tf1loga.style.display="none";
				tf1logb.style.display="block";
				tf2loga.style.display="block";
				tf2logb.style.display="none";
				tf3loga.style.display="none";
				tf3logb.style.display="block";
			}
	 tf3.onclick=function ()
	 		{
				tf1h.style.display="none";
				tf2h.style.display="none";
				tf3h.style.display="block";
				
				tf1loga.style.display="none";
				tf1logb.style.display="block";
				tf2loga.style.display="none";
				tf2logb.style.display="block";
				tf3loga.style.display="block";
				tf3logb.style.display="none";
			}
	
		};
 
(function(window, doc){
    var m = Math,
        dummyStyle = doc.createElement('div').style,
        vendor = (function () {
            var vendors = 't,webkitT,MozT,msT,OT'.split(','),
                t,
                i = 0,
                l = vendors.length;

            for ( ; i < l; i++ ) {
                t = vendors[i] + 'ransform';
                if ( t in dummyStyle ) {
                    return vendors[i].substr(0, vendors[i].length - 1);
                }
            }

            return false;
        })(),
        cssVendor = vendor ? '-' + vendor.toLowerCase() + '-' : '',

    // Style properties
        transform = prefixStyle('transform'),
        transitionProperty = prefixStyle('transitionProperty'),
        transitionDuration = prefixStyle('transitionDuration'),
        transformOrigin = prefixStyle('transformOrigin'),
        transitionTimingFunction = prefixStyle('transitionTimingFunction'),
        transitionDelay = prefixStyle('transitionDelay'),

    // Browser capabilities
        isAndroid = (/android/gi).test(navigator.appVersion),
        isIDevice = (/iphone|ipad/gi).test(navigator.appVersion),
        isTouchPad = (/hp-tablet/gi).test(navigator.appVersion),

        has3d = prefixStyle('perspective') in dummyStyle,
        hasTouch = 'ontouchstart' in window && !isTouchPad,
        hasTransform = vendor !== false,
        hasTransitionEnd = prefixStyle('transition') in dummyStyle,

        RESIZE_EV = 'onorientationchange' in window ? 'orientationchange' : 'resize',
        START_EV = hasTouch ? 'touchstart' : 'mousedown',
        MOVE_EV = hasTouch ? 'touchmove' : 'mousemove',
        END_EV = hasTouch ? 'touchend' : 'mouseup',
        CANCEL_EV = hasTouch ? 'touchcancel' : 'mouseup',
        TRNEND_EV = (function () {
            if ( vendor === false ) return false;

            var transitionEnd = {
                ''			: 'transitionend',
                'webkit'	: 'webkitTransitionEnd',
                'Moz'		: 'transitionend',
                'O'			: 'otransitionend',
                'ms'		: 'MSTransitionEnd'
            };

            return transitionEnd[vendor];
        })(),

        nextFrame = (function() {
            return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function(callback) { return setTimeout(callback, 1); };
        })(),
        cancelFrame = (function () {
            return window.cancelRequestAnimationFrame ||
            window.webkitCancelAnimationFrame ||
            window.webkitCancelRequestAnimationFrame ||
            window.mozCancelRequestAnimationFrame ||
            window.oCancelRequestAnimationFrame ||
            window.msCancelRequestAnimationFrame ||
            clearTimeout;
        })(),

    // Helpers
        translateZ = has3d ? ' translateZ(0)' : '',

    // Constructor
        iScroll = function (el, options) {
            var that = this,
                i;

            that.wrapper = typeof el == 'object' ? el : doc.getElementById(el);
            that.wrapper.style.overflow = 'hidden';
            that.scroller = that.wrapper.children[0];

            // Default options
            that.options = {
                hScroll: true,
                vScroll: true,
                x: 0,
                y: 0,
                bounce: true,
                bounceLock: false,
                momentum: true,
                lockDirection: true,
                useTransform: true,
                useTransition: false,
                topOffset: 0,
                checkDOMChanges: false,		// Experimental
                handleClick: true,

                // Scrollbar
                hScrollbar: true,
                vScrollbar: true,
                fixedScrollbar: isAndroid,
                hideScrollbar: isIDevice,
                fadeScrollbar: isIDevice && has3d,
                scrollbarClass: '',

                // Zoom
                zoom: false,
                zoomMin: 1,
                zoomMax: 4,
                doubleTapZoom: 2,
                wheelAction: 'scroll',

                // Snap
                snap: false,
                snapThreshold: 1,

                // Events
                onRefresh: null,
                onBeforeScrollStart: function (e) { e.preventDefault(); },
                onScrollStart: null,
                onBeforeScrollMove: null,
                onScrollMove: null,
                onBeforeScrollEnd: null,
                onScrollEnd: null,
                onTouchEnd: null,
                onDestroy: null,
                onZoomStart: null,
                onZoom: null,
                onZoomEnd: null
            };

            // User defined options
            for (i in options) that.options[i] = options[i];

            // Set starting position
            that.x = that.options.x;
            that.y = that.options.y;

            // Normalize options
            that.options.useTransform = hasTransform && that.options.useTransform;
            that.options.hScrollbar = that.options.hScroll && that.options.hScrollbar;
            that.options.vScrollbar = that.options.vScroll && that.options.vScrollbar;
            that.options.zoom = that.options.useTransform && that.options.zoom;
            that.options.useTransition = hasTransitionEnd && that.options.useTransition;

            // Helpers FIX ANDROID BUG!
            // translate3d and scale doesn't work together!
            // Ignoring 3d ONLY WHEN YOU SET that.options.zoom
            if ( that.options.zoom && isAndroid ){
                translateZ = '';
            }

            // Set some default styles
            that.scroller.style[transitionProperty] = that.options.useTransform ? cssVendor + 'transform' : 'top left';
            that.scroller.style[transitionDuration] = '0';
            that.scroller.style[transformOrigin] = '0 0';
            if (that.options.useTransition) that.scroller.style[transitionTimingFunction] = 'cubic-bezier(0.33,0.66,0.66,1)';

            if (that.options.useTransform) that.scroller.style[transform] = 'translate(' + that.x + 'px,' + that.y + 'px)' + translateZ;
            else that.scroller.style.cssText += ';position:absolute;top:' + that.y + 'px;left:' + that.x + 'px';

            if (that.options.useTransition) that.options.fixedScrollbar = true;

            that.refresh();

            that._bind(RESIZE_EV, window);
            that._bind(START_EV);
            if (!hasTouch) {
                if (that.options.wheelAction != 'none') {
                    that._bind('DOMMouseScroll');
                    that._bind('mousewheel');
                }
            }

            if (that.options.checkDOMChanges) that.checkDOMTime = setInterval(function () {
                that._checkDOMChanges();
            }, 500);
        };

// Prototype
    iScroll.prototype = {
        enabled: true,
        x: 0,
        y: 0,
        steps: [],
        scale: 1,
        currPageX: 0, currPageY: 0,
        pagesX: [], pagesY: [],
        aniTime: null,
        wheelZoomCount: 0,

        handleEvent: function (e) {
            var that = this;
            switch(e.type) {
                case START_EV:
                    if (!hasTouch && e.button !== 0) return;
                    that._start(e);
                    break;
                case MOVE_EV: that._move(e); break;
                case END_EV:
                case CANCEL_EV: that._end(e); break;
                case RESIZE_EV: that._resize(); break;
                case 'DOMMouseScroll': case 'mousewheel': that._wheel(e); break;
                case TRNEND_EV: that._transitionEnd(e); break;
            }
        },

        _checkDOMChanges: function () {
            if (this.moved || this.zoomed || this.animating ||
                (this.scrollerW == this.scroller.offsetWidth * this.scale && this.scrollerH == this.scroller.offsetHeight * this.scale)) return;

            this.refresh();
        },

        _scrollbar: function (dir) {
            var that = this,
                bar;

            if (!that[dir + 'Scrollbar']) {
                if (that[dir + 'ScrollbarWrapper']) {
                    if (hasTransform) that[dir + 'ScrollbarIndicator'].style[transform] = '';
                    that[dir + 'ScrollbarWrapper'].parentNode.removeChild(that[dir + 'ScrollbarWrapper']);
                    that[dir + 'ScrollbarWrapper'] = null;
                    that[dir + 'ScrollbarIndicator'] = null;
                }

                return;
            }

            if (!that[dir + 'ScrollbarWrapper']) {
                // Create the scrollbar wrapper
                bar = doc.createElement('div');

                if (that.options.scrollbarClass) bar.className = that.options.scrollbarClass + dir.toUpperCase();
                else bar.style.cssText = 'position:absolute;z-index:100;' + (dir == 'h' ? 'height:7px;bottom:1px;left:2px;right:' + (that.vScrollbar ? '7' : '2') + 'px' : 'width:7px;bottom:' + (that.hScrollbar ? '7' : '2') + 'px;top:2px;right:1px');

                bar.style.cssText += ';pointer-events:none;' + cssVendor + 'transition-property:opacity;' + cssVendor + 'transition-duration:' + (that.options.fadeScrollbar ? '350ms' : '0') + ';overflow:hidden;opacity:' + (that.options.hideScrollbar ? '0' : '1');

                that.wrapper.appendChild(bar);
                that[dir + 'ScrollbarWrapper'] = bar;

                // Create the scrollbar indicator
                bar = doc.createElement('div');
                if (!that.options.scrollbarClass) {
                    bar.style.cssText = 'position:absolute;z-index:100;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);' + cssVendor + 'background-clip:padding-box;' + cssVendor + 'box-sizing:border-box;' + (dir == 'h' ? 'height:100%' : 'width:100%') + ';' + cssVendor + 'border-radius:3px;border-radius:3px';
                }
                bar.style.cssText += ';pointer-events:none;' + cssVendor + 'transition-property:' + cssVendor + 'transform;' + cssVendor + 'transition-timing-function:cubic-bezier(0.33,0.66,0.66,1);' + cssVendor + 'transition-duration:0;' + cssVendor + 'transform: translate(0,0)' + translateZ;
                if (that.options.useTransition) bar.style.cssText += ';' + cssVendor + 'transition-timing-function:cubic-bezier(0.33,0.66,0.66,1)';

                that[dir + 'ScrollbarWrapper'].appendChild(bar);
                that[dir + 'ScrollbarIndicator'] = bar;
            }

            if (dir == 'h') {
                that.hScrollbarSize = that.hScrollbarWrapper.clientWidth;
                that.hScrollbarIndicatorSize = m.max(m.round(that.hScrollbarSize * that.hScrollbarSize / that.scrollerW), 8);
                that.hScrollbarIndicator.style.width = that.hScrollbarIndicatorSize + 'px';
                that.hScrollbarMaxScroll = that.hScrollbarSize - that.hScrollbarIndicatorSize;
                that.hScrollbarProp = that.hScrollbarMaxScroll / that.maxScrollX;
            } else {
                that.vScrollbarSize = that.vScrollbarWrapper.clientHeight;
                that.vScrollbarIndicatorSize = m.max(m.round(that.vScrollbarSize * that.vScrollbarSize / that.scrollerH), 8);
                that.vScrollbarIndicator.style.height = that.vScrollbarIndicatorSize + 'px';
                that.vScrollbarMaxScroll = that.vScrollbarSize - that.vScrollbarIndicatorSize;
                that.vScrollbarProp = that.vScrollbarMaxScroll / that.maxScrollY;
            }

            // Reset position
            that._scrollbarPos(dir, true);
        },

        _resize: function () {
            var that = this;
            setTimeout(function () { that.refresh(); }, isAndroid ? 200 : 0);
        },

        _pos: function (x, y) {
            if (this.zoomed) return;

            x = this.hScroll ? x : 0;
            y = this.vScroll ? y : 0;

            if (this.options.useTransform) {
                this.scroller.style[transform] = 'translate(' + x + 'px,' + y + 'px) scale(' + this.scale + ')' + translateZ;
            } else {
                x = m.round(x);
                y = m.round(y);
                this.scroller.style.left = x + 'px';
                this.scroller.style.top = y + 'px';
            }

            this.x = x;
            this.y = y;

            this._scrollbarPos('h');
            this._scrollbarPos('v');
        },

        _scrollbarPos: function (dir, hidden) {
            var that = this,
                pos = dir == 'h' ? that.x : that.y,
                size;

            if (!that[dir + 'Scrollbar']) return;

            pos = that[dir + 'ScrollbarProp'] * pos;

            if (pos < 0) {
                if (!that.options.fixedScrollbar) {
                    size = that[dir + 'ScrollbarIndicatorSize'] + m.round(pos * 3);
                    if (size < 8) size = 8;
                    that[dir + 'ScrollbarIndicator'].style[dir == 'h' ? 'width' : 'height'] = size + 'px';
                }
                pos = 0;
            } else if (pos > that[dir + 'ScrollbarMaxScroll']) {
                if (!that.options.fixedScrollbar) {
                    size = that[dir + 'ScrollbarIndicatorSize'] - m.round((pos - that[dir + 'ScrollbarMaxScroll']) * 3);
                    if (size < 8) size = 8;
                    that[dir + 'ScrollbarIndicator'].style[dir == 'h' ? 'width' : 'height'] = size + 'px';
                    pos = that[dir + 'ScrollbarMaxScroll'] + (that[dir + 'ScrollbarIndicatorSize'] - size);
                } else {
                    pos = that[dir + 'ScrollbarMaxScroll'];
                }
            }

            that[dir + 'ScrollbarWrapper'].style[transitionDelay] = '0';
            that[dir + 'ScrollbarWrapper'].style.opacity = hidden && that.options.hideScrollbar ? '0' : '1';
            that[dir + 'ScrollbarIndicator'].style[transform] = 'translate(' + (dir == 'h' ? pos + 'px,0)' : '0,' + pos + 'px)') + translateZ;
        },

        _start: function (e) {
            var that = this,
                point = hasTouch ? e.touches[0] : e,
                matrix, x, y,
                c1, c2;

            if (!that.enabled) return;

            if (that.options.onBeforeScrollStart) that.options.onBeforeScrollStart.call(that, e);

            if (that.options.useTransition || that.options.zoom) that._transitionTime(0);

            that.moved = false;
            that.animating = false;
            that.zoomed = false;
            that.distX = 0;
            that.distY = 0;
            that.absDistX = 0;
            that.absDistY = 0;
            that.dirX = 0;
            that.dirY = 0;

            // Gesture start
            if (that.options.zoom && hasTouch && e.touches.length > 1) {
                c1 = m.abs(e.touches[0].pageX-e.touches[1].pageX);
                c2 = m.abs(e.touches[0].pageY-e.touches[1].pageY);
                that.touchesDistStart = m.sqrt(c1 * c1 + c2 * c2);

                that.originX = m.abs(e.touches[0].pageX + e.touches[1].pageX - that.wrapperOffsetLeft * 2) / 2 - that.x;
                that.originY = m.abs(e.touches[0].pageY + e.touches[1].pageY - that.wrapperOffsetTop * 2) / 2 - that.y;

                if (that.options.onZoomStart) that.options.onZoomStart.call(that, e);
            }

            if (that.options.momentum) {
                if (that.options.useTransform) {
                    // Very lame general purpose alternative to CSSMatrix
                    matrix = getComputedStyle(that.scroller, null)[transform].replace(/[^0-9\-.,]/g, '').split(',');
                    x = +(matrix[12] || matrix[4]);
                    y = +(matrix[13] || matrix[5]);
                } else {
                    x = +getComputedStyle(that.scroller, null).left.replace(/[^0-9-]/g, '');
                    y = +getComputedStyle(that.scroller, null).top.replace(/[^0-9-]/g, '');
                }

                if (x != that.x || y != that.y) {
                    if (that.options.useTransition) that._unbind(TRNEND_EV);
                    else cancelFrame(that.aniTime);
                    that.steps = [];
                    that._pos(x, y);
                    if (that.options.onScrollEnd) that.options.onScrollEnd.call(that);
                }
            }

            that.absStartX = that.x;	// Needed by snap threshold
            that.absStartY = that.y;

            that.startX = that.x;
            that.startY = that.y;
            that.pointX = point.pageX;
            that.pointY = point.pageY;

            that.startTime = e.timeStamp || Date.now();

            if (that.options.onScrollStart) that.options.onScrollStart.call(that, e);

            that._bind(MOVE_EV, window);
            that._bind(END_EV, window);
            that._bind(CANCEL_EV, window);
        },

        _move: function (e) {
            var that = this,
                point = hasTouch ? e.touches[0] : e,
                deltaX = point.pageX - that.pointX,
                deltaY = point.pageY - that.pointY,
                newX = that.x + deltaX,
                newY = that.y + deltaY,
                c1, c2, scale,
                timestamp = e.timeStamp || Date.now();

            if (that.options.onBeforeScrollMove) that.options.onBeforeScrollMove.call(that, e);

            // Zoom
            if (that.options.zoom && hasTouch && e.touches.length > 1) {
                c1 = m.abs(e.touches[0].pageX - e.touches[1].pageX);
                c2 = m.abs(e.touches[0].pageY - e.touches[1].pageY);
                that.touchesDist = m.sqrt(c1*c1+c2*c2);

                that.zoomed = true;

                scale = 1 / that.touchesDistStart * that.touchesDist * this.scale;

                if (scale < that.options.zoomMin) scale = 0.5 * that.options.zoomMin * Math.pow(2.0, scale / that.options.zoomMin);
                else if (scale > that.options.zoomMax) scale = 2.0 * that.options.zoomMax * Math.pow(0.5, that.options.zoomMax / scale);

                that.lastScale = scale / this.scale;

                newX = this.originX - this.originX * that.lastScale + this.x;
                newY = this.originY - this.originY * that.lastScale + this.y;

                this.scroller.style[transform] = 'translate(' + newX + 'px,' + newY + 'px) scale(' + scale + ')' + translateZ;

                if (that.options.onZoom) that.options.onZoom.call(that, e);
                return;
            }

            that.pointX = point.pageX;
            that.pointY = point.pageY;

            // Slow down if outside of the boundaries
            if (newX > 0 || newX < that.maxScrollX) {
                newX = that.options.bounce ? that.x + (deltaX / 2) : newX >= 0 || that.maxScrollX >= 0 ? 0 : that.maxScrollX;
            }
            if (newY > that.minScrollY || newY < that.maxScrollY) {
                newY = that.options.bounce ? that.y + (deltaY / 2) : newY >= that.minScrollY || that.maxScrollY >= 0 ? that.minScrollY : that.maxScrollY;
            }

            that.distX += deltaX;
            that.distY += deltaY;
            that.absDistX = m.abs(that.distX);
            that.absDistY = m.abs(that.distY);

            if (that.absDistX < 6 && that.absDistY < 6) {
                return;
            }

            // Lock direction
            if (that.options.lockDirection) {
                if (that.absDistX > that.absDistY + 5) {
                    newY = that.y;
                    deltaY = 0;
                } else if (that.absDistY > that.absDistX + 5) {
                    newX = that.x;
                    deltaX = 0;
                }
            }

            that.moved = true;
            that._pos(newX, newY);
            that.dirX = deltaX > 0 ? -1 : deltaX < 0 ? 1 : 0;
            that.dirY = deltaY > 0 ? -1 : deltaY < 0 ? 1 : 0;

            if (timestamp - that.startTime > 300) {
                that.startTime = timestamp;
                that.startX = that.x;
                that.startY = that.y;
            }

            if (that.options.onScrollMove) that.options.onScrollMove.call(that, e);
        },

        _end: function (e) {
            if (hasTouch && e.touches.length !== 0) return;

            var that = this,
                point = hasTouch ? e.changedTouches[0] : e,
                target, ev,
                momentumX = { dist:0, time:0 },
                momentumY = { dist:0, time:0 },
                duration = (e.timeStamp || Date.now()) - that.startTime,
                newPosX = that.x,
                newPosY = that.y,
                distX, distY,
                newDuration,
                snap,
                scale;

            that._unbind(MOVE_EV, window);
            that._unbind(END_EV, window);
            that._unbind(CANCEL_EV, window);

            if (that.options.onBeforeScrollEnd) that.options.onBeforeScrollEnd.call(that, e);

            if (that.zoomed) {
                scale = that.scale * that.lastScale;
                scale = Math.max(that.options.zoomMin, scale);
                scale = Math.min(that.options.zoomMax, scale);
                that.lastScale = scale / that.scale;
                that.scale = scale;

                that.x = that.originX - that.originX * that.lastScale + that.x;
                that.y = that.originY - that.originY * that.lastScale + that.y;

                that.scroller.style[transitionDuration] = '200ms';
                that.scroller.style[transform] = 'translate(' + that.x + 'px,' + that.y + 'px) scale(' + that.scale + ')' + translateZ;

                that.zoomed = false;
                that.refresh();

                if (that.options.onZoomEnd) that.options.onZoomEnd.call(that, e);
                return;
            }

            if (!that.moved) {
                if (hasTouch) {
                    if (that.doubleTapTimer && that.options.zoom) {
                        // Double tapped
                        clearTimeout(that.doubleTapTimer);
                        that.doubleTapTimer = null;
                        if (that.options.onZoomStart) that.options.onZoomStart.call(that, e);
                        that.zoom(that.pointX, that.pointY, that.scale == 1 ? that.options.doubleTapZoom : 1);
                        if (that.options.onZoomEnd) {
                            setTimeout(function() {
                                that.options.onZoomEnd.call(that, e);
                            }, 200); // 200 is default zoom duration
                        }
                    } else if (this.options.handleClick) {
                        that.doubleTapTimer = setTimeout(function () {
                            that.doubleTapTimer = null;

                            // Find the last touched element
                            target = point.target;
                            while (target.nodeType != 1) target = target.parentNode;

                            if (target.tagName != 'SELECT' && target.tagName != 'INPUT' && target.tagName != 'TEXTAREA') {
                                ev = doc.createEvent('MouseEvents');
                                ev.initMouseEvent('click', true, true, e.view, 1,
                                    point.screenX, point.screenY, point.clientX, point.clientY,
                                    e.ctrlKey, e.altKey, e.shiftKey, e.metaKey,
                                    0, null);
                                ev._fake = true;
                                target.dispatchEvent(ev);
                            }
                        }, that.options.zoom ? 250 : 0);
                    }
                }

                that._resetPos(400);

                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }

            if (duration < 300 && that.options.momentum) {
                momentumX = newPosX ? that._momentum(newPosX - that.startX, duration, -that.x, that.scrollerW - that.wrapperW + that.x, that.options.bounce ? that.wrapperW : 0) : momentumX;
                momentumY = newPosY ? that._momentum(newPosY - that.startY, duration, -that.y, (that.maxScrollY < 0 ? that.scrollerH - that.wrapperH + that.y - that.minScrollY : 0), that.options.bounce ? that.wrapperH : 0) : momentumY;

                newPosX = that.x + momentumX.dist;
                newPosY = that.y + momentumY.dist;

                if ((that.x > 0 && newPosX > 0) || (that.x < that.maxScrollX && newPosX < that.maxScrollX)) momentumX = { dist:0, time:0 };
                if ((that.y > that.minScrollY && newPosY > that.minScrollY) || (that.y < that.maxScrollY && newPosY < that.maxScrollY)) momentumY = { dist:0, time:0 };
            }

            if (momentumX.dist || momentumY.dist) {
                newDuration = m.max(m.max(momentumX.time, momentumY.time), 10);

                // Do we need to snap?
                if (that.options.snap) {
                    distX = newPosX - that.absStartX;
                    distY = newPosY - that.absStartY;
                    if (m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold) { that.scrollTo(that.absStartX, that.absStartY, 200); }
                    else {
                        snap = that._snap(newPosX, newPosY);
                        newPosX = snap.x;
                        newPosY = snap.y;
                        newDuration = m.max(snap.time, newDuration);
                    }
                }

                that.scrollTo(m.round(newPosX), m.round(newPosY), newDuration);

                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }

            // Do we need to snap?
            if (that.options.snap) {
                distX = newPosX - that.absStartX;
                distY = newPosY - that.absStartY;
                if (m.abs(distX) < that.options.snapThreshold && m.abs(distY) < that.options.snapThreshold) that.scrollTo(that.absStartX, that.absStartY, 200);
                else {
                    snap = that._snap(that.x, that.y);
                    if (snap.x != that.x || snap.y != that.y) that.scrollTo(snap.x, snap.y, snap.time);
                }

                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }

            that._resetPos(200);
            if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
        },

        _resetPos: function (time) {
            var that = this,
                resetX = that.x >= 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x,
                resetY = that.y >= that.minScrollY || that.maxScrollY > 0 ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;

            if (resetX == that.x && resetY == that.y) {
                if (that.moved) {
                    that.moved = false;
                    if (that.options.onScrollEnd) that.options.onScrollEnd.call(that);		// Execute custom code on scroll end
                }

                if (that.hScrollbar && that.options.hideScrollbar) {
                    if (vendor == 'webkit') that.hScrollbarWrapper.style[transitionDelay] = '300ms';
                    that.hScrollbarWrapper.style.opacity = '0';
                }
                if (that.vScrollbar && that.options.hideScrollbar) {
                    if (vendor == 'webkit') that.vScrollbarWrapper.style[transitionDelay] = '300ms';
                    that.vScrollbarWrapper.style.opacity = '0';
                }

                return;
            }

            that.scrollTo(resetX, resetY, time || 0);
        },

        _wheel: function (e) {
            var that = this,
                wheelDeltaX, wheelDeltaY,
                deltaX, deltaY,
                deltaScale;

            if ('wheelDeltaX' in e) {
                wheelDeltaX = e.wheelDeltaX / 12;
                wheelDeltaY = e.wheelDeltaY / 12;
            } else if('wheelDelta' in e) {
                wheelDeltaX = wheelDeltaY = e.wheelDelta / 12;
            } else if ('detail' in e) {
                wheelDeltaX = wheelDeltaY = -e.detail * 3;
            } else {
                return;
            }

            if (that.options.wheelAction == 'zoom') {
                deltaScale = that.scale * Math.pow(2, 1/3 * (wheelDeltaY ? wheelDeltaY / Math.abs(wheelDeltaY) : 0));
                if (deltaScale < that.options.zoomMin) deltaScale = that.options.zoomMin;
                if (deltaScale > that.options.zoomMax) deltaScale = that.options.zoomMax;

                if (deltaScale != that.scale) {
                    if (!that.wheelZoomCount && that.options.onZoomStart) that.options.onZoomStart.call(that, e);
                    that.wheelZoomCount++;

                    that.zoom(e.pageX, e.pageY, deltaScale, 400);

                    setTimeout(function() {
                        that.wheelZoomCount--;
                        if (!that.wheelZoomCount && that.options.onZoomEnd) that.options.onZoomEnd.call(that, e);
                    }, 400);
                }

                return;
            }

            deltaX = that.x + wheelDeltaX;
            deltaY = that.y + wheelDeltaY;

            if (deltaX > 0) deltaX = 0;
            else if (deltaX < that.maxScrollX) deltaX = that.maxScrollX;

            if (deltaY > that.minScrollY) deltaY = that.minScrollY;
            else if (deltaY < that.maxScrollY) deltaY = that.maxScrollY;

            if (that.maxScrollY < 0) {
                that.scrollTo(deltaX, deltaY, 0);
            }
        },

        _transitionEnd: function (e) {
            var that = this;

            if (e.target != that.scroller) return;

            that._unbind(TRNEND_EV);

            that._startAni();
        },


        /**
         *
         * Utilities
         *
         */
        _startAni: function () {
            var that = this,
                startX = that.x, startY = that.y,
                startTime = Date.now(),
                step, easeOut,
                animate;

            if (that.animating) return;

            if (!that.steps.length) {
                that._resetPos(400);
                return;
            }

            step = that.steps.shift();

            if (step.x == startX && step.y == startY) step.time = 0;

            that.animating = true;
            that.moved = true;

            if (that.options.useTransition) {
                that._transitionTime(step.time);
                that._pos(step.x, step.y);
                that.animating = false;
                if (step.time) that._bind(TRNEND_EV);
                else that._resetPos(0);
                return;
            }

            animate = function () {
                var now = Date.now(),
                    newX, newY;

                if (now >= startTime + step.time) {
                    that._pos(step.x, step.y);
                    that.animating = false;
                    if (that.options.onAnimationEnd) that.options.onAnimationEnd.call(that);			// Execute custom code on animation end
                    that._startAni();
                    return;
                }

                now = (now - startTime) / step.time - 1;
                easeOut = m.sqrt(1 - now * now);
                newX = (step.x - startX) * easeOut + startX;
                newY = (step.y - startY) * easeOut + startY;
                that._pos(newX, newY);
                if (that.animating) that.aniTime = nextFrame(animate);
            };

            animate();
        },

        _transitionTime: function (time) {
            time += 'ms';
            this.scroller.style[transitionDuration] = time;
            if (this.hScrollbar) this.hScrollbarIndicator.style[transitionDuration] = time;
            if (this.vScrollbar) this.vScrollbarIndicator.style[transitionDuration] = time;
        },

        _momentum: function (dist, time, maxDistUpper, maxDistLower, size) {
            var deceleration = 0.0006,
                speed = m.abs(dist) / time,
                newDist = (speed * speed) / (2 * deceleration),
                newTime = 0, outsideDist = 0;

            // Proportinally reduce speed if we are outside of the boundaries
            if (dist > 0 && newDist > maxDistUpper) {
                outsideDist = size / (6 / (newDist / speed * deceleration));
                maxDistUpper = maxDistUpper + outsideDist;
                speed = speed * maxDistUpper / newDist;
                newDist = maxDistUpper;
            } else if (dist < 0 && newDist > maxDistLower) {
                outsideDist = size / (6 / (newDist / speed * deceleration));
                maxDistLower = maxDistLower + outsideDist;
                speed = speed * maxDistLower / newDist;
                newDist = maxDistLower;
            }

            newDist = newDist * (dist < 0 ? -1 : 1);
            newTime = speed / deceleration;

            return { dist: newDist, time: m.round(newTime) };
        },

        _offset: function (el) {
            var left = -el.offsetLeft,
                top = -el.offsetTop;

            while (el = el.offsetParent) {
                left -= el.offsetLeft;
                top -= el.offsetTop;
            }

            if (el != this.wrapper) {
                left *= this.scale;
                top *= this.scale;
            }

            return { left: left, top: top };
        },

        _snap: function (x, y) {
            var that = this,
                i, l,
                page, time,
                sizeX, sizeY;

            // Check page X
            page = that.pagesX.length - 1;
            for (i=0, l=that.pagesX.length; i<l; i++) {
                if (x >= that.pagesX[i]) {
                    page = i;
                    break;
                }
            }
            if (page == that.currPageX && page > 0 && that.dirX < 0) page--;
            x = that.pagesX[page];
            sizeX = m.abs(x - that.pagesX[that.currPageX]);
            sizeX = sizeX ? m.abs(that.x - x) / sizeX * 500 : 0;
            that.currPageX = page;

            // Check page Y
            page = that.pagesY.length-1;
            for (i=0; i<page; i++) {
                if (y >= that.pagesY[i]) {
                    page = i;
                    break;
                }
            }
            if (page == that.currPageY && page > 0 && that.dirY < 0) page--;
            y = that.pagesY[page];
            sizeY = m.abs(y - that.pagesY[that.currPageY]);
            sizeY = sizeY ? m.abs(that.y - y) / sizeY * 500 : 0;
            that.currPageY = page;

            // Snap with constant speed (proportional duration)
            time = m.round(m.max(sizeX, sizeY)) || 200;

            return { x: x, y: y, time: time };
        },

        _bind: function (type, el, bubble) {
            (el || this.scroller).addEventListener(type, this, !!bubble);
        },

        _unbind: function (type, el, bubble) {
            (el || this.scroller).removeEventListener(type, this, !!bubble);
        },


        /**
         *
         * Public methods
         *
         */
        destroy: function () {
            var that = this;

            that.scroller.style[transform] = '';

            // Remove the scrollbars
            that.hScrollbar = false;
            that.vScrollbar = false;
            that._scrollbar('h');
            that._scrollbar('v');

            // Remove the event listeners
            that._unbind(RESIZE_EV, window);
            that._unbind(START_EV);
            that._unbind(MOVE_EV, window);
            that._unbind(END_EV, window);
            that._unbind(CANCEL_EV, window);

            if (!that.options.hasTouch) {
                that._unbind('DOMMouseScroll');
                that._unbind('mousewheel');
            }

            if (that.options.useTransition) that._unbind(TRNEND_EV);

            if (that.options.checkDOMChanges) clearInterval(that.checkDOMTime);

            if (that.options.onDestroy) that.options.onDestroy.call(that);
        },

        refresh: function () {
            var that = this,
                offset,
                i, l,
                els,
                pos = 0,
                page = 0;

            if (that.scale < that.options.zoomMin) that.scale = that.options.zoomMin;
            that.wrapperW = that.wrapper.clientWidth || 1;
            that.wrapperH = that.wrapper.clientHeight || 1;

            that.minScrollY = -that.options.topOffset || 0;
            that.scrollerW = m.round(that.scroller.offsetWidth * that.scale);
            that.scrollerH = m.round((that.scroller.offsetHeight + that.minScrollY) * that.scale);
            that.maxScrollX = that.wrapperW - that.scrollerW;
            that.maxScrollY = that.wrapperH - that.scrollerH + that.minScrollY;
            that.dirX = 0;
            that.dirY = 0;

            if (that.options.onRefresh) that.options.onRefresh.call(that);

            that.hScroll = that.options.hScroll && that.maxScrollX < 0;
            that.vScroll = that.options.vScroll && (!that.options.bounceLock && !that.hScroll || that.scrollerH > that.wrapperH);

            that.hScrollbar = that.hScroll && that.options.hScrollbar;
            that.vScrollbar = that.vScroll && that.options.vScrollbar && that.scrollerH > that.wrapperH;

            offset = that._offset(that.wrapper);
            that.wrapperOffsetLeft = -offset.left;
            that.wrapperOffsetTop = -offset.top;

            // Prepare snap
            if (typeof that.options.snap == 'string') {
                that.pagesX = [];
                that.pagesY = [];
                els = that.scroller.querySelectorAll(that.options.snap);
                for (i=0, l=els.length; i<l; i++) {
                    pos = that._offset(els[i]);
                    pos.left += that.wrapperOffsetLeft;
                    pos.top += that.wrapperOffsetTop;
                    that.pagesX[i] = pos.left < that.maxScrollX ? that.maxScrollX : pos.left * that.scale;
                    that.pagesY[i] = pos.top < that.maxScrollY ? that.maxScrollY : pos.top * that.scale;
                }
            } else if (that.options.snap) {
                that.pagesX = [];
                while (pos >= that.maxScrollX) {
                    that.pagesX[page] = pos;
                    pos = pos - that.wrapperW;
                    page++;
                }
                if (that.maxScrollX%that.wrapperW) that.pagesX[that.pagesX.length] = that.maxScrollX - that.pagesX[that.pagesX.length-1] + that.pagesX[that.pagesX.length-1];

                pos = 0;
                page = 0;
                that.pagesY = [];
                while (pos >= that.maxScrollY) {
                    that.pagesY[page] = pos;
                    pos = pos - that.wrapperH;
                    page++;
                }
                if (that.maxScrollY%that.wrapperH) that.pagesY[that.pagesY.length] = that.maxScrollY - that.pagesY[that.pagesY.length-1] + that.pagesY[that.pagesY.length-1];
            }

            // Prepare the scrollbars
            that._scrollbar('h');
            that._scrollbar('v');

            if (!that.zoomed) {
                that.scroller.style[transitionDuration] = '0';
                that._resetPos(400);
            }
        },

        scrollTo: function (x, y, time, relative) {
            var that = this,
                step = x,
                i, l;

            that.stop();

            if (!step.length) step = [{ x: x, y: y, time: time, relative: relative }];

            for (i=0, l=step.length; i<l; i++) {
                if (step[i].relative) { step[i].x = that.x - step[i].x; step[i].y = that.y - step[i].y; }
                that.steps.push({ x: step[i].x, y: step[i].y, time: step[i].time || 0 });
            }

            that._startAni();
        },

        scrollToElement: function (el, time) {
            var that = this, pos;
            el = el.nodeType ? el : that.scroller.querySelector(el);
            if (!el) return;

            pos = that._offset(el);
            pos.left += that.wrapperOffsetLeft;
            pos.top += that.wrapperOffsetTop;

            pos.left = pos.left > 0 ? 0 : pos.left < that.maxScrollX ? that.maxScrollX : pos.left;
            pos.top = pos.top > that.minScrollY ? that.minScrollY : pos.top < that.maxScrollY ? that.maxScrollY : pos.top;
            time = time === undefined ? m.max(m.abs(pos.left)*2, m.abs(pos.top)*2) : time;

            that.scrollTo(pos.left, pos.top, time);
        },

        scrollToPage: function (pageX, pageY, time) {
            var that = this, x, y;

            time = time === undefined ? 400 : time;

            if (that.options.onScrollStart) that.options.onScrollStart.call(that);

            if (that.options.snap) {
                pageX = pageX == 'next' ? that.currPageX+1 : pageX == 'prev' ? that.currPageX-1 : pageX;
                pageY = pageY == 'next' ? that.currPageY+1 : pageY == 'prev' ? that.currPageY-1 : pageY;

                pageX = pageX < 0 ? 0 : pageX > that.pagesX.length-1 ? that.pagesX.length-1 : pageX;
                pageY = pageY < 0 ? 0 : pageY > that.pagesY.length-1 ? that.pagesY.length-1 : pageY;

                that.currPageX = pageX;
                that.currPageY = pageY;
                x = that.pagesX[pageX];
                y = that.pagesY[pageY];
            } else {
                x = -that.wrapperW * pageX;
                y = -that.wrapperH * pageY;
                if (x < that.maxScrollX) x = that.maxScrollX;
                if (y < that.maxScrollY) y = that.maxScrollY;
            }

            that.scrollTo(x, y, time);
        },

        disable: function () {
            this.stop();
            this._resetPos(0);
            this.enabled = false;

            // If disabled after touchstart we make sure that there are no left over events
            this._unbind(MOVE_EV, window);
            this._unbind(END_EV, window);
            this._unbind(CANCEL_EV, window);
        },

        enable: function () {
            this.enabled = true;
        },

        stop: function () {
            if (this.options.useTransition) this._unbind(TRNEND_EV);
            else cancelFrame(this.aniTime);
            this.steps = [];
            this.moved = false;
            this.animating = false;
        },

        zoom: function (x, y, scale, time) {
            var that = this,
                relScale = scale / that.scale;

            if (!that.options.useTransform) return;

            that.zoomed = true;
            time = time === undefined ? 200 : time;
            x = x - that.wrapperOffsetLeft - that.x;
            y = y - that.wrapperOffsetTop - that.y;
            that.x = x - x * relScale + that.x;
            that.y = y - y * relScale + that.y;

            that.scale = scale;
            that.refresh();

            that.x = that.x > 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x;
            that.y = that.y > that.minScrollY ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;

            that.scroller.style[transitionDuration] = time + 'ms';
            that.scroller.style[transform] = 'translate(' + that.x + 'px,' + that.y + 'px) scale(' + scale + ')' + translateZ;
            that.zoomed = false;
        },

        isReady: function () {
            return !this.moved && !this.zoomed && !this.animating;
        }
    };

    function prefixStyle (style) {
        if ( vendor === '' ) return style;

        style = style.charAt(0).toUpperCase() + style.substr(1);
        return vendor + style;
    }

    dummyStyle = null;	// for the sake of it

    if (typeof exports !== 'undefined') exports.iScroll = iScroll;
    else window.iScroll = iScroll;

})(window, document);

    var myScroll,
       // pullDownEl, pullDownOffset,
    pullUpEl, pullUpOffset,
    generatedCount = 0;
    var gCPage =1;
    var gTPages =0;
    var gEPages =2;

function getMoreIreitsPageInfo(){
    gTPages =(document.getElementById("i_totalPage").value) ;
    if(gCPage >=gTPages)
    {
        gCPage = gTPages;
    }
    else
    {
        var data ={};
        data.cPage = gCPage+1;
        gCPage = gCPage+1;
        data.ePage = gEPages;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ireits/getMoreInfo')?>",
            data: data,
            success: function (msg) {
                try{
                    obj =$.parseJSON(msg);
                    processIndData(obj);
                }
                catch (err){
                    return;
                }
            }
        });
    }
}
//回调信息处理
function processIndData(obj) {
    $.each(obj.items,function(i,item){
        $datas= '<li><a  href="' +"<?php echo site_url('ireits/detailPage').'/'?>"+item.i_id+'">'
        +'<div class="project">'
        +'<div class="img"><img  src="' + item.i_img +'" alt="" /></div>'
        +'<p class="tit">'+ item.i_tit + '</p>'
        +'<div class="rate">'
        +'<div style="width: '+ item.i_jin + ';"></div>'
        +'</div>'
        +'<div class="num">'
        +'<div class="jin" >'+ item.i_jin + '</div>'
        +'<div class="jiner" >'+item.i_jiner+'</div>'
        +'<div class="shouru">'+item.i_shouru+'</div>'
        +'<div class="qixian">'+ item.i_qixian +'</div>'
        +'</div>'
        +'<div class="what">'
        +'<div class="jin">进度</div>'
        +'<div class="jiner">筹款金额</div>'
        +'<div class="shouru">收益</div>'
        +'<div class="qixian">期限/月</div>'
        +'</div>'
        +'</div>'
        +'</a></li>';
        $("#ireitsList").append($datas);
    })

}

function pullUpAction () {
    setTimeout(function () {	// <-- Simulate network congestion, remove setTimeout from production!
        getMoreIreitsPageInfo();
        myScroll.refresh();// Remember to refresh when contents are loaded (ie: on ajax completion)
    }, 1000);	// <-- Simulate network congestion, remove setTimeout from production!
}
//function pullDownAction () {
//    setTimeout(function () {	// <-- Simulate network congestion, remove setTimeout from production!
//        gCPage =0;
//        document.getElementById("ireitsList").innerHTML ="";
//        getMoreIreitsPageInfo();
//        myScroll.refresh();		// Remember to refresh when contents are loaded (ie: on ajax completion)
//    }, 1000);	// <-- Simulate network congestion, remove setTimeout from production!
//}

function loaded() {
//    pullDownEl = document.getElementById('pullDown');
//    pullDownOffset = pullDownEl.offsetHeight;
    pullUpEl = document.getElementById('pullUp');
    pullUpOffset = pullUpEl.offsetHeight;


    myScroll = new iScroll('wrapper', {
        useTransition: true,
        //topOffset: pullDownOffset,
        onRefresh: function () {
//            if (pullDownEl.className.match('loading')) {
//                pullDownEl.className = '';
//                pullDownEl.querySelector('.pullDownLabel').innerHTML = '<img src="../../assets/images/loading.gif" alt="" style="display: block; width: 20%; margin: 0 auto;"/>';
//            } else
            if (pullUpEl.className.match('loading')) {
                pullUpEl.className = '';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '';
                //setTimeout('updatelabel()',3000);
            }
        },
        onScrollMove: function () {
//            if (this.y > 5 && !pullDownEl.className.match('flip')) {
//                pullDownEl.className = 'flip';
//                pullDownEl.querySelector('.pullDownLabel').innerHTML = '<img src="../../assets/images/loading.gif" alt="" style="display: block; width: 20%; margin: 0 auto;"/>';
//                this.minScrollY = 0;
//            } else if (this.y < 5 && pullDownEl.className.match('flip')) {
//                pullDownEl.className = '';
//                pullDownEl.querySelector('.pullDownLabel').innerHTML = '<img src="../../assets/images/loading.gif" alt="" style="display: block; width: 20%; margin: 0 auto;"/>';
//                this.minScrollY = -pullDownOffset;
//            } else
            if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
                pullUpEl.className = 'flip';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '<img src="../../assets/images/loading.gif" alt="" style="display: block; width: 20%; margin: 0 auto;"/>';
                this.maxScrollY = this.maxScrollY;
            } else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
                pullUpEl.className = '';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '<img src="../../assets/images/loading.gif" alt="" style="display: block; width: 20%; margin: 0 auto;"/>';
                this.maxScrollY = pullUpOffset;
            }
        },
        onScrollEnd: function () {
//            if (pullDownEl.className.match('flip')) {
//                pullDownEl.className = 'loading';
//                pullDownEl.querySelector('.pullDownLabel').innerHTML = '<img src="../../assets/images/loading.gif" alt="" style="display: block; width: 20%; margin: 0 auto;"/>';
//                pullDownAction();	// Execute custom function (ajax call?)
//            } else
            if (pullUpEl.className.match('flip')) {
                pullUpEl.className = 'loading';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '<img src="../../assets/images/loading.gif" alt="" style="display: block; width: 20%; margin: 0 auto;"/>';
                pullUpAction();	// Execute custom function (ajax call?)
            }
        }
    });

    setTimeout(function () { document.getElementById('wrapper').style.left = '0'; }, 800);
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);
</script>
<style type="text/css" media="all">
    body {
        padding:0;
        margin:0;
        border:0;
    }

    body {
        font-size:12px;
        -webkit-user-select:none;
        -webkit-text-size-adjust:none;
        font-family:helvetica;
    }

    /*#header {*/
        /*position:absolute; z-index:2;*/
        /*top:0; left:0;*/
        /*width:100%;*/
        /*height:45px;*/
        /*line-height:45px;*/
        /*background-color:#d51875;*/
        /*background-image:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0, #fe96c9), color-stop(0.05, #d51875), color-stop(1, #7b0a2e));*/
        /*background-image:-moz-linear-gradient(top, #fe96c9, #d51875 5%, #7b0a2e);*/
        /*background-image:-o-linear-gradient(top, #fe96c9, #d51875 5%, #7b0a2e);*/
        /*padding:0;*/
        /*color:#eee;*/
        /*font-size:20px;*/
        /*text-align:center;*/
    /*}*/

    /*#header a {*/
        /*color:#f3f3f3;*/
        /*text-decoration:none;*/
        /*font-weight:bold;*/
        /*text-shadow:0 -1px 0 rgba(0,0,0,0.5);*/
    /*}*/

    #wrapper {
        position:absolute; z-index:1;
        top:0px; bottom:50px; left:5px; right:5px;
        width:100%;
        /*background:#aaa;*/
        overflow:auto;
    }

    #scroller {
        position:absolute; z-index:1;
        /*	-webkit-touch-callout:none;*/
        -webkit-tap-highlight-color:rgba(0,0,0,0);
        width:100%;
        padding:0;
    }

    /*#scroller ul {*/
    /*list-style:none;*/
    /*padding:0;*/
    /*margin:0;*/
    /*width:100%;*/
    /*text-align:left;*/
    /*}*/

    /*#scroller li {*/
    /*padding:0 10px;*/
    /*height:40px;*/
    /*line-height:40px;*/
    /*border-bottom:1px solid #ccc;*/
    /*border-top:1px solid #fff;*/
    /*background-color:#fafafa;*/
    /*font-size:14px;*/
    /*}*/

    #myFrame {
        position:absolute;
        top:0; left:0;
    }



    /**
     *
     * Pull down styles
     *
     */
    /*#pullDown,*/


    #pullUp {
        background:#fff;
        height:50px;
        line-height:30px;
        padding:5px 10px;
        font-weight:bold;
        font-size:10px;
        color:#888;
    }
    .pullUpLabel{}
    /*#pullDown .pullDownIcon, #pullUp .pullUpIcon  {*/
        /*display:block; float:left;*/
        /*width:40px; height:40px;*/
        /*background:url(images/pull-icon@2x.png) 0 0 no-repeat;*/
        /*-webkit-background-size:40px 80px; background-size:40px 80px;*/
        /*-webkit-transition-property:-webkit-transform;*/
        /*-webkit-transition-duration:250ms;*/
    /*}*/
    /*#pullDown .pullDownIcon {*/
        /*-webkit-transform:rotate(0deg) translateZ(0);*/
    /*}*/
    #pullUp .pullUpIcon  {
        -webkit-transform:rotate(-180deg) translateZ(0);
    }

    /*#pullDown.flip .pullDownIcon {*/
        /*-webkit-transform:rotate(-180deg) translateZ(0);*/
    /*}*/

    #pullUp.flip .pullUpIcon {
        -webkit-transform:rotate(0deg) translateZ(0);
    }

    /*#pullDown.loading .pullDownIcon, #pullUp.loading .pullUpIcon {*/
        /*background-position:0 100%;*/
        /*-webkit-transform:rotate(0deg) translateZ(0);*/
        /*-webkit-transition-duration:0ms;*/

        /*-webkit-animation-name:loading;*/
        /*-webkit-animation-duration:2s;*/
        /*-webkit-animation-iteration-count:infinite;*/
        /*-webkit-animation-timing-function:linear;*/
    /*}*/

    @-webkit-keyframes loading {
        from { -webkit-transform:rotate(0deg) translateZ(0); }
        to { -webkit-transform:rotate(360deg) translateZ(0); }
    }

</style>
</html>
