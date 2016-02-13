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
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

</head>

<body>
<div class="header_91">
    <p class="title">忘记密码</p>
</div>


<div class="log_content">
    <form action ="<?php echo site_url("myaccount/getPassword");?>" method = "post" >
        <div class="inputs">
            <span>用户名</span><input name="username" type="text"  id ="username" />
        </div>
        <div class="inputs">
            <span>邮&emsp;箱</span><input name="email" type="text"  id ="email" />
        </div>


        <?php echo validation_errors();?>
        <?php echo $errormsg?>

        <div class="account_content">
            <input class="button tuichu" type="submit" value="提取密码">
        </div>
    </form>
</div>



<div id="dialog" title="信息">
    <p id="d_msg"> </p>
</div>

<!--<div class="footer_91"></div>-->
</body>
</html>
