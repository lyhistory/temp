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
    <link rel="stylesheet" type="text/css" href="css/project.css"/>

    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/js_91.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.min.css" />
    <style>
	*{
		margin:0px;
		padding:0px;}
        body,p,h4{margin: 0; padding: 0;}
        div{font-family:"微软雅黑"; }
        .ir-title{ text-align: center;font-size: 1.5em; color: #5095b6;}
        .bigcircle{width: 150px;margin: 0 auto; margin-top: 1em;}
        .circle {
            width: 150px;
            height: 150px;
            position: absolute;
            border-radius: 50%;
            background: #0ac;
        }
        .pie_left, .pie_right {
            width: 150px;
            height: 150px;
            position: absolute;
            top: 0;left: 0;
        }
        .left, .right {
            display: block;
            width:150px;
            height:150px;
            background:#ddd;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
        }
        .pie_right, .right {
            clip:rect(0,auto,auto,75px);
        }
        .pie_left, .left {
            clip:rect(0,75px,auto,0);
        }
        .mask {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            left: 10px;
            top: 10px;
            background: #FFF;
            position: absolute;
            text-align: center;
            font-size: 1.5em;
        }
        .mask-div1{color: #0ac; position: absolute;left:27px;top: 14px; width: 90px;overflow: hidden; }
        .mask-div1 p{border-bottom: 1px solid #0ac; color: #666;;padding-right: 25px;}
        .mask-div1 span{margin-left: 30px;}
        .mask-div2{color: #0ac; position: absolute;left:15px;top: 67px; width: 90px;overflow: hidden; }
        .mask-div2 p{border-bottom: 1px solid #0ac; color: #666;}
        .mask-div2 article{margin-left: 30px;}
        .ir-title1{margin-top: 180px;margin-bottom: 20px;  text-align: center;}
        .ir-title1-div{width: 95%;margin: .5em auto;background:#DCFDFF; overflow: hidden; font-size: .7em;border: 1px dotted #ccc;}
        .ir-title1-div span{color: #00aacc;}
        .title1-div1{width: 40%;;float: left;}
        .ir-title1-div p{margin: 1em 0;color: #999;}
        .title1-div2{width: 52%;float: right;}
        .czr-div{font-size: .7em;overflow: hidden;width: 95%; margin: 0 auto;border-bottom: 1px dotted #ccc; padding-bottom: .5em;}
        .czr-div p{margin: .5em 0;color:#999; }
        .czr-div p span{color: #000;}
        .czr-div-1{width: 53%;float: left;}
        .czr-div-2{width: 42%; float: right;}
        .czr-div-1 i{display: block; width: 2em;float: right; }
        .czr-div-1 i img{max-width: 100%;}
        .shxx{width: 95%;margin: .5em auto;overflow: hidden;border-bottom: 1px dotted #ccc;padding-bottom: .7em;}
        .shxx-div div{float: left;width: 21.3%;margin: 0 6%;}
        .shxx-div p{font-size: .9em; text-align: center;}
        .shxx div img{max-width: 100%;display:block;margin:0 auto;}
        .contents p {
            line-height: 2em;
        }
        .contents img{
            height:50%;
        }

        .ui-dialog-titlebar {
            background-color: #E9F8FF;
            text-align:center;
            background-image: none;
            color: #000;
            border:0px;
        }
        footer a{display: block; width: 100%; height: 45px;background: #0ac;text-align: center;text-decoration: none;line-height: 3em;font-family: "微软雅黑";color: #fff;position: fixed;bottom: 0;}
    	form{
			font-size:16px;	
			margin-left:15px;
			}
		input#h_invest{
			border-radius:7px;
			border:1px solid #CCCCCC;
			}
		p{
			margin-top:10px;}
		#h_invest{
			height:25px;
			width:150px; 
			border-radius:7px;
			border:1px solid #CCCCCC;}
		#h_paypassword{
			height:25px;
			width:150px; 
			border-radius:7px;
			border:1px solid #CCCCCC;}	
		#btn-accept{
			width:250px;
			color:#fff;
			border:0px;
			border-radius:20px;
			-moz-border-radius: 20px; 
			-webkit-border-radius: 20px;
			}
		.zhifu{
			margin:0px;
			padding:0px;
				}
    	.ui-button-text{
			margin:0px;
			padding:0px;
			background-color:#7ECDF6}
		.ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable ui-resizable{
			margin:0px;
			padding:0px;} .ui-dialog-buttonpane.ui-widget-content.ui-helper-clearfix{
			background-color:#E9F8FF;
			border-radius:0px 0px 5px 5px;
			border:0px;
			margin:0px;}
		.ui-button.ui-widget.ui-state-default.ui-corner-all ui-button-icon-only.ui-dialog-titlebar-close{
			background-color:#000;}
		.ui-dialog .ui-dialog-titlebar-close {
			background-color:#7ECDF6;
			border-radius:20px;
			-moz-border-radius: 20px; 
			-webkit-border-radius: 20px;
			border:0px;
			width:25px;
			height:25px;
			margin:-5px 0px 2px 5px;
			padding:0px;
			margin-right:10px;
			}
		.ui-dialog{
				padding:0px;}
		span#ui-id-2,ui-dialog-title{
			color:#666}
    </style>
    <script type="text/javascript">
        $(function() {
            $( "#dialog" ).dialog({
                autoOpen: false,
                buttons: { "Ok": function() { $(this).dialog("close"); } }
            });
            $( "#investDialog" ).dialog({
                autoOpen: false,
                buttons: [
                    {
                        id:"btn-accept",
                        text: "立即支付",
                        click: function() {
                            var remain = document.getElementById("h_remain").value;
                            var invest = document.getElementById("h_invest").value;
                            var password = document.getElementById("h_paypassword").value;
                            var query_id =  document.getElementById("h_query_id").value;
                            if(invest =="" || password=="" ) {
                                document.getElementById("h_msg").innerHTML = "输入不能为空";
                            }
                            else if(parseInt(remain) < parseInt(invest)){
                                document.getElementById("h_msg").innerHTML ="用户余额不足";
                            }
                            else{
                                document.getElementById("h_msg").innerHTML ="";
                                var data = {}
                                data.invest = invest;
                                data.query_id = query_id;
                                data.password= password;
                                ajaxQueryByPost(data);
                            }
                        }
                    },

                ]
            });

        });
        function ValidateNumber(e, pnumber)
        {
            if (!/^\d+[.]?\d*$/.test(pnumber))
            {
                e.value = /^\d+[.]?\d*/.exec(e.value);
            }
            return false;
        }
        function ajaxQueryByPost( data)
        {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Investnow/IreitsInvest')?>",
                data: data,
                success: function(msg){
                    try{obj =$.parseJSON(msg);
                        if (obj.hasOwnProperty("status")){
                            if(obj.status =="success"){
                                window.location = obj.url;
                            }else{
                                try{
                                    document.getElementById("h_msg").innerHTML ="投资失败，原因："+ obj.reason;
                                }
                                catch (err){
                                    document.getElementById("h_msg").innerHTML ="投资失败，请联系管理员";
                                }
                            }

                        }
                    }
                    catch (err){
                        return;
                    }
                }
            });
        }
        $().ready(function(){
            $(function() {
                $('.circle').each(function(index, el) {
                    var num = $(this).find('span').text() * 3.6;
                    if (num<=180) {
                        $(this).find('.right').css('transform', "rotate(" + num + "deg)");
                    } else {
                        $(this).find('.right').css('transform', "rotate(180deg)");
                        $(this).find('.left').css('transform', "rotate(" + (num - 180) + "deg)");
                    }
                });
            });
        })
        function showStatus(){

//            document.getElementById("d_msg").innerHTML ="功能开发中，请到网页端操作";
//            $( "#dialog" ).dialog( "open" );
            var islogin = document.getElementById("islogin").value;
            if (islogin ==1){
                $( "#investDialog" ).dialog( "open" );
            }else{
                var query_id =  document.getElementById("h_query_id").value;
                window.location.href ="<?php echo site_url('Login/index/3').'/'.$h_query_id?>";

            }

        }
    </script>
    <style TYPE="text/css">
        td{font-size: 1em;}
    </style>

</head>

<body>
<div class="ir-title">i-REITS</div>
<hr color="#5095b6">
<div class="bigcircle">
    <div class="circle">
        <div class="pie_left"><div class="left"></div></div>
        <div class="pie_right"><div class="right"></div></div>
        <div class="mask">
            <div class="mask-div1">
                <p style="font-size: .6em;float: left;">投资进度</p>
                <span style="font-family: Arial;"><?php echo $borrow["t_return_percent"];?></span>%
            </div>
            <div class="mask-div2">
                <p style="font-size: .6em;float: left;">投资金额(万)</p>
                <article style="font-family: Arial;"><?php echo $borrow["t_num"];?></article>
            </div>
        </div>
    </div>
</div>
<div class="ir-title1"><p><?php echo $borrow["t_name"];?></p></div>
<div class="ir-title1-div">
    <div class="title1-div1">
        <p>筹款金额：<span><?php echo $borrow["t_num"];?>万元</span></p>
        <p>年利率：<span><?php echo $borrow["t_rate"];?>%</span></p>
        <p>剩余时间：<span><?php echo $borrow["t_return_status"];?></span></p>
    </div>
    <div class="title1-div2">
        <p>期限/月：<span><?php echo $borrow["t_period"];?></span></p>
        <p>筹资对象：<span><?php echo $borrow["t_face_type"];?></span></p>
        <p>还款方式：<span><?php echo $borrow["t_return_type"];?></span></p>
    </div>
</div>
<div class="ir-czr">
    <h4 style="text-align: center;color: #666;">筹资人信息</h4>
    <p style="color: #00aacc; margin-left: 2%;">背景信息</p>
    <div class="czr-div">
        <div class="czr-div-1">
            <?php if( $t_invester_type!=0){?>
            <p style="width: 60%; padding-right: 40%;">昵称：<span>alivin</span><i><img src="images/helps/vip.png" alt=""/></i></p>
            <?php }else{ ?>
            <p style="width: 60%; padding-right: 40%;">昵称：<span>alivin</span><i></i></p>
            <?php } ?>
            <p>性别：<span><?php echo $t_sex;?></span></p>
            <p>毕业学校：<span><?php echo $t_graduate;?></span></p>
            <p>有无购房：<span><?php echo $typecase;?></span></p>
        </div>
        <div class="czr-div-2">
            <p>是否结婚：<span><?php echo $t_single;?></span></p>
            <p>学历：<span><?php echo $t_education;?></span></p>
            <p>出生年月：<span><?php echo $t_birthday;?></span></p>
            <p>有无购车：<span><?php echo $t_hascar;?></span></p>
        </div>
    </div>
</div>
<div class="czr-div">
    <p style="color: #00aacc;font-size: 1rem;margin-bottom: 0;">筹资记录</p>
    <div class="czr-div-1">
        <p>发布筹款：<span><?php echo $t_nofabu;?>次</span></p>
        <p>还清笔数：<span><?php echo $t_noreturn;?>期</span></p>
        <p>严重逾期：<span><?php echo $t_nooverdue;?>期</span></p>
        <p>待还款：<span><?php echo $t_nohuankuan;?>元</span></p>
        <p>总投资额：<span><?php echo $t_notouzi;?>元</span></p>
    </div>
    <div class="czr-div-2">
        <p>筹资成功：<span><?php echo $t_nosuccess;?>次</span></p>
        <p>筹款总额：<span><?php echo $t_nochoukuan;?>元</span></p>
        <p>筹款总额：<span><?php echo $t_nochoukuan;?>元</span></p>
        <p>逾期总额：<span><?php echo $t_noyueqi;?>元</span></p>
        <p>代收总额：<span><?php echo $t_nodaishou;?>元</span></p>
    </div>
</div>
<div class="shxx">
    <p style="color: #00aacc;margin-bottom: 1em;">审核信息</p>
    <div class="shxx-div">

        <?php if( $email_status==1){?>
            <div class="shxx-div-1"><img src="images/helps/ir-shenfen.png" alt=""/><p>身份认证</p></div>
        <?php }else{?>
            <div class="shxx-div-1"><img src="images/helps/ir-shenfen1.png" alt=""/><p>身份未认证</p></div>
        <?php }?>

        <?php if( $phone_status==1){?>
            <div class="shxx-div-1"><img src="images/helps/ir-shouji.png" alt=""/><p>手机认证</p></div>
        <?php }else{?>
            <div class="shxx-div-1"><img src="images/helps/ir-shouji1.png" alt=""/><p>手机未认证</p></div>
        <?php }?>

        <?php if( $realname_status==1){?>
            <div class="shxx-div-1"><img src="images/helps/ir-youxiang.png" alt=""/><p>邮箱认证</p></div>
        <?php }else{?>
            <div class="shxx-div-1"><img src="images/helps/ir-youxiang1.png" alt=""/><p>邮箱未认证</p></div>
        <?php }?>

    </div>
</div>
<div style="margin-bottom: 70px;">
    <h4 style="text-align: center;color: #666;">筹资描述</h4>
    <div class="contents"><?php echo $borrow["t_borrow_content"];?></div>
</div>
<footer>
    <a onclick="showStatus()" class="button tuichu">立即投资</a>
</footer>

<div id="dialog" title="信息">
    <p id="d_msg"> </p>
</div>

<div id="investDialog" title="立刻投资" style="background:#E9F8FF;">
    <form action="<?php echo site_url('Investnow/IreitsInvest')?>" method="post" name="investDialogForm">
        <input type="hidden" id="islogin" value="<?php echo $h_islogin;?>">
        <input type="hidden" id="h_remain" value ="<?php echo $h_remain;?>">
        <input type="hidden" id="h_query_id" value ="<?php echo $h_query_id;?>">
        <p ><span>可用余额：</span ><span style="color: #00aacc;">￥<?php echo $h_remain;?></span>元 </p>
        <p><span >剩余金额：</span><span style="color: #00aacc;">￥<?php echo $borrow["t_invest_sum"];?></span>元</p>
        <p>我要充值：<a style="margin-left:0px; color: #00aacc;" href="<?php echo site_url('topup')?>" >&nbsp;充值</a></p>
        <p ><span >投标进度：</span>&nbsp;<span style="color: #00aacc;"><?php echo $borrow["t_return_percent"];?>%</span></p>
        
        <p><span >投资金额：</span ><input   type="text" name="h_invest" id ="h_invest" onkeyup="return ValidateNumber(this,value)"></p>
        <p><span >投资密码：</span ><input type="password" name="h_paypassword" id ="h_paypassword"></p>
        <p><span>还款方式：</span><span ><?php echo $borrow["t_return_type"];?></span></p>
        <p id="h_msg"> </p>
       
    </form>
</div>
</body>
</html>

