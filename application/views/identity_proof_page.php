<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
<!--    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>-->
<!--    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />-->

    <title>91投房</title>
    <link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
    <script type="text/javascript">
//        $(function() {
//            $( "#dialog" ).dialog({
//                autoOpen: false,
//                buttons: { "Ok": function() { $(this).dialog("close"); } }
//            });
//        });
//        function showStatus(){
//            document.getElementById("d_msg").innerHTML = "正在研发中，请先到桌面版使用该功能";
//            $( "#dialog" ).dialog( "open" );
//        }
        function ValidateNumber(e, pnumber)
        {
            if (!/^\d+[.]?\d*$/.test(pnumber))
            {
                e.value = /^\d+[.]?\d*/.exec(e.value);
            }
            return false;
        }
    </script>
</head>

<body>
<div class="header_91">
    <p class="title">身份认证</p>
</div>


<div class="log_content">

    <img class="proof_imgs" src="images/identity_proof.jpg" alt="" />
    <form action="<?php echo site_url("myaccount/identityProof")?>" method ="post" enctype="multipart/form-data">
        <div class="inputs">
            <span>姓名：</span><input name="username" type="text"/>
        </div>
        <div class="inputs">
            <span>身份证号：</span><input name="icnumber" type="text" onkeyup="return ValidateNumber(this,value)"/>
        </div>
        <div class="inputs">
            <span>性别：</span><select name="sex"><option value ="man">男</option><option value ="women">女</option></select>
        </div>
        <div class="inputs">
            <span>身份证正面：</span><input name="icpositive" type="file" multiple />
        </div>
        <div class="inputs">
            <span>身份证反面：</span><input name="icnegative" type="file" multiple/>
        </div>

        <?php echo validation_errors();?>
        <?php echo $errormsg?>

        <div class="account_content">
<!--            <a onclick="showStatus()"  class="button tuichu">立即认证</a>-->
          <input class="button tuichu" type="submit" value="立即认证"/>
        </div>
    </form>
</div>



<!--<div id="dialog" title="信息">-->
<!--    <p id="d_msg"> </p>-->
<!--</div>-->
<!--<div class="footer_91"></div>-->
</body>
</html>