<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<base href="<?=$this->config->item('base_url')?>assets/" />
<title>我的账户</title>
<link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
<script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript">
    function get_captcha() {
        $.get("<?php echo site_url('register/newCaptcha');?>", function(data){
            $('#captcha-image').html(data);
        });
    };
    $(function(){
        get_captcha();
    })
</script>
</head>

<body>
<div class="header_two">
    <a href="<?php echo site_url('register/phoneRegister') ?>" class="sel">手机注册</a>
    <a href="<?php echo site_url('register/mailRegister') ?>" >普通注册</a>
</div>

<div class="log_content">

    <form action ="<?php echo site_url("register/mailRegister");?>" method = "post" >
        <div class="inputs">
            <span>邮&emsp;箱</span><input name="email" value="<?=$email?>" type="text"  id="email"/>
        </div>
        <div class="inputs">
            <span>用户名</span><input name="username"  value="<?=$username?>" type="text" id="username" />
        </div>
        <div class="inputs">
            <span>密&emsp;码</span><input name="password" type="password"   id="password" placeholder="不少于6个字，字母和数字组成"/>
        </div>
        <div class="inputs">
            <span>验证码</span>
            <input class="code" type="" value="<?=$verify?>" name ="verify" id="verify"/><span onclick="get_captcha()" id="captcha-image"></span>
        </div>
        <div class="reds">
            <input name="checkbox" style="" type="checkbox" id="checkboxid"/><span>我已阅读并同意<a href="">《隐私条款》</a></span>
        </div>

        <?php echo validation_errors();?>
        <?php echo $errormsg?>

        <div class="account_content">
            <input   type="submit" class="button tuichu" value="立即注册">
        </div>

    </form>

</div>


<div id="dialog" title="信息">
    <p id="d_msg"> </p>
</div>

<!--<div class="footer_91"></div>-->
</body>
</html>