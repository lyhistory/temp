<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
       <title>91投房</title>

    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript">

        var inWaiting =false;
        var endtime = 60;
        var now =0;

        function isValid(type ){
            var username = document.getElementById("username").value;
            var phonenum = document.getElementById("phonenum").value;
            var pwd = document.getElementById("password").value;
            var verify = document.getElementById("verify").value;


            if (username == "" ||  phonenum=="" ){
                return 0;
            }
//            else if (parseInt(pwd.length) <6){
//                return -1;
//            }
            return 1;
        }
        function ValidateNumber(e, pnumber)
        {
            if (!/^\d+[.]?\d*$/.test(pnumber))
            {
                e.value = /^\d+[.]?\d*/.exec(e.value);
            }
            return false;
        }
        function daoJiShi()
        {
            now+=1;
            var ofs= endtime -now;
            document.getElementById('getcode').innerHTML=ofs+ ' 秒';
            if(ofs<0){document.getElementById('getcode').innerHTML="<img src='images/yh-yanzheng.png' alt=''/>";
                inWaiting =false;
                return;
            };
            setTimeout('daoJiShi()',1000);
        }
        function sendverifycode() {
            $('#verify-status').html("");
            var res = isValid();
            if(res ==1 && inWaiting ==false) {
                inWaiting = true;
                var data={};
                data.username =  document.getElementById("username").value;
                data.phonenum = document.getElementById("phonenum").value;
                data.password =  document.getElementById("password").value;

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('register/sendVerifyCode')?>",
                    data: data,
                    success: function (data){
                        data=jQuery.parseJSON(data);

                        if(data.errormsg.indexOf("已发送")>0) {
                            daoJiShi();
                        }
                        inWaiting =false;
                        
                        if(data!=null){
                            if(data.status=="-4"){
                                $("#smsverify").attr('placeholder',data.errormsg);
                                $("#smsverify").attr('validator',"error");
                            }else if(data.status<=0){
                                $('#verify-status').html(data.errormsg);
                            }
                        }
                    }
                });
            }
            else if(res ==-1){
                $('#verify-status').html("密码格式不正确");
            }else if (res ==0){
                $('#verify-status').html("用户名或密码或号码不能为空");
            }
        };
        function get_captcha() {
            $.get("<?php echo site_url('register/newCaptcha');?>", function(data){
                $('#captcha-image').html(data);
            });
        };
        $(function(){
            get_captcha();

        });

        window.onload= initAjaxListener;
        function initAjaxListener(){
            $('#username').on('change',function() {
                var par= {};
                par.username= $('#username').val();
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('register/checkUsernameExist')?>",
                    data: par,
                }).done(function (data) {
                    if(data == 1){
                        $('#verify-status').html("此用户名已经存在");
                    }else{
                        $('#verify-status').html("");
                    }
            });
            });
            $('#phonenum').on('change',function() {
                var par= {};
                par.phonenum= $('#phonenum').val();
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('register/checkPhoneExist')?>",
                    data: par
                }).done(function (data) {
                    if(data == 1){
                        $('#verify-status').html("此电话号码已经存在");
                    }else{
                        $('#verify-status').html("");
                    }
                });
            });
            $('#verify').on('change',function() {
                var par= {};
                par.verify= $('#verify').val();
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('register/checkVerifyCode')?>",
                    data:par
                }).done(function (data) {
                    if(data == 1){
                        $('#verify-status').html("");
                    }else{
                        $('#verify-status').html("图形验证码不正确");
                    }
                });
            });
        };
    </script>
    <style>
        body{margin: 0; padding: 0;}
        div{font-family:"微软雅黑"; }
        p{margin: 0;}
        .yh{ text-align: center;font-size: 1.5em; color: #5095b6;}
        .yh-zhuce{width: 100%;}
        .yh-zhuce img{width: 100%}
        .yh-neirong{ width: 90%; margin: 0 auto; margin-top: 1em;}
        .yh-neirong p{color:#888;}
        .yh-neirong input{border: 1px dotted #db2411; border-radius: 5px; height:30px;font-size: 20px;margin-bottom: 13px;}
        .yh-neirong img{display: block;float: right; margin-top: 5px;}
        .yh-phone{background: url("images/yh-iphone.png") no-repeat center left;  width:85%;}
        .yh-user{background: url("images/yh-users.png") no-repeat center left;  width:85%;}
        .yh-lock{background: url("images/yh-lock.png") no-repeat center left;  width:85%; }
        .yh-txynzheng{ width: 50%;}
        .yh-huoqu{width: 100%;}
        .yh-huoqu input{width: 50%;}
        .yh-huoqu div{width: 7em;float: right; }
        .yh-huoqu div img{max-width: 100%;}
        .yh-tuijian{ width: 100%;}
        .yh-tuijian span{ padding-right: .9em;}
        .yh-tuijian input{width: 70%;}
        footer input{display: block; width: 100%; height: 45px;background: #0ac;text-decoration: none;color: #fff; border:none!important;}
        input[validator="error"]::-webkit-input-placeholder { /* WebKit, Blink, Edge */color:    red;}
		input[validator="error"]:-moz-placeholder { /* Mozilla Firefox 4 to 18 */color:   red;  opacity:  1;}
		input[validator="error"]::-moz-placeholder { /* Mozilla Firefox 19+ */   color:    red;   opacity:  1;}
		input[validator="error"]:-ms-input-placeholder { /* Internet Explorer 10-11 */   color:    red;}
    </style>
    </head>
    <body>
    <div class="yh-zhuce"><img src="images/yh-banner.jpg" alt=""/></div>
    <div class="yh-neirong">
        <form action ="<?php echo site_url("register/phoneRegister");?>" method = "post" >
            <input class="yh-user" name="username" value="<?=$username?>" type="text" id="username"  
                placeholder="<?php if($status==-1) {echo $errormsg;} elseif($status==-100&&$username_error!=''){echo $username_error;}else{echo "请输入用户名";} ?>"  
                validator="<?php if($status==-1||($status==-100&&$username_error!='')) {echo "error";}else{echo "";}?>"
                style="padding-left: 40px; ime-mode:disabled "/>
            <input class="yh-phone" name="phonenum" value="<?=$phonenum?>" type="number" id="phonenum"  
                placeholder="<?php if($status==-4) {echo $errormsg;} elseif($status==-100&&$phonenum_error!=''){echo $phonenum_error;}else{echo "请输入手机号";} ?>" 
                onkeyup="return ValidateNumber(this,value)" style="padding-left: 40px; ime-mode:disabled" 
                validator="<?php if($status==-4||($status==-100&&$phonenum_error!='')) {echo "error";}else{echo "";}?>"
                />
            <input class="yh-lock" name="password" value="<?=$password?>"  type="password"  id="password" 
                placeholder="<?php if($status==-2) {echo $errormsg;} elseif($status==-100&&$password_error!=''){echo $password_error;}else{echo "由6-16个数字+字母组成";} ?>" 
                style="padding-left: 40px; "
                validator="<?php if($status==-2||($status==-100&&$password_error!='')) {echo "error";}else{echo "";}?>"
                />
            <input class="yh-txynzheng" name="verify"  type="number" value="<?=$verify?>" id ="verify" 
                placeholder="<?php if($status==-100&&$verify_error!=''){echo $verify_error;}else{echo "输入图形验证码";} ?>"
                style="padding-left: 5px;"
                validator="<?php if($status==-100&&$verify_error!='') {echo "error";}else{echo "";}?>"  
                />

           <span onclick="get_captcha()" id="captcha-image"></span>
            <div class="yh-huoqu">
                <input name="smsverify" class="code" type="number" value="<?=$smsverify?>" id ="smsverify"
                       placeholder="<?php if($status==-5) {echo $errormsg;} elseif($status==-100&&$smsverify_error!=''){echo $smsverify_error;}else{echo "输入短信码";} ?>"
                       validator="<?php if($status==-5||($status==-100&&$smsverify_error!='')) {echo "error";}else{echo "";}?>"  
                />
                <div><a onclick="sendverifycode()" id="getcode"><img src="images/yh-yanzheng.png" alt=""/></a></div>
            </div>
            <div class="yh-tuijian">
                <span>推荐人</span>
                <input id ="invite_username" name ="invite_username" type="text" value="<?=$invite_username?>"
                       placeholder="<?php if($status==-6) {echo $errormsg;} else{echo "非必填";} ?>"
                       validator="<?php if($status==-6) {echo "error";} else{echo "";}?>"  
                />
            </div>
            <div style="overflow: hidden;">
                <input name="checkbox" type="checkbox" id="checkboxid" style="display: block;float: left;height: 12px;"/>
                <label style="display: block;float: left; margin-left: 5px; ">我已经阅读并同意</label>
                <a href="" style="text-decoration: none;display:block; float: left; margin-left: 10px;">隐私条款</a>
            </div>
            <span id="verify-status" style='color:red;'><?php if($status==0){echo $errormsg;} if($status==-100&&$checkbox_error!=""){echo $checkbox_error;}?></span>
                
         
            <footer>
                <input type="submit"  value="立即注册">
            </footer>
        </form>
    </div>


    <div id="dialog" title="信息">
        <p id="d_msg"> </p>
    </div>

	<!--<div class="footer_91"></div>-->
</body>
</html>
