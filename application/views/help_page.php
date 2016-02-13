<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <title>91投房</title>
    <style>
        body{margin: 0; padding: 0;}
		a{text-decoration: none;}
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
        div{font-family:"微软雅黑"; }
        .bz-help{ text-align: center;font-size: 1.5em; color: #0099E9;}
        .bz-center{overflow: hidden;}
        .bz-center span{float: left; color: #2c2c2c;}
        .bz-juxing{display: block; height: 1em; width:0.2em; background:url("images/helps/bzjx.png") no-repeat;
            margin-right: 0.3em; margin-top: 0.25em; margin-left: 1em;}
        .btns{ width:90%; overflow: hidden; margin: 0 auto; margin-top: 1em;}

        .tp1{background: url("images/helps/bz-1.png");background-size: 100%;}
        .tp2{background: url("images/helps/bz-2.png");background-size: 100%;}
        .tp3{background: url("images/helps/bz-3.png");background-size: 100%;}
        .tp4{background: url("images/helps/bz-4.png");background-size: 100%;}
        .tp5{background: url("images/helps/bz-5.png");background-size: 100%;}
        .tp6{background: url("images/helps/bz-6.png");background-size: 100%;}
        .tp7{background: url("images/helps/bz-7.png");background-size: 100%;}
        .tp8{background: url("images/helps/bz-8.png");background-size: 100%;}
		.frame{width:100%; height:650px;}
		.block1{width:90%;  margin:0 auto; margin-top:20px;}
		.block_bg{width:100%; height:55px; background:#FFF; border:0px solid #000; border-radius:10px;box-shadow:1px 4px 0px 0px rgba(160,160,160,.2);}
		.block_title{ float:left;width:100px; margin-left:20px; height:55px;line-height:55px;}
    </style>
    <title>bangzhu</title>
</head>
<body style="background:#F8F8F8;">
<div class="bz-help">帮&nbsp;助&nbsp;中&nbsp;心</div>
<hr color="#0099E9">
<?php /*?>
<div class="bz-center"><span class="bz-juxing"></span><span>帮助中心</span></div>
<div class="btns">
    <a class="btn1" href="<?php echo site_url('helps/saftyControl') ?>"><i class="tp1"></i><span class="wz">安全保障</span></a>
    <a class="btn2" href="<?php echo site_url('register/phoneRegister') ?>"><i class="tp2"></i><span class="wz">注册/认证</span></a>
    <a class="btn3" href="<?php echo site_url('helps/ourpartner') ?>"><i class="tp3"></i><span class="wz">合作伙伴</span></a>
    <a class="btn4" href="<?php echo site_url('helps/ourteam') ?>"><i class="tp4"></i><span class="wz">我们的团队</span></a>
    <a class="btn5" href="<?php echo site_url('helps/contactus') ?>"><i class="tp5"></i><span class="wz">联系我们</span></a>
    <a class="btn6" href="<?php echo site_url('myaccount/passwordControl') ?>"><i class="tp6"></i><span class="wz">密码管理</span></a>
    <a class="btn7" href="<?php echo site_url('helps/showmedia') ?>"><i class="tp7"></i><span class="wz">媒体报道</span></a>
    <a class="btn8" href="<?php echo site_url('helps/showquestion') ?>"><i class="tp8"></i><span class="wz">常见问题</span></a>
</div><?php */?>

<div class="frame">
	<div class="block1">
    	<div class="block_bg" onclick="location.href='<?php echo site_url('helps/saftyControl')?>'">
        	<img src="images/helps/bzzx_1.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">安全保障</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>

	<div class="block1">
    	<div class="block_bg" onclick="location.href='<?php echo site_url('register/phoneRegister') ?>'">
        	<img src="images/helps/bzzx_2.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">注册/认证</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>
    
    <div style="width:90%;  margin:0 auto; margin-top:40px;">
    	<div class="block_bg" onclick="location.href='<?php echo site_url('helps/ourpartner') ?>'">
        	<img src="images/helps/bzzx_3.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">合作伙伴</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>
    <div style="width:90%;  margin:0 auto; margin-top:1px;">
    	<div class="block_bg" onclick="location.href='<?php echo site_url('helps/ourteam') ?>'">
        	<img src="images/helps/bzzx_4.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">我们团队</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>
    <div style="width:90%;  margin:0 auto; margin-top:1px;">
    	<div class="block_bg" onclick="location.href='<?php echo site_url('helps/contactus') ?>'">
        	<img src="images/helps/bzzx_5.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">联系我们</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>
    
    <div style="width:90%;  margin:0 auto; margin-top:40px;">
    	<div  class="block_bg" onclick="location.href='<?php echo site_url('myaccount/passwordControl') ?>'">
        	<img src="images/helps/bzzx_6.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">密码管理</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>
    <div style="width:90%;  margin:0 auto; margin-top:1px;">
    	<div class="block_bg" onclick="location.href='<?php echo site_url('helps/showmedia') ?>'">
        	<img src="images/helps/bzzx_7.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">媒体报道</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>
    <div style="width:90%;  margin:0 auto; margin-top:1px;">
    	<div class="block_bg" onclick="location.href='<?php echo site_url('helps/showquestion') ?>'">
        	<img src="images/helps/bzzx_8.png" style="margin-top:10px; margin-left:15px; float:left;" width="10%" />
           	<span class="block_title">常见问题</span>
            <img src="images/helps/jiantou.png" style="margin-top:18px; margin-right:15px; float:right;" width="3%" />
        </div>
    </div>
    
</div>


</body>
</html>

