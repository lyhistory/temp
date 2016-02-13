<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <title>91投房</title>
    <link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/js_91.js" type="text/javascript" charset="utf-8"></script>

    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript">
        $(function() {
            $( "#dialog" ).dialog({
                autoOpen: false,
                buttons: { "Ok": function() { $(this).dialog("close"); } }
            });
        });
        function showStatus(){
            document.getElementById("d_msg").innerHTML = "正在研发中，请先到桌面版使用该功能";
            $( "#dialog" ).dialog( "open" );
        }
    </script>
</head>

<body>
<div class="header_91">
    <p class="title">我的账户</p>
</div>


<div class="account_content">
    <div class="first">
        <div class="mao"><img src="images/mao.png" alt="" /></div>
        <p class="put">已经收益：<span><?php echo $e_total;?></span>元</p>
    </div>

    <div class="twice">

            <div class="border red">
                <p>我的资产：<span><?php echo $a_total;?></span>元</p>
            </div>
            <div class="border green">
                <p>可用余额：<span><?php echo $a_remain;?></span>元</p>
            </div>
    </div>

    <div class="invests">
        <a href="<?php echo site_url('ireits/index') ?>" class="button touzi">我要投资</a>
        <a onclick="showStatus()" class="button tixiang">我要提现</a>
        <a href="<?php echo site_url('topup') ?>" class="button touzi">我要充值</a>
        <a href="<?php echo site_url('topup/bindingPageOne') ?>" class="button tixiang">手机绑定</a>

    </div>
    <div id="dialog" title="信息">
        <p id="d_msg"> </p>
    </div>
</div>


<!--<div class="footer_91"></div>-->
</body>
</html>
