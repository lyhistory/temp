<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <title>91投房</title>
    <base href="<?=$this->config->item('base_url')?>assets/" />

    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <style>
        body{margin: 0; padding: 0;}
        div{font-family:"微软雅黑"; }
        .mm-guanli{ text-align: center;font-size: 1.5em; color: #5095b6;}
        .div-1{ width: 92%; margin: 0 auto; overflow: hidden; border-bottom: 1px solid #eee; padding-bottom: .5em;}
        .div-1 span{float: left;}
        .div-1-shu{background: url("images/helps/mm-xiangmu.png") no-repeat center; float: left; margin-right: .3em;}
        .change1{ display: block;width: 19px; height: 20px; background: url("images/helps/mm-shousuo.png") no-repeat center; float: right;}
        #div1{margin: 1em 0;}
        .change2{display: block; width: 19px; height: 20px; background-size: 100%; float: right; background: url("images/helps/mm-shousuo.png") no-repeat center;}        .div-1-img{width: 30%; margin: 0 auto; margin-top: 1em;margin-bottom: 1em;}
        .div-1-img img{max-width: 100%;}
        ::-webkit-input-placeholder { font-size:10px;; }
        ::-moz-placeholder { font-size: .2em } /* firefox 19+ */
        :-ms-input-placeholder { font-size: .2em } /* ie */
    </style>

</head>
<body>
<div class="mm-guanli">密码管理</div>
<hr color="#5095b6">
<div>
    <div id="div1">

        <div class="div-1" id="div-1" onclick="window.location='<?php echo site_url("myaccount/resetPassword");?>'">
            <i class="div-1-shu" style="display: block;width: 3px;height: 1.3em;"></i>
            <span>登录密码管理</span>
            <i class="change1" id="bianhua"></i>
        </div>

    </div>
    <div id="div2">

        <div class="div-1" id="div-2" onclick="window.location='<?php echo site_url("myaccount/setPayPassword");?>'">
            <i class="div-1-shu" style="display: block;width: 3px;height: 1.3em;"></i>
            <span>设置提现密码</span>
            <i class="change2" id="bianhua1"></i>
        </div>

    </div>
</div>
</body>
</html>