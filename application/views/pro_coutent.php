<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.min.css" />
    <title>91投房</title>
    <style>
        body,p,article{margin: 0; padding: 0;}
        div{font-family:"微软雅黑"; }
		p{ font-size:15px;}
        .xq-tetle{ text-align: center;font-size: 1.5em; color: #5095b6;}
        .xq-logo{ margin: 0 auto; width: 50%; text-align: center; margin-top: 1.5em;}
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
            buttons: [
                {
                    id:"btn-accept",
                    text: "立即支付",
                    click: function() {
                        var remain = document.getElementById("h_remain").value;
                        var invest = document.getElementById("h_invest").value;
                        var paypassword = document.getElementById("h_paypassword").value;
                        if(invest =="" || paypassword=="" ) {
                            document.getElementById("h_msg").innerHTML = "输入不能为空";
                        }
                        else if(parseFloat(remain) < parseFloat(invest)){
                            document.getElementById("h_msg").innerHTML ="用户余额不足";
                        }
                        else{
                            document.getElementById("h_msg").innerHTML ="";
                            var data = {}
                            data.invest = invest;
                            data.query_type="pro_coutent";
                            data.paypassword= paypassword;
                            ajaxQueryByPost(data ,"<?php echo site_url('Investnow/IreitsInvest')?>" ,false);
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
    function ajaxQueryByPost( data , urlPath, asyncFlag)
    {
        $.ajax({
            type: "POST",
            url: urlPath,
            data: data,
            async: asyncFlag,
            success: function(msg){
                try{obj =$.parseJSON(msg);
                    if(obj.type =='checkLogin'){
                        if(obj.isLogin) {
                            $( "#investDialog" ).dialog( "open" );
                        }else {
                            window.location.href ="<?php echo site_url('Login/index/3')?>";
                        }
                    }else if (obj.type =='pro_coutent'){
                        if (obj.hasOwnProperty("status")) {
                            if (obj.status == "success") {
                                window.location = obj.url;
                            } else {
                                try {
                                    document.getElementById("h_msg").innerHTML = "投资失败，原因：" + obj.reason;
                                }
                                catch (err) {
                                    document.getElementById("h_msg").innerHTML = "投资失败，请联系管理员";
                                }
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
        var data = {type:'checkLogin'};
        ajaxQueryByPost(data,"<?php echo site_url('login/check_login_status') ?>",false);

    }
    </script>
</head>
<body>
<div class="xq-tetle">项目详情</div>
<hr color="#5095b6">
<div class="xq-logo"><img src="images/xmxq/logo.png" width="150px" alt=""/></div>
<div class="xq-d1" style="margin:0 auto;width:90%; height:; border:1px solid #D5D5D5; border-radius:15px; margin-top:30px;">
	<div style="margin-left:-12px; margin-top:20px; height:25px;">
    	<img src="images/xmxq/shuqian.png" width="170px" height="37px" alt=""/>
        <span style="position:absolute; height:25px;margin-left:-125px; line-height:34px; color:#FFF;">收益规则</span>
    </div>
    <div style="width:90%; margin:0 auto; color:#AEAEAE;">
    <p style="margin-top:20px; margin-bottom:30px; line-height:40px;">
    预期年化收益10%<br>
    *预期收益根据债权的实际收益上下浮动
    </p>
    </div>
</div>  

<div class="xq-d1" style="margin:0 auto;width:90%; height:; border:1px solid #D5D5D5; border-radius:15px; margin-top:30px;">  
    <div style="margin-left:-12px; margin-top:20px; height:25px;">
    	<img src="images/xmxq/shuqian.png" width="170px" height="37px" alt=""/>
        <span style="position:absolute; height:25px;margin-left:-130px; line-height:34px; color:#FFF;">买入及利息</span>
    </div>
    <div style="width:90%; margin:0 auto; color:#AEAEAE;">
    <p style="margin-top:20px; margin-bottom:30px; line-height:40px;">
    1.买入金额100元起
    <br>
    2.季账户无上限
    <br>
    3.买入当天开始计息并产生收益（含周末及节假日）。在元T+2工作日计息的基础上为用户补充至当天计息
    <br>
    4.计息时间为6个月，即：180天
    </p>
    </div>
</div>

<div class="xq-d1" style="margin:0 auto;width:90%; height:; border:1px solid #D5D5D5; border-radius:15px; margin-top:30px;">  
    <div style="margin-left:-12px; margin-top:20px; height:25px;">
    	<img src="images/xmxq/shuqian.png" width="170px" height="37px" alt=""/>
        <span style="position:absolute; height:25px;margin-left:-130px; line-height:34px; color:#FFF;">退出规则</span>
    </div>
    <div style="width:90%; margin:0 auto; color:#AEAEAE;">
    <p style="margin-top:20px; margin-bottom:30px; line-height:40px;">
1.期限为180天，未满180天锁定期，该笔资金不可取现<br>
2.用户可自主选择资金到期处理方式，系统默认为“自动退出”，用户还可选择“本息续投”或“本金续投”。该资金到期前5个工作日内停止修改到期处理方式<br>
3.自动退出：本金及产生的收益在到期后的下一个工作日（周末及节假日不包含在其中）到用户银行卡上<br>
4.本息续投：资金到期后，系统自动将该本金及收益续投到悟空季账户中。续投资金的预期年化收益率为续投时的当前收益率<br>
5.本金续投：资金到期后，系统自动将该本金续投到悟空季账户中。续投资金的收益率为续投时的当前收益率。该笔本金产生的收益将在下一个工作日（周末及节假日不包含在其中）到用户银行卡上180天
    </p>
    </div>
</div>

<div class="xq-d1" style="margin:0 auto;width:90%; height:; border:1px solid #D5D5D5; border-radius:15px; margin-top:30px;">  
    <div style="margin-left:-12px; margin-top:20px; height:25px;">
    	<img src="images/xmxq/shuqian.png" width="200px" height="37px" alt=""/>
        <span style="position:absolute; height:25px;margin-left:-180px; line-height:34px; color:#FFF;">资金安全与本息保障</span>
    </div>
    <div style="width:90%; margin:0 auto; color:#AEAEAE;">
    <p style="margin-top:20px; margin-bottom:30px; line-height:40px;">
    1. 资金安全保障计划，民生银行账户托管<br>
2. 第三方支付托管，身份认证与银行卡绑定，只能本人名下的银行卡买入和转出。<br>
3. 使用悟空理财网站及app的交易用户，个人第三方账户资金被他人盗用、转账、消费等损失由太平洋保险公司进行相应赔付。180天
    </p>
    </div>
</div>

<div class="xq-d1" style="margin:0 auto;width:90%; height:; border:1px solid #D5D5D5; border-radius:15px; margin-top:30px;">  
    <div style="margin-left:-12px; margin-top:20px; height:25px;">
    	<img src="images/xmxq/shuqian.png" width="170px" height="37px" alt=""/>
        <span style="position:absolute; height:25px;margin-left:-130px; line-height:34px; color:#FFF;">资金去向</span>
    </div>
    <div style="width:90%; margin:0 auto; color:#AEAEAE;">
    <p style="margin-top:20px; margin-bottom:30px; line-height:40px;">
资金去向匹配优质个人小微金融债权以及银行承兑汇票。其中：小微金融债权平均额度仅为6万元，借款人主要为公司白领、公务员、企事业单位工作人员、小微企业主等优质高成长人群，风控采用四大行都在用的美国FICO技术。银票即银行承兑汇票，到期由银行承兑
    </p>
    </div>
</div>

<div class="xq-d1" style="margin:0 auto;width:90%; height:; border:1px solid #D5D5D5; border-radius:15px; margin-bottom:70px; margin-top:30px;">  
    <div style="margin-left:-12px; margin-top:20px; height:25px;">
    	<img src="images/xmxq/shuqian.png" width="170px" height="37px" alt=""/>
        <span style="position:absolute; height:25px;margin-left:-115px; line-height:34px; color:#FFF;">手续费</span>
    </div>
    <div style="width:90%; margin:0 auto; color:#AEAEAE; ">
    <p style="margin-top:20px; margin-bottom:30px; line-height:40px;">
免手续费。目前为用户支付买入与取现产生的手续费
    </p>
    </div>
</div>

<div style=" position:fixed; bottom:0px; z-index:99;background:url(images/xmxq/anniu.png); width:100%; height:50px; margin-bottom:4px;box-shadow:0px 3px 5px 1px rgba(46,163,255,.9); text-align:center; font-size:25px; color:#FFF; line-height:50px;"     onclick="showStatus()">立即投资</div>

<div id="dialog" title="信息">
    <p id="d_msg"> </p>
</div>

<div id="investDialog" title="立刻投资" style="background:#E9F8FF;">
    <form action="<?php echo site_url('Investnow/IreitsInvest')?>" method="post" name="investDialogForm">
        <input type="hidden" id="h_remain" value ="<?php echo $h_remain;?>">
        <p ><span>可用余额：</span ><span style="color: #00aacc;">￥<?php echo $h_remain;?></span>元 </p>
        <p><span >剩余金额：</span><span style="color: #00aacc;">￥<?php echo $t_invest_sum;?></span>元</p>
        <p>我要充值：<a style="margin-left:0px; color: #00aacc;" href="<?php echo site_url('topup')?>" >&nbsp;充值</a></p>
        <p ><span >投标进度：</span>&nbsp;<span style="color: #00aacc;"><?php echo $t_return_percent;?>%</span></p>

        <p><span >投资金额：</span ><input   type="text" name="h_invest" id ="h_invest" onkeyup="return ValidateNumber(this,value)"></p>
        <p><span >投资密码：</span ><input type="password" name="h_paypassword" id ="h_paypassword"></p>
        <p><span>还款方式：</span><span ><?php echo $t_return_type;?></span></p>
        <p id="h_msg"> </p>
    </form>
</div>

</body>
</html>

