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
            var dynamic_code = document.getElementById("dynamic_code").value;
            $hasError = "<?php Print($hasError) ?>";
            if(dynamic_code== ""){
                $('#display').html("验证码不能为空");
                return false;
            }
            else if($hasError == true){
                $('#display').html("交易有错");
                return false;
            }
            else{
                document.getElementById("paymentform").submit();
                return true;
            }
        }


    </script>
</head>
<body>
<div class="header_91">
    <p class="title"> <?php if($type == '0'){echo("支付信息");}else{echo("绑定信息");}?></p>
</div>

<div class="out_money_content">
    <form  method="post" id="paymentform" action ="<?= $actionUrl ?>" >
        <div class="out_block">
            <label for="dynamic_code">验证码:</label>
            <input name="dynamic_code" type="text"  id="dynamic_code"  value="<?php echo $dynamic_code; ?>" onkeyup="return ValidateNumber(this,value)"/>
        </div>

        <div id="display"></div>
        <?php echo $errormsg?>
        <div class="account_content">
            <div class="invests">
            <?php if($type == '0'){?>
                    <input value="立即支付"  class="button tuichu" type="button" onclick="return checkInputValue()">
                <?php }else{?>
                    <input value="立即绑定"  class="button tuichu" type="button" onclick="return checkInputValue()">
                <?php }?>
                <!--                <input type="submit" value="立即支付"  class="button tuichu" onclick="return checkInputValue()">-->
            </div>
        </div>

    </form>
</div>

</body>
</html>