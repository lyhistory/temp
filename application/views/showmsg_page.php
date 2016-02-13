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
</head>

<body>
<div class="header_91">
    <p class="title"><?php echo  $title?></p>
</div>
<div class="log_content">
    <div class="log_content">
        <span> <?php echo  $status?></span>
    </div>
    <div class="log_content">
        <span> <?php echo  $error?></span>
    </div>
    <div class="account_content">
        <a href="<?php echo $returnlink ?>" class="button tuichu">返回</a>
    </div>
</div>

<!--<div class="footer_91"></div>-->
</body>
</html>
