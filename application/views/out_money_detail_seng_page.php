<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
    <title>91投房</title>
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        function ValidateNumber(e, pnumber)
        {
            if (!/^\d+[.]?\d*$/.test(pnumber))
            {
                e.value = /^\d+[.]?\d*/.exec(e.value);
            }
            return false;
        }
        function checkInputValue(){
            var money = document.getElementById("OrderMoney").value;
            if(money== ""){
                $('#display').html("充值金额不能为空");
                return false;
            }else{
                document.getElementById("paymentform").submit();
                return true;
            }
        }
        $(function() {
            if(<?= $auto?>){
                document.getElementById("paymentform").submit();
            }
        });
    </script>
</head>
<body>
<div class="header_91">
    <p class="title">支付信息 </p>
</div>

<div class="out_money_content">
    <form  method="post" id="paymentform" action ="<?= $payUrl ?>" >
        <div class="out_block">
            <label for="OrderMoney">支付金额:</label>
            <input name="OrderAmount" type="text"  value ='<?= $OrderAmount?>' id="OrderMoney" onkeyup="return ValidateNumber(this,value)"/>
         </div>
        <input type='hidden' name='Name' value="<?php echo $Name; ?>" />
        <input type='hidden' name='Version' value="<?php echo $Version; ?>"/>
        <input type='hidden' name='Charset' value="<?php echo $Charset; ?>"/>
        <input type='hidden' name='MsgSender' value="<?php echo $MsgSender; ?>"/>
        <input type='hidden' name='SendTime' value="<?php echo $SendTime; ?>" />
        <input type='hidden' name='OrderNo' value="<?php echo $OrderNo; ?>" />
        <input type='hidden' name='OrderTime' value="<?php echo $OrderTime; ?>" />
        <input type='hidden' name='ProductName' value="<?php echo $ProductName; ?>" />
        <input type='hidden' name='PayType' value="<?php echo $PayType; ?>" />
        <input type='hidden' name='InstCode' value="<?php echo $InstCode; ?>" />
        <input type='hidden' name='BackUrl' value="<?php echo $BackUrl; ?>" />
        <input type='hidden' name='PageUrl' value="<?php echo $PageUrl; ?>" />
        <input type='hidden' name='NotifyUrl' value="<?php echo $NotifyUrl; ?>" />
        <input type='hidden' name='BuyerContact' value="<?php echo $BuyerContact; ?>" />

        <input type='hidden' name='BuyerIp' value="<?php echo $BuyerIp; ?>" />
        <input type='hidden' name='Ext1' value="<?php echo $Ext1; ?>" />
        <input type='hidden' name='SignType' value="<?php echo $SignType; ?>" />
        <input type='hidden' name='SignMsg' value="<?php echo $SignMsg; ?>" />



        <div id="display"></div>
        <div class="account_content">
            <div class="invests">
                <input value="立即支付"  class="button tuichu" type="button" onclick="return checkInputValue()">
<!--                <input type="submit" value="立即支付"  class="button tuichu" onclick="return checkInputValue()">-->
            </div>
        </div>

    </form>
</div>

</body>
</html>