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
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <style>
        body,p,h4{margin: 0; padding: 0;}
        div{font-family:"微软雅黑"; }
        .ir-title{ text-align: center;font-size: 1.5em; color: #5095b6;}
        .ir-title1{text-align: center; font-size:large}
        .ir-title1-div{width: 95%;margin: .5em auto;background:#DCFDFF; overflow: hidden; font-size: 1em;border: 1px dotted #ccc;}
        .ir-title1-div span{color: #00aacc;}
        .title1-div1{width: 40%;;float: left;padding-left: 30px; }
        .ir-title1-div p{margin: 1em 0;color: #999;}
        .title1-div2{width: 52%;float: right;}
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
		span#ui-id-2,ui-dialog-title{
			color:#666}
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
					 .ui-dialog-buttonpane.ui-widget-content.ui-helper-clearfix{
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
			color:#FFF;
			border:0px;
			width:25px;
			height:25px;
			margin:-5px 0px 2px 5px;
			padding:0px;
			margin-right:10px;
			}
    </style>
    <script type="text/javascript">
        $(function() {
            $( "#dialog" ).dialog({
                autoOpen: false,
                buttons: { "Ok": function() { $(this).dialog("close"); } }
            });
            $( "#investDialog" ).dialog({
                autoOpen: false,
				dialogClass:"zhifu",
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
                                data.password = password;
                                ajaxQueryByPost(data);
                            }
                        }
                    },

                ]
				
				
            });

        });
		$( "#investDialog" ).css("background-color","#000");
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
                url: "<?php echo site_url('Investnow/ToufangInvest')?>",
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

        function showStatus(){

//            document.getElementById("d_msg").innerHTML ="功能开发中，请到网页端操作";
//            $( "#dialog" ).dialog( "open" );
            var islogin = document.getElementById("islogin").value;
            if (islogin ==1){
                $( "#investDialog" ).dialog( "open" );
            }else{
                var query_id =  document.getElementById("h_query_id").value;
                window.location.href ="<?php echo site_url('Login/index/4').'/'.$h_query_id?>";

            }
        }
    </script>

</head>

<body>
<div class="ir-title">项目详情</div>
<hr color="#5095b6">
<!--<div style="width:100%; margin:10px"><img src="--><?php //echo $i_img;?><!--"  height="200"  /></div>-->
<div style="margin: .5em auto; width: 95% "><img src="<?php echo $i_img;?>" style="	width: 100%;margin-top: 2em;height=200px ; " /></div>
</div>
<div class="ir-title1"><p><?php echo $h_name;?></p></div>
<div class="ir-title1-div">
    <div class="title1-div1">
        <p>目&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标：<span><?php echo $h_target_day;?>天</span></p>
        <p>支持人数：<span><?php echo $h_sup_num;?></span></p>
        <p>筹资状态：<span><?php echo $h_status;?></span></p>
    </div>
    <div class="title1-div2">
		<p>剩&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;余： <span><?php echo $h_left_day;?>天</span></p>
        <p>筹资金额： <span><?php echo $h_target_num;?>元</span></p>
        <p>已筹金额：<span><?php echo $h_raised_num;?>元</span></p>
    </div>
</div>

    <h4 style="text-align: center;color: #666; margin-bottom: 15px ;margin-top: 15px ; font-size: large">投标记录</h4>
    
    <div style="border-bottom: 1px dotted #ccc; overflow: hidden;width: 95% ;margin: .5em auto;  padding-bottom: .5em; padding-top: .5em; background-color:#f5f5f5" >
            <?php if( !empty( $h_items ) ){?>
            <table width="100%" id="toufang_record" >
                <colgroup>
                    <col style="width: 33%" />
                    <col style="width: 33%" />
                    <col style="width: 33%" />
                </colgroup>
                <tr style="color:#a6a5a5; font-size:1em">
                    <th style="border-right: 1px dashed #aaa; ">支持人</th>
                    <th style="border-right: 1px dashed #aaa; ">支持金额</th>
                    <th style=" ">时间</th>
                </tr>
                <?php } ?>
                <?php foreach($h_items as $key=>$v) { ?>

                    <tr>
                        <td align="center" style="font-size: .9em ;color: #00aacc; border-right: 1px dashed #aaa;"><?php echo $v["h_tender_name"];?></td>
                        <td align="center" style="font-size: .9em ;color: #00aacc;border-right: 1px dashed #aaa;">￥<?php echo $v["h_tender_val"];?></td>
                        <td align="center" style="font-size: .9em ;color: #00aacc"><?php echo $v["h_tender_time"];?></td>
                    </tr>
                <?php } ?>
                <?php if( !empty( $h_items) ){?>
            </table>
        <?php } ?>
    </div>

        <h4 style="text-align: center;color: #666; margin-top: 15px ; font-size: large"">筹资描述</h4>
        <div id="toufang_desc" style="border-bottom: 1px dotted #ccc; overflow: hidden;width: 95% ;margin: .5em auto; padding-bottom: .5em;  margin-bottom: 50px" >
            <div align="center"><?php echo $t_raise_content;?></div>
        </div>


<!--其它信息结束-->

<footer>
    <a onclick="showStatus()" class="button tuichu" >立即投资</a>
</footer>

<div id="dialog" title="信息"  >
    <p id="d_msg"> </p>
</div>
<div id="investDialog" title="立刻投资" style="background:#E9F8FF; ">
    <form action="" method="post">
        <input type="hidden" id="islogin" value="<?php echo $h_islogin;?>">
        <input type="hidden" id="h_query_id" value ="<?php echo $h_query_id;?>">
        <input type="hidden" id="h_remain" value ="<?php echo $h_remain;?>">
        <p><span>可用余额：</span><span style="color: #00aacc;">￥<?php echo $h_remain;?></span>元</p>
        <p>可投金额：<span style="color: #00aacc;">￥<? echo $h_target_num-$h_raised_num; ?>.00</span>元</p>
        <p>我要充值：<a style="margin-left:0px; color: #00aacc;" href="<?php echo site_url('topup')?>" >&nbsp;充值</a></p>
        <p>投标进度：<span style="color: #00aacc;">&nbsp;<? echo $h_raised_num/$h_target_num*100; ?>%</span></p>
        <p><span>投资金额：</span><input type="text" name="h_invest" id ="h_invest" onkeyup="return ValidateNumber(this,value)"></p>
        <p><span>投资密码：</span><input type="password" name="h_paypassword" id ="h_paypassword" ></p>
        <p id="h_msg"> </p>
    </form>
</div>
<!--<div class="footer_91"></div>-->
</body>
</html>
