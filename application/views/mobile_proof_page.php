<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

    <title>91投房</title>
    <link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
    <script type="text/javascript">
        var inWaiting =false;
        var endtime = 60;
        var now =0;
        function ValidateNumber(e, pnumber)
        {
            if (!/^\d+[.]?\d*$/.test(pnumber))
            {
                e.value = /^\d+[.]?\d*/.exec(e.value);
            }
            return false;
        }
        function isValid(type ){
            var phonenum = document.getElementById("phonenum").value;
            if ( phonenum==""){
                return false;
            }
            return true;
        }

        function daoJiShi()
        {
            now+=1;
            var ofs= endtime -now;
            document.getElementById('getcode').innerHTML=ofs+ ' 秒';
            if(ofs<0){document.getElementById('getcode').innerHTML='获取验证码';
                inWaiting =false;
                return;
            };
            setTimeout('daoJiShi()',1000);
        }
        function sendverifycode() {

            var res = isValid();
            if(res ==true && inWaiting ==false) {
                inWaiting = true;
                var data={};
                data.phonenum = document.getElementById("phonenum").value;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('myaccount/sendMobileVerifyCode')?>",
                    data: data,
                    success: function (msg) {
                        $('#verify-status').html(msg);
                        daoJiShi();
                    }
                });
            }else{
                $('#verify-status').html("手机号不能为空");
            }
        };
    </script>
</head>

<body>
<div class="header_91">
    <p class="title">手机认证</p>
</div>
<div class="log_content">

    <img class="proof_imgs" src="images/Mobile_proof.jpg" alt="" />
    <form action="<?php echo site_url("myaccount/mobileProof")?>" method ="post">
        <div class="inputs">
            <span>手机号：</span><input name="phonenum" type="text" id="phonenum" onkeyup="return ValidateNumber(this,value)"/>
        </div>
        <div class="inputs">
            <span>验证码：</span>
            <input name="verify" class="code" type="text" />
            <a onclick="sendverifycode()" id="getcode" class="ipcode">获取验证码</a>
        </div>

        <?php echo validation_errors();?>
        <?php echo $errormsg?>
        <p id="verify-status"></p>

        <div class="account_content">
<!--            <a onclick="showStatus()"  class="button tuichu">立即认证</a>-->
            <input class="button tuichu" type="submit" value="立即认证"/>
        </div>
     </form>
</div>



<div id="dialog" title="信息">
    <p id="d_msg"> </p>
</div>

<!--<div class="footer_91"></div>-->
</body>
</html>
