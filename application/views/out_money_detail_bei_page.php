<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <link rel="stylesheet" type="text/css" href="css/firstcss.css"/>
<!--    <link rel="stylesheet" href="css/sample.css" />-->
    <title>91投房</title>
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.dd.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/dd.css" />
    <style>
        body{font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif; font-size:14px;}
    </style>
    <script type="text/javascript">
        function ValidateNumber(e, pnumber)
        {
            if (!/^\d+[.]?\d*$/.test(pnumber))
            {
                e.value = /^\d+[.]?\d*/.exec(e.value);
            }
            return false;
        }



        $(document).ready(function(e) {
            $("#tech").msDropdown().data("dd");
        });
        var  status = "<?php Print($status) ?>";
        function checkInputValue(){
            var amount = document.getElementById("amount").value;
            var errmsg="";
            if(amount== "") {
                errmsg= "充值金额不能为空<br />";
            }else if(parseInt (amount)<2 ){
                errmsg= "充值金额必须大于2<br />";
            }

            if (status =="0" || status =="-1" || status =="2") {
                var real_name = document.getElementById("realname").value;
                var card_no = document.getElementById("cardno").value;
                var cert_no = document.getElementById("certno").value;
                var card_bind_mobile_phone_no = document.getElementById("cardbindmobilephoneno").value;
                if (real_name == "") {
                    errmsg += "卡名字不能为空<br />"
                }
                if (card_no == "") {
                    errmsg += "银行卡号不能为空<br />"
                }
                if (cert_no =="") {
                    errmsg += "身份证不能为空<br />"
                }
                if (card_bind_mobile_phone_no == "") {
                    errmsg += "绑定手机不能为空<br />"
                }
            }
            if(errmsg!="") {
                $('#display').html(errmsg);
                return false;
            }else{

                $needRelease= false;
                //need to release??
                var data={};
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('topup/checkBankAccountInfo')?>",
                    data: data,
                    async:false,
                    success: function (msg) {
                        var data = JSON.parse(msg);
                        if (data["result"] == "F") {
                            $needRelease = false;
                        }else if(data["result"] =="T"){
                            if(data["bank_card_num"] == "0"){
                                $needRelease = false;
                            }else{
                                $needRelease = true;
                                var useDefault = document.getElementById("usedefault").value;
                                if ( useDefault == "1"){
                                    $needRelease = false;
                                }
                            }
                        }
                    }
                });



                if ($needRelease == true) {
                    //call release binding
                    var data = {};
                    data.bandcardno = document.getElementById("cardno").value;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('topup/beiReleaseBinding')?>",
                        data: data,
                        async: false,
                        success: function (msg) {
                            var data = JSON.parse(msg);
                            if (data["result"] == "F") {
                                $('#display').html(data["error_message"]);
                                return false;
                            }
                            else {
                                document.getElementById("paymentform").submit();
                                return true;
                            }
                        }
                    });
                } else {
                    document.getElementById("paymentform").submit();
                    return true;
                }
            }
        }
        function bankSelection(){
            var form = document.getElementById('paymentform');
            form.action ="<?php Print(site_url('topup/beiTopUpPageOneChangeBank')) ?>";
            form.submit();
        }


        function changeBank(){
            $('#payInfoContainer').slideDown();
            $('#bindInfoContainer').slideUp();
            document.getElementById("usedefault").value = "2";
            status= "0";
            var  type = "<?php Print($type) ?>";
            if(type=="1") {
                document.getElementById("smsbutton").style.display = "block";
            }

        }

    </script>
</head>
<body>
<div class="header_91">
    <p class="title">  <?php if($type == '0'){echo("支付信息");}else{echo("绑定信息");}?> </p>
</div>

<div style="width:150px; margin:30px auto 10px auto;">
	<img src="images/zhifu/zf_logo.png" width="140" height="120px" alt="" />
</div>

<div class="out_money_content">
    <form  method="post" id="paymentform" action ="<?= $actionUrl ?>" >
        <?php if($type == '0'){?>
            <div class="out_block">
                <label for="amount">支付金额&nbsp;</label>
                <input name="amount" type="text" placeholder="&nbsp;付款必须大于2元" value ='<?= $amount?>' id="amount" onkeyup="return ValidateNumber(this,value)" class="text_sty" />
            </div>
        <?php }?>
        <div id="payInfoContainer" style="<?php if ($status == "1" ){?> display: none; <?php } else {?> diplay:block; <?php }?>">

            <?php if($type == '1'){?>
                <div class="out_block">
                    <label for="amount">绑定最小金额: 2 元 </label>
                    <input name="amount" type="hidden" value ='2' id="amount" />
                </div>
            <?php }?>

        	<div class="out_block">

                <label for="bankcode">支付银行&nbsp;</label>

                <select name="bankcode"   id="tech" onchange="bankSelection()" style="height:40px; width:150px; border-radius:5px; border:2px #88C8FF dotted; ">

                    <option value="B" data-image="images/payment/img_bankabc.gif" <?php if($bank_code == 'ABC_D_B2C'){echo("selected");}?>></option>
                    <option value="C" data-image="images/payment/bank_boc.gif" <?php if($bank_code == 'BOCSH_D_B2C'){echo("selected");}?>></option>
                    <option value="D" data-image="images/payment/bank_ccb.gif" <?php if($bank_code == 'CCB_D_B2C'){echo("selected");}?> ></option>
                    <option value="E" data-image="images/payment/img_bankbocom.gif"  <?php if($bank_code == 'COMM_D_B2C'){echo("selected");}?>></option>
                    <option value="F" data-image="images/payment/bank_post.gif" <?php if($bank_code == 'POSTGC_D_B2C'){echo("selected");}?>></option>
                    <option value="G" data-image="images/payment/img_bankceb.gif" <?php if($bank_code == 'CEB_D_B2C'){echo("selected");}?>></option>
                    <option value="H" data-image="images/payment/img_bankcitic.gif"  <?php if($bank_code == 'CNCB_D_B2C'){echo("selected");}?>></option>
                    <option value="I" data-image="images/payment/img_bankhxbc.gif" <?php if($bank_code == 'HXB_D_B2C'){echo("selected");}?>></option>
                    <option value="J" data-image="images/payment/img_bankspdb.gif" <?php if($bank_code == 'SPDB_D_B2C'){echo("selected");}?>></option>
                    <option value="K" data-image="images/payment/img_bankcmbc.gif"  <?php if($bank_code == 'CMBCD_D_B2C'){echo("selected");}?>></option>
                    <option value="L" data-image="images/payment/bank_pab.gif"  <?php if($bank_code == 'PINGAN_D_B2C'){echo("selected");}?> ></option>
                    <option value="M" data-image="images/payment/img_bankgdb.gif" <?php if($bank_code == 'GDB_D_B2C'){echo("selected");}?> ></option>
                    <option value="N" data-image="images/payment/img_bankcib.gif"  <?php if($bank_code == 'CIB_D_B2C'){echo("selected");}?>></option>
                    <option value="A" data-image="images/payment/ICBC.gif" <?php if($bank_code == 'ICBC_D_B2C'){echo("selected");}?> ></option>

                </select>

                	
            </div>

            <div class="out_block">
                <label for="realname">姓<span style="margin:16px;"></span>名&nbsp;</label>
                <input name="realname" type="text"  value ='<?= $real_name?>' id="realname" class="text_sty"/>
            </div>
            <div class="out_block">
                <label for="cardno">银行卡号&nbsp;</label>
                <input name="cardno" type="text"   id="cardno"  value ='<?= $card_no?>' onkeyup="return ValidateNumber(this,value)" class="text_sty"/>
            </div>
            <div class="out_block">
                <label for="certno">身份证号&nbsp;</label>
                <input name="certno" type="text"   id="certno"  value ='<?= $cert_no?>' onkeyup="return ValidateNumber(this,value)" class="text_sty"/>
            </div>

            <div class="out_block">
                <label for="cardbindmobilephoneno">银行预留手机号&nbsp;</label>
                <input name="cardbindmobilephoneno" type="text"  value ='<?= $card_bind_mobile_phone_no?>' id="cardbindmobilephoneno" placeholder="必须是银行卡的绑定手机" onkeyup="return ValidateNumber(this,value)" style="width:140px;" class="text_sty" />
            </div>
            <input name="usedefault" type="hidden" id="usedefault" value =<?=$status?> />

        </div>

        <?php if ($status == "1" ){?>
                <div id="bindInfoContainer" class="out_block">
                    当前绑定银行卡：<input type="text" readonly value='<?= $binded_card_no?>' class="text_sty" />
                    <input type="button" value="更换银行" onclick="changeBank()"/>
                </div>
        <?php }?>

        <?php echo validation_errors();?>
        <div id="display"></div>
        <div class="account_content">
            <div class="invests" id="smsbutton" style="<?php if ($status == "1" && $type=="1" ){?> display: none; <?php } else {?> diplay:block; <?php }?>">
                <input value="获取验证码"  class="button tuichu" type="button" onclick="return checkInputValue()"> 
            </div>
        </div>

    </form>

</div>

</body>
</html>