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

</head>

<body>
<div class="header_91">
    <p class="title">邮箱认证</p>
</div>


<div class="log_content">

    <img class="proof_imgs" src="images/Mailbox_proof.jpg" alt="" />
    <form action="<?php echo site_url("myaccount/mailProof")?>" method ="post">
        <div class="inputs">
            <span>邮箱号码：</span><input name="email" type="text" id="email"/>
        </div>
        <?php echo validation_errors();?>
        <?php echo $errormsg?>
        <p id="status"></p>

        <div class="account_content">
<!--            <a href="" class="button tuichu">立即认证</a>-->
            <input class="button tuichu" type="submit" value="立即认证"/>
        </div>
    </form>
</div>




<!--<div class="footer_91"></div>-->
</body>
</html>
