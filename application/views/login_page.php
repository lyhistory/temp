<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<title>91投房</title>
<base href="<?=$this->config->item('base_url')?>assets/" />
<link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
<script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   <style>
           body{margin: 0; padding: 0;}
           div{font-family:"微软雅黑"; }
           p{margin: 0;}
           .yh-zhuce{width: 50%;margin: 0 auto;margin-top: 2em;margin-bottom: 2em;}
           .yh-neirong{ width: 90%; margin: 1em auto;margin-bottom: 2em;}
           .yh-neirong p{color:#888;}
           .yh-neirong input{display: block; border: 1px dotted #db2411; border-radius: 5px; height:30px;font-size: 20px;margin: 0 auto; margin-bottom: 1em;}
           .yh-neirong img{display: block;float: right; margin-top: 5px;}
           .yh-user{background: url("images/yh-users.png") no-repeat center left;  width:85%;}
           .yh-lock{background: url("images/yh-lock.png") no-repeat center left;  width:85%; }
           .denglu{display: block; width: 80%; height: 45px;background: #289fd1;text-decoration: none;color: #fff; border:none!important;margin: 0 auto;}
           .wangji{width: 80%;margin: 0 auto;overflow: hidden;}
           .wangji a{display: block; float: left;width: 50%;text-align: center; color: #289fd1;}

			
			input[validator="error"]::-webkit-input-placeholder { /* WebKit, Blink, Edge */color:    red;}
			input[validator="error"]:-moz-placeholder { /* Mozilla Firefox 4 to 18 */color:   red;  opacity:  1;}
			input[validator="error"]::-moz-placeholder { /* Mozilla Firefox 19+ */   color:    red;   opacity:  1;}
			input[validator="error"]:-ms-input-placeholder { /* Internet Explorer 10-11 */   color:    red;}
       </style>
       <script>
       $(function(){
           $(".yh-user").click(function(){
               $(".yh-user").prop("value","");
           });
       });
       </script>

</head>

<body>
<div class="header_91">
    <p class="title">用户登录</p>
</div>

<div class="yh-zhuce">
    <img width="100%" src="images/denglu-logo.png" alt=""/>
    <span style="color: gray;">领先的房地产证券化平台</span>
</div>
<div class="log_content">
<!--    <input type="hidden" id="redirect"  value ="--><?php //echo ?><!--">  // linwei - need to modify 0909 -->
    <form action ="<?php echo site_url("login").'/index/'.$destination;?>" method = "post" >
        <div class="yh-neirong">
            <input class="yh-user" name="username" value="" type="text" id="username"  placeholder="<?php if($status==-1) {echo "用户名不存在";} elseif($status==-100&&$username_error!=''){echo $username_error;}else{ echo "请输入用户名";} ?>"  style="padding-left: 40px; ime-mode:disabled;" validator="<?php if($status==-1||($status==-100&&$username_error!='')) {echo "error";}else{echo "";}?>"/>
            <input class="yh-lock" name="password" value="" type="password"  id="password" placeholder="<?php if($status==-2) {echo "密码错误";} elseif($status==-100&&$password_error!=''){echo $password_error;} else { echo "由6-16个数字+字母组成";} ?>" style="padding-left: 40px;" validator="<?php if($status==-2||($status==-100&&$password_error!='')) {echo "error";}else{echo "";}?>"/>
            <input class="denglu" type="submit"  value="登录">
        </div>
        <div class="wangji">
            <a style="margin:none!important;" href="<?php echo site_url('myaccount/getPassword') ?>">忘记密码</a>
            <a href="<?php echo site_url('register/phoneRegister') ?>">立即注册</a>
        </div>
    </form>
</div>



<!--<div id="dialog" title="信息">
    <p id="d_msg"> </p>
</div>-->

<!--<div class="footer_91"></div>-->
</body>
</html>
