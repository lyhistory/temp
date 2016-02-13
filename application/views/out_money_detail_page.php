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
    <form  method="post" id="paymentform" action ="<?= $p_action ?>" >
        <div class="out_block">
            <label for="OrderMoney">支付金额:</label>
            <input name="OrderMoney" type="text"  value ='<?= $OrderMoney?>' id="OrderMoney" onkeyup="return ValidateNumber(this,value)"/>
         </div>
        <input type='hidden' name='MemberID' value="<?php echo $MemberID; ?>" />
        <input type='hidden' name='TerminalID' value="<?php echo $TerminalID; ?>"/>
        <input type='hidden' name='InterfaceVersion' value="<?php echo $InterfaceVersion; ?>"/>
        <input type='hidden' name='KeyType' value="<?php echo $KeyType; ?>"/>
        <input type='hidden' name='PayID' value="<?php echo $PayID; ?>" />
        <input type='hidden' name='TradeDate' value="<?php echo $TradeDate; ?>" />
        <input type='hidden' name='TransID' value="<?php echo $TransID; ?>" />
        <input type='hidden' name='ProductName' value="<?php echo $ProductName; ?>" />
        <input type='hidden' name='Amount' value="<?php echo $Amount; ?>" />
        <input type='hidden' name='Username' value="<?php echo $Username; ?>" />
        <input type='hidden' name='AdditionalInfo' value="<?php echo $AdditionalInfo; ?>" />
        <input type='hidden' name='PageUrl' value="<?php echo $PageUrl; ?>" />
        <input type='hidden' name='ReturnUrl' value="<?php echo $ReturnUrl; ?>" />
        <input type='hidden' name='Signature' value="<?php echo $Signature; ?>" />
        <input type='hidden' name='NoticeType' value="<?php echo $NoticeType; ?>" />

        <div id="display"></div>
        <div class="account_content">
            <div class="invests">
                <input value="立即支付"  class="button tuichu" type="submit" onclick="return checkInputValue()">
<!--                <input type="submit" value="立即支付"  class="button tuichu" onclick="return checkInputValue()">-->
            </div>
        </div>

    </form>
</div>

</body>
</html>