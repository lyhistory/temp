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
    <link rel="stylesheet" type="text/css" href="css/helpcss.css"/>
<!--    <script src="js/help.js" type="text/javascript" charset="utf-8"></script>-->
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/help.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<div class="header_91">
    <p class="title"><?=$title?></p>
</div>


        <?php if ($ismedia==false) { ?>
        <!--<div class="helps">-->
            <img src="<?=$image?>" alt="" />
        <!--</div>-->
        <?php }else{ ?>
        <div class="list_contents">
            <div class="out">
                <div class="in_cont">
                    <p class="title">新浪网</p>
                    <div class="content">
                        <img src="images/helps/renmingwang.png" alt="" />
                    </div>
                    <img class="imgs" src="images/helps/sj_btn_28.png" alt="" />
                </div>

                <div class="in_cont">
                    <p class="title">搜狐网</p>
                    <div class="content">
                        <img src="images/helps/xinhuawang.png" alt="" />
                    </div>
                    <img class="imgs" src="images/helps/sj_btn_28.png" alt="" />
                </div>
                <div class="in_cont">
                    <p class="title">凤凰网</p>
                    <div class="content">
                        <img src="images/helps/cctv.png" alt="" />
                    </div>
                    <img class="imgs" src="images/helps/sj_btn_28.png" alt="" />
                </div>
                <div class="in_cont">
                    <p class="title">网易</p>
                    <div class="content">
                        <img src="images/helps/qq.png" alt="" />
                    </div>
                    <img class="imgs" src="images/helps/sj_btn_28.png" alt="" />
                </div>
                <div class="in_cont">
                    <p class="title">中国青年网</p>
                    <div class="content">
                        <img src="images/helps/sina.png" alt="" />
                    </div>
                    <img class="imgs" src="images/helps/sj_btn_28.png" alt="" />
                </div>
                <div class="in_cont">
                    <p class="title">扬子晚报</p>
                    <img class="imgs" src="images/helps/sj_btn_28.png" alt="" />
                </div>
                <div class="in_cont">
                    <p class="title">36氪</p>
                    <img class="imgs" src="images/helps/sj_btn_28.png" alt="" />
                </div>

            </div>
        </div>
        <?php } ?>


</body>
</html>