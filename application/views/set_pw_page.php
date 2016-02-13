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
<div class="header_91">
    <p class="title">修改密码</p>
</div>


<div class="log_content">
    <form action ="<?php echo site_url("myaccount/resetPassword");?>" method = "post" >
        <p class=""></p>
        <div class="inputs">
            <span>原密码</span><input name="oldpassword" type="text" id="oldpassword"/>
        </div>
        <div class="inputs">
            <span>新密码</span><input name="newpassword" type="password" placeholder="不少于6个字，字母和数字组成"  id="newpassword"/>
        </div>
        <div class="inputs">
            <span>确认密码</span><input name="newpasswordcmf" type="password"  id="newpasswordcmf"/>
        </div>
        <div class="inputs">
            <span>验证码</span>
            <input name="verify" class="code" type="text"  id="verify"/><span onclick="get_captcha()" id="captcha-image"></span>
        </div>

        <?php echo validation_errors();?>
        <?php echo $errormsg?>


        <div class="account_content">
            <input type="submit" class="button tuichu" value="确认"/>
        </div>
    </form>

</div>

<div id="dialog" title="信息">
    <p id="d_msg"> </p>
</div>


<!--<div class="footer_91"></div>-->
</body>
</html>
