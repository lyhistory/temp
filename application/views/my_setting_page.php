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


</head>

<body>
<div class="header_91">
    <p class="title">我的账户</p>
</div>


<div class="account_content">
    <div class="first">
        <div class="mao"><img src="images/mao.png" alt="" /></div>
        <p class="put"><?php echo $user_name;?></p>
    </div>

    <div class="twice">
        <div class="out">
            <?php if( $reg_ic_status==1){?>
                <a href="<?php echo site_url('myaccount/identityProof')?>">
                    <div class="img"></div>
                    <div class="text shengfen">身份已认证:</div><?php echo $reg_ic;?>

                </a>
            <?php }else{?>
                <a href="<?php echo site_url('myaccount/identityProof')?>">
                    <div class="img"></div>
                    <div class="text shengfen">身份未认证 </div>

                </a>

            <?php }?>

            <?php if( $reg_phone_status==1){?>
                <a href="<?php echo site_url('myaccount/mobileProof')?>">
                    <div class="text shouji">手机已认证: </div><?php echo $reg_phone;?>
                    <div class="img"></div>
                </a>
            <?php }else{?>
                <a href="<?php echo site_url('myaccount/mobileProof')?>">
                    <div class="text shouji">手机未认证</div>
                    <div class="img"></div>
                </a>
            <?php }?>

            <?php if( $reg_email_status==1){?>
                <a href="<?php echo site_url('myaccount/mailProof')?>">
                    <div class="text youxiang">邮箱已认证:</div><?php echo $reg_email;?>
                    <div class="img"></div>
                </a>
            <?php }else{?>
                <a href="<?php echo site_url('myaccount/mailProof')?>">
                    <div class="text youxiang">邮箱未认证</div>
                    <div class="img"></div>
                </a>
            <?php }?>

        </div>

        <div class="out">
            <a href="<?php echo site_url('myaccount/account')?>">
                <div class="text xinxi">我的资金</div>
                <div class="img"></div>
            </a>
            <a href="<?php echo site_url('topup')?>">
                <div class="text chongzhi">我要充值</div>
              <div class="img"></div>
            </a>
        </div>

        <div class="out">
            <a href="<?php echo site_url("myaccount/resetPassword");?>">
                <div class="text denglu">修改登录密码</div>
                <div class="img"></div>
            </a>
            <a href="<?php echo site_url("myaccount/setPayPassword");?>">
                <div class="text quxian">设置取现密码</div>
                <div class="img"></div>
            </a>
        </div>

    </div>

    <div class="three">
        <a href="<?php echo site_url("login/Logoff");?>" class="button tuichu">退出登录</a>
    </div>
</div>
</body>

</html>
