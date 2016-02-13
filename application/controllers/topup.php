<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/19
 * Time: 21:29
 */
class Topup extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // include APPPATH . 'third_party/payment/safeepayCommon.php';

    }
    public function index()
    {
        $data["errormsg"] = "";
        //$this->load->view("out_money_page",$data);
        $this->beiTopupPageOne(0); // type 0 is pay info, 1 is binding
    }


/////////////////////////////////////////////////////////////////////
//ebatong
//////////////////////////////////////////////////////////////////////
    private $accountkey = "8Q9ZQ94KF539UI1G3BH0SA8CMIW0LQaxgece";
    private $account = "201510261536537283";
    private $simulateMode =false;





    ///////////////////////////
    public function bindingPageOne(){
        $this->load->library("session");
        $user = $this->session->userdata("user");
        if ($user == null) {
            redirect('/login/index/6', 'refresh');
        }
        $this->beiTopupPageOne(1); // type 0 is pay info, 1 is binding
    }
    ////////////////

    ///init the first step for beifu
    public function beiTopupPageOne($type)
    {
        $this->load->library("session");
        $user = $this->session->userdata("user");
        if ($user == null) {
            redirect('/login/index/5', 'refresh');
        }
        $this->load->library("form_validation");
        $paymethod = 1;
        if ($paymethod == 1) { // select the bank payment
            $this->load->model("User_model");
            $user = $this->session->userdata("user");
            $bankCardResult = $this->User_model->getBankCard($user["loginUser_id"]);
            $tradeNo = str_pad($user["loginUser_id"] . "u" . rand(1000, 9999) . "00504" . rand(1000, 9999), 16, "0", 1);


            $accountInfo = array(
                'bank_card_no'=>$bankCardResult["bank_card_no"],
                'real_name'=>$bankCardResult["real_name"],
                "cert_no"=>$bankCardResult["cert_no"],
                "card_bind_mobile_phone_no"=>$bankCardResult["card_bind_mobile_phone_no"],
                "bank_code"=>$bankCardResult["bank_code"],
                "customer_id"=>$user["loginUser"],
                "out_trade_no"=>$tradeNo,
                "type"=>$type
             );

            $this->session->set_userdata('accountInfo',$accountInfo);

            $params = array
            (
                "actionUrl" => site_url("topup/beiTopUpStep3SmsVerify"),
                "bank_code" => $bankCardResult["bank_code"],
                "card_bind_mobile_phone_no" => $bankCardResult["card_bind_mobile_phone_no"],
                "status"=>$bankCardResult["status"],
                "type"=>$type
            );
            if($params["status"]=="1"){
                $str=$bankCardResult["bank_card_no"];

                $prenum = substr($str,0,6);
                $lastnum = substr($str, 15);
                $str = $prenum."*********".$lastnum ;
                $params["binded_card_no"]=$str;
            }

            // check binding infomation
            $str = "show bank account page---" . json_encode($params);
            $this->logInfomation($str);
            $this->load->view("out_money_detail_bei_page", $params);
        } else { // select the wechat payment
            $data["errormsg"] = iconv("GB2312", "UTF-8", "不支持此付款方式");
            $str = "not support wechat payment--" . json_encode($data);
            $this->logInfomation($str);
            $this->load->view("out_money_page", $data);
        }
    }
    ///change selected bankcode will call here
    public function beiTopUpPageOneChangeBank()
    {

        $this->load->library("session");
        $user = $this->session->userdata("user");
        $accountInfo = $this->session->userdata("accountInfo");
        if ($user == null) {
            redirect('/login/index/5', 'refresh');
        }
        $this->session->set_userdata('topupStep', 1);
        $step = $this->session->userdata("topupStep");
        $this->load->library("form_validation");
        $params["amount"] = $this->input->post("amount");
        $params["bankcode"]  = $this->bankcardmap($this->input->post("bankcode"));
        $params["realname"]  = $this->input->post("realname");
        $params["cardno"]  = $this->input->post("cardno");
        $params["certno"]  = $this->input->post("certno");
        $params["cardbindmobilephoneno"]  = $this->input->post("cardbindmobilephoneno");
        $params["status"]="2";
        $params["type"]=$accountInfo["type"];
        $this->logInfomation("change  selected bank card --" . json_encode($params));
        $this->backToTopupPageOne($params);
    }
    //转入支付信息填写页面
    public function backToTopupPageOne($datas)
    {
        $params = array
        (
            "actionUrl" => site_url("topup/beiTopUpStep3SmsVerify"),
            "card_no" => $datas["cardno"],
            "real_name" => $datas["realname"],
            "cert_no" => $datas["certno"],
            "amount" => $datas["amount"],
            "bank_code" =>$datas["bankcode"],
            "card_bind_mobile_phone_no" => $datas["cardbindmobilephoneno"],
            "status"=>$datas["status"],
            "type"=>$datas["type"]
        );

        $str = "return to bank acount page--" . json_encode($params);
        $this->logInfomation($str);
        $this->load->view("out_money_detail_bei_page", $params);
    }

    // load this sms verify code page
    public function beiTopUpStep3SmsVerify()
    {
        $usedefault = $this->input->post("usedefault");
        $amount = $this->input->post("amount");
        $this->load->library("session");
        $user = $this->session->userdata("user");
        $this->load->library("form_validation");
        $bool = $this->form_validation->run("beitopupstep2");

        if ($user == null) {
            redirect('/login/index/5', 'refresh');
        }
        $accountInfo = $this->session->userdata("accountInfo");

        if($usedefault =="1"){
            $card_no = $accountInfo["bank_card_no"];
            $real_name = $accountInfo["real_name"];
            $cert_no = $accountInfo["cert_no"];
            $card_bind_mobile_phone_no = $accountInfo["card_bind_mobile_phone_no"];
            $newbankcode =  $accountInfo["bank_code"];
        }else {

            $card_no = $this->input->post("cardno");
            $real_name = $this->input->post("realname");
            $cert_no = $this->input->post("certno");
            $card_bind_mobile_phone_no = $this->input->post("cardbindmobilephoneno");
            $newbankcode = $this->bankcardmap($this->input->post("bankcode"));
        }

        $extral["errormsg"] = "";
        $tradeNo = $accountInfo["out_trade_no"];


        if ($bool) {
            $user = $this->session->userdata("user");

            if ($card_no == "" || $real_name == "" || $cert_no == "" || $card_bind_mobile_phone_no == "" || $newbankcode == "") {
                $card_no = "";
                $real_name = "";
                $cert_no = "";
                $card_bind_mobile_phone_no = "";
                $newbankcode = "";
            }

            $params = array
            (
                "service" => "ebatong_mp_dyncode",
                "partner" => $this->account,
                "input_charset" => "utf-8",
                "sign_type" => "MD5",
                "customer_id" => $user["loginUser"],
                "card_no" => $card_no,
                "real_name" => $real_name,
                "cert_no" => $cert_no,
                "cert_type" => "01",
                "amount" => $amount,
                "out_trade_no" => $tradeNo,
                "bank_code" => $newbankcode,
                "card_bind_mobile_phone_no" => $card_bind_mobile_phone_no,
            );

            $params['sign'] = $this->dataSigning($params);

            $this->logInfomation("send sms verify code start----");
            $tokenreply = $this->sendBeiVerifyCode($params); // get ooken

            $this->logInfomation("send sms verify code end----");

            $accountInfo["bank_card_no"] = $params["card_no"];
            $accountInfo["default_bank"] = $params["bank_code"];
            $accountInfo["dynamic_code_token"] = $tokenreply["token"];
            $accountInfo["total_fee"] = $params["amount"];
            $accountInfo['real_name']=$params["real_name"];
            $accountInfo["cert_no"]=$params["cert_no"];
            $accountInfo["card_bind_mobile_phone_no"]=$params["card_bind_mobile_phone_no"];
            $accountInfo["total_fee"]=$params["amount"];
            $accountInfo["out_trade_no"]=$params["out_trade_no"];
            $this->session->set_userdata('accountInfo',$accountInfo);



            $params["errormsg"] = "";
            if ($tokenreply["result"] == "F") {
                $params["errormsg"] = $tokenreply['error_message'];
                $params["hasError"] = true;
            }else{
                $params["errormsg"] = iconv('GB2312', 'UTF-8', "验证码下发成功，请查收");
                $params["hasError"] = false ;
            }
            $params["type"]=$accountInfo["type"];
            $params["actionUrl"] = site_url("topup/beiTopUpStep4WithToken");
            $str = "load sms verify page--" . json_encode($params);
            $this->logInfomation($str);
            $this->load->view("out_money_detail_bei_token_page", $params);
        } else {
            $params =array();
            $params["amount"] = $amount;
            $params["bankcode"]  = $newbankcode;
            $params["realname"]  = $real_name;
            $params["cardno"]  = $card_no;
            $params["certno"]  = $cert_no;
            $params["cardbindmobilephoneno"]  = $card_bind_mobile_phone_no;
            $params["type"]=$accountInfo["type"];
            $this->backToTopupPageOne($params);
        }

    }




    public function beiTopUpStep4WithToken()
    {

        require_once(APPPATH . 'third_party/payment/Realtime.php');
        $key = $this->accountkey;
        $this->load->library("session");
        $user = $this->session->userdata("user");
        if ($user == null) {
            return;
        }
        {

            $user = $this->session->userdata("user");
            $accountInfo = $this->session->userdata("accountInfo");
            $time = new Realtime();
            $realtime = $time->getRealTime($key, "utf-8", $this->account);
            $params = array
            (
                "sign_type" => "MD5",
                "service" => "create_direct_pay_by_mp",
                "partner" => $this->account,
                "input_charset" => "utf-8",
                "notify_url" => site_url("topup/beiTopUpPageUrl"),
                "customer_id" => $accountInfo["customer_id"],
                "dynamic_code_token" => $accountInfo["dynamic_code_token"],
                "dynamic_code" => $this->input->post("dynamic_code"),
                "bank_card_no" => $accountInfo["bank_card_no"],
                "real_name" => $accountInfo["real_name"],
                "cert_no" => $accountInfo["cert_no"],
                "cert_type" => "01",
                "out_trade_no" => $accountInfo["out_trade_no"],
                "card_bind_mobile_phone_no" => $accountInfo["card_bind_mobile_phone_no"],
                "subject" =>  iconv('GB2312', 'UTF-8', "账号充值"),
                "total_fee" => $accountInfo["total_fee"],
                "body" => iconv('GB2312', 'UTF-8', "账号充值"),
                "show_url" => "",
                "pay_method" => "bankPay",
                "exter_invoke_ip" => $this->ip_address(),
                'anti_phishing_key' => $realtime,
                "extra_common_param" =>"",
                "extend_param" => "",
                "default_bank" => $accountInfo["default_bank"],
            );

            $params['sign'] = $this->dataSigning($params);
            $reqData = $params;
            //var_dump($reqData);
            $params["actionUrl"] = 'https://www.ebatong.com/mobileFast/pay.htm';
            $this->session->set_userdata('OrderMoney', $params["total_fee"]);
            setcookie('OrderMoney', $params["total_fee"], time() + 86400, "/");
            $this->load->model("User_model");
            $data = array(
                "amount" => $params["total_fee"],
                "type" => 1,
                "user_id" => $user["loginUser_id"],
                "payment" => 29,
                "remark" => iconv('GB2312', 'UTF-8', "贝付"),
                "out_trade_no" => $params["out_trade_no"],
            );
            $this->load->model("User_model");
            $this->logInfomation("insert in to record pay and params are ". json_encode( $data));
            $this->User_model->insertRecordPayment($data);
            $bankCardResult = $this->User_model->getBankCard($user["loginUser_id"]);
            $bankdata =array("status"=>0,
                "user_id"=>$user["loginUser_id"],
                "payment_id"=>$accountInfo["out_trade_no"],
                "real_name"=>$accountInfo["real_name"],
                "cert_no"=>$accountInfo["cert_no"],
                "cert_type"=>"01",
                "bank_code"=>$accountInfo["default_bank"],
                "bank_name"=>"",
                "bank_card_no"=>$accountInfo["bank_card_no"],
                "card_bind_mobile_phone_no"=>$accountInfo["card_bind_mobile_phone_no"]
            );
            //var_dump($bankdata);
            if($bankCardResult["status"]==-1){
                $bankdata["type"]=2;
                $this->User_model->updateBankInfo($bankdata);
            }
//            else {
//                $bankdata["type"]=1;
//                $this->User_model->updateBankInfo($bankdata);
//            }

            $this->logInfomation("pay request start-----" );
            if($this->simulateMode) {
                $url=site_url("topup/finalPaySimulate");
            }else {
                $url = "https://www.ebatong.com/mobileFast/pay.htm";
            }

            $result = $this->sendQueryRequestToBei($reqData, $url);
            //var_dump($result);
            $this->logInfomation("pay request return-----" );
            $this->beiReturnAnalyse($result,$accountInfo["type"] );
        }
    }



    public function logInfomation($msg)
    {
        $str = date("Y-m-d h:i:sa") . '----' . $msg;
        log_message('debug', $str);
    }

    //发送短信验证吗请求, return the token
    private function sendBeiVerifyCode($params)
    {
        $this->logInfomation("send verify code---" . json_encode($params));
        if($this->simulateMode){
            $url = site_url("topup/testSmsVerifySimulate");
        }else {
            $url = "https://www.ebatong.com/mobileFast/getDynNum.htm";
        }

        $this->logInfomation( "send verify code start---");
        $result =$this->sendQueryRequestToBei($params,$url);
        $this->logInfomation( "send verify code return---");
        return $result;
    }

    //release the code
    public function beiReleaseBinding()
    {
        $this->load->library("session");
        $accountInfo = $this->session->userdata("accountInfo");
        $user = $this->session->userdata("user");
        if ($user == null) {
            redirect('/login/index/5', 'refresh');
        }

        $params = array(
            "service" => "ebatong_mp_unbind",
            "partner" => $this->account,
            "input_charset" => "utf-8",
            "sign_type" => "MD5",
            "notify_url" => "",
            "customer_id" => $accountInfo["customer_id"],
            "bank_card_no" => $accountInfo["binded_bank_card_no"],
            "out_trade_no" => $accountInfo["out_trade_no"],
            "card_bind_mobile_phone_no" => "",
            "subject" => "",
        );
        $params['sign'] = $this->dataSigning($params);

        $this->logInfomation("send release binding start---");
        if($this->simulateMode){
            $url=site_url("topup/bindingReleaseSinmulate");
        }else {
            $url = "https://www.ebatong.com/mobileFast/unbind.htm";
        }
        $result = $this->sendQueryRequestToBei($params, $url);

        //var_dump($result);
        $this->logInfomation("send release binding return---");


        if($result["result"]=='T'){
            //update database to set released status
            $this->load->model("User_model");
            $this->logInfomation("--result is true, and update bankInfo");
            if($accountInfo["customer_id"]!="") {
                $this->User_model->updateBankInfo(array("type" => 0, "status" => 0, "user_id" => $user["loginUser_id"]));
            }
        }

        $reply = array(
            "result"=>$result["result"],
            "error_message"=>$result["error_message"]
        );

        echo json_encode($reply);

    }



    private function sendQueryRequestToBei($params, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        $str = "send request to --- ".$url."---and params is---" . json_encode($params);
        $this->logInfomation($str);
        $result = curl_exec($ch);
        curl_close($ch);
        $str = "request return from --- ".$url."---and result is---" . json_encode($result);
        $this->logInfomation($str);

        $result = json_decode($result, true);
        return $result;
    }

    private function dataSigning($params){

        $str = "data sign input is---" . json_encode($params);
        $this->logInfomation($str);

        $key = $this->accountkey;
        $paramKey = array_keys($params);
        sort($paramKey);
        $md5src = "";
        $i = 0;
        $paramStr = "";
        foreach ($paramKey as $arraykey) {
            if ($i == 0) {
                $paramStr .= $arraykey . "=" . $params[$arraykey];
            } else {
                $paramStr .= "&" . $arraykey . "=" . $params[$arraykey];
            }
            $i++;
        }
        $md5src .= $paramStr . $key;
        $sign = md5($md5src);
        return $sign;
    }

    private function dataReturnSigning($params){
        $key = $this->accountkey;

        $str = "dataReturnSigning key is ".$key." params is ---" . json_encode($params);
        $this->logInfomation($str);

        $paramKey = array_keys($params);
        sort($paramKey);
        $md5src = "";
        $i = 0;
        $paramStr = "";
        foreach ($paramKey as $arraykey) {
            if (strcmp($arraykey, "sign") == 0) {
            } else {
                if ($i == 0) {
                    $paramStr .= $arraykey . "=" . $params[$arraykey];
                } else {
                    $paramStr .= "&" . $arraykey . "=" . $params[$arraykey];
                }
                $i++;
            }
        }
        $md5src .= $paramStr . $key;
        $sign = md5($md5src);
        $str = "dataReturnSigning md5src is ---" . $md5src . " and sign is " . $sign;
        $this->logInfomation($str);
        return $sign;
    }


    private function beiReturnAnalyse($params ,$type)
    {
        //var_dump($params);
        require_once(APPPATH . 'third_party/payment/log.php');
        // $params = $this->input->post();
        $this->load->library("session");
        $user = $this->session->userdata("user");
        if ($user == null) {
            redirect('/login/index/5', 'refresh');
        }
        $str = "return from final pay request" . json_encode($params);
        $this->logInfomation($str);
        // header("content-type:text/html; charset=utf-8");
        $checkSign = $params['sign'];
        //获取参数后同加签流程进行验签

        $sign = $this->dataReturnSigning($params);
        $accountInfo = $this->session->userdata("accountInfo");
        $bankdata =array("status"=>1,
            "user_id"=>$user["loginUser_id"],
            "payment_id"=>$accountInfo["out_trade_no"],
            "real_name"=>$accountInfo["real_name"],
            "cert_no"=>$accountInfo["cert_no"],
            "cert_type"=>"01",
            "bank_code"=>$accountInfo["default_bank"],
            "bank_name"=>"",
            "bank_card_no"=>$accountInfo["bank_card_no"],
            "card_bind_mobile_phone_no"=>$accountInfo["card_bind_mobile_phone_no"],
            "type"=>1
        );
       $this->session->unset_userdata('accountInfo');

        if (strcmp($checkSign, $sign) == 0) {       //验签通过，数据安全

            $this->logInfomation("check sign , is same---");

            $trade_status = $params["trade_status"];//交易状态
            if (strcmp($trade_status, "T") == 0) {  //交易成功
                $this->logInfomation("check trade_status , is T---");

                if (isset($_SESSION['OrderMoney'])) {
                    $OrderMoney = $_SESSION['OrderMoney'];//获取提交金额的Session
                } else {
                    if (isset($_COOKIE['OrderMoney'])) {
                        $OrderMoney = $_COOKIE['OrderMoney'];
                        setcookie("OrderMoney", "", time() - 3600);
                    } else {
                        $OrderMoney = 0;
                    }
                }

                $str = "OrderMoney is  ---" . $OrderMoney . " --- params fee is " . $params["total_fee"];
                $this->logInfomation($str);

                if ($OrderMoney == $params["total_fee"]) {
                    $this->logInfomation("check fee is same , trade num is ". $params["out_trade_no"]);
                    $this->load->model("User_model");
                    $this->User_model->OnlineReturn(array("trade_no" => $params["out_trade_no"]));
                    $this->logInfomation("update bank info");
                    $this->User_model->updateBankInfo($bankdata);

                    if ($type == 0) {
                        $test = "/showmsg/index/" . urlencode("充值") . "/" . urlencode("支付成功");
                    }else{
                        $test = "/showmsg/index/" . urlencode("手机绑定") . "/" . urlencode("绑定成功");
                    }
                    //echo iconv("GB2312","UTF-8",'支付成功');
                    //echo $test;
                   redirect($test, 'refresh');
                } else {
                    //echo("<script>alert(iconv('GB2312', 'UTF-8','实际成交金额与您提交的订单金额不一致，请接收到支付结果后仔细核对实际成交金额，以免造成订单金额处理差错。'));</script>");
                    if ($type == 0){
                        $test = "/showmsg/index/" . urlencode("充值") . "/" . urlencode('实际成交金额与您提交的订单金额不一致，请接收到支付结果后仔细核对实际成交金额，以免造成订单金额处理差错。'). "/topup" ;
                    }else{
                        $test = "/showmsg/index/" . urlencode("手机绑定") . "/" . urlencode('绑定错误，联系管理员。')."/topup/bindingPageOne";

                    }
                    //echo $test;
                    redirect($test, 'refresh');
                }
            } else {    //支付失败 订单为待处理，可继续支付

                $replyInfo= array();
                if ($type == 0) {
                    $replyInfo["title"]= iconv('GB2312', 'UTF-8','充值');
                    $replyInfo["status"]= iconv('GB2312', 'UTF-8','交易失败，请重试');
                    $replyInfo["error"]= $params["error_message"];
                    $replyInfo["return"]= 'topup';

                }else {
                    $replyInfo["title"] = iconv('GB2312', 'UTF-8', '手机绑定');
                    $replyInfo["status"] = iconv('GB2312', 'UTF-8', '手机绑定失败，请重试');
                    $replyInfo["error"] = $params["error_message"];
                    $replyInfo["return"] = 'topupbindingPageOne';
                }
                $this->session->set_flashdata('message',$replyInfo);
                redirect('showmsg/showInfo');

            }
        }
    }

    public function beiTopUpPageUrl()
    {
        $this->logInfomation("call back from beifu - beiTopUpPageUrl----");
        $params = $this->input->post();
        $result = json_decode($params, true);
        try {
            $this->logInfomation("call back from beifu - beiTopUpPageUrl and params is not json? " . $params);
            $this->logInfomation("call back from beifu - beiTopUpPageUrl and params is json" . json_encode($params));
        }catch (Exception $e){
            $this->logInfomation("call back from beifu error ---  caught exception". $e->getMessage());
        }
        $result = json_decode($params, true);
        //var_dump($params);
        $this->beiReturnAnalyse($params , 0);
    }

    public function check_bindphonenum()
    {
        $phonenum = $this->input->post('cardbindmobilephoneno');
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/", $phonenum)) {
            $this->form_validation->set_message('check_bindphonenum', iconv('GB2312', 'UTF-8', '输入手机格式不正确'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function ip_address()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip_address = $_SERVER["HTTP_CLIENT_IP"];
        } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip_address = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        } else if (!empty($_SERVER["REMOTE_ADDR"])) {
            $ip_address = $_SERVER["REMOTE_ADDR"];
        }
        return $ip_address;
    }

    public function beiCardBindingReturnUrl()
    {
        $params = $this->input->post();
        //var_dump($params);
        $this->beiReturnAnalyse($params , 1);
    }
    public function checkBankAccountInfo(){

        $this->load->library("session");
        $user = $this->session->userdata("user");
        if ($user == null) {
            redirect('/login/index/5', 'refresh');
        }

        $accountInfo = $this->session->userdata("accountInfo");
        $params = array
        (
            "service" => "query_bind_card_info",
            "partner" => $this->account,
            "input_charset" => "utf-8",
            "sign_type" => "MD5",
            "customer_id" =>$accountInfo["customer_id"],
        );

        $params['sign'] = $this->dataSigning($params);
        //var_dump($params);
        $url = "https://www.ebatong.com/mobileFast/queryCardInfo.htm";

        $this->logInfomation( "check bank account start -----");
        $result = $this->sendQueryRequestToBei($params,$url);
        $this->logInfomation( "check bank account return  -----");

    //var_dump($result);
        $reply = array(
            "result"=>$result["result"],
            "bank_card_num" =>$result["bank_card_num"],
            "error_message"=>$result["error_message"],
           // "isBinded"=> false,
        );

        $bindList =$result["card_bind_list"];
        if($bindList!=""){
            $strset = explode("^", $bindList);
            $accountInfo["binded_bank_card_no"] = $strset[0];
        }else{
            $accountInfo["binded_bank_card_no"]="";
        }
        $this->session->set_userdata('accountInfo',$accountInfo);

//        //var_dump($result);
//        if($result["result"]=== "T"){
//            $cardno =$this->input->post("bandcardno");
//            $pos = strpos( $result["card_bind_list"],$cardno);
//            if($pos === false){
//                $reply["isBinded"] = false;
//            }else{
//                $reply["isBinded"] = true;
//            }
//        }
        echo json_encode($reply);
    }





    public function random(){
        $out = rand ( 0 , 100);
        if($out % 2  ){
            return true;
        }else{
            return false;
        }
    }


    public function finalPaySimulate(){

        $this->load->library("session");
        $accountInfo = $this->session->userdata("accountInfo");

        $para = array(
            "body"=>iconv('GB2312', 'UTF-8', "账号充值") ,
            "subject"=>iconv('GB2312', 'UTF-8', "账号充值"),
            "sign_type"=>  "MD5",
            "input_charset"=>  "utf-8" ,
            "notify_url"=> "",
            "out_trade_no"=> "212u3133005048572",
            "trade_status"=>  "T" ,
            "extra_common_param"=> "",
            "total_fee"=> "1000",
            "error_message"=> iconv('GB2312', 'UTF-8', "错误情况"),
            "service"=>  "",
            "partner"=> "",
            "customer_id"=> "aslin3344"
        );

        if($this->random()){
            $para["result"] ="T";
            $para["error_message"]="";
        }
        else{
            $para["result"] ="F";
        }
        $paramKey = array_keys($para);
        sort($paramKey);
        $md5src = "";
        $i = 0;
        $paramStr = "";
        foreach ($paramKey as $arraykey) {
            if ($i == 0) {
                $paramStr .= $arraykey . "=" . $para[$arraykey];
            } else {
                $paramStr .= "&" . $arraykey . "=" . $para[$arraykey];
            }
            $i++;
        }
        $md5src .= $paramStr . $this->accountkey;
        $sign = md5($md5src);
        $para['sign'] = $sign;
        echo json_encode($para);
    }
    public function testSmsVerifySimulate(){

        $this->load->library("session");
        $accountInfo = $this->session->userdata("accountInfo");

        $para = array(
            "sign"=>"431610b47ad9dc3fd2e19093f3e175cd",
            "amount"=>"1",
            "result"=>"T",
            "token"=>"201512122004335230",
            "sign_type"=>"MD5",
            "error_message"=>"ddddd",
            "input_charset"=>"utf-8",
            "service"=>"ebatong_mp_dyncode",
            "partner"=>"201510261536537283",
            "out_trade_no"=>$accountInfo["out_trade_no"],
            "customer_id"=>$accountInfo["customer_id"]
        );
//        if($this->random()){
        if(true){
            $para["result"] ="T";
            $para["error_message"]="";
        }
        else{
            $para["result"] ="F";
        }
        echo json_encode($para);
    }
    public function bindingReleaseSinmulate(){
        $para = array(
            "sign"=>"ef73d8f0beb1eca5ffc05c7d6ba57698",
            "result"=>"T",
            "subject"=>iconv('GB2312', 'UTF-8', "账号充值"),
            "sign_type"=>"MD5",
            "error_message"=>iconv('GB2312', 'UTF-8', "错误情况"),
            "input_charset"=>"utf-8",
            "service"=>"ebatong_mp_unbind",
            "partner"=>"201510261536537283",
            "bank_card_no"=>"6232086400001475856",
            "out_trade_no"=>"212u7198005044914",
            "customer_id"=>"aslin3344"
        );
        if($this->random()){
            $para["result"] ="T";
            $para["error_message"]="";
        }
        else{
            $para["result"] ="F";
        }
        echo json_encode($para);
    }

    private function bankcardmap($value){
        if($value=="A"){
            return "ICBC_D_B2C";//工商银行
        }else if ($value=="B"){
            return "ABC_D_B2C";//农业银行
        }else if ($value=="C"){
            return "BOCSH_D_B2C";//中国银行
        }else if ($value=="D"){
            return "CCB_D_B2C";//建设银行
        }else if ($value=="E"){
            return "COMM_D_B2C";//交通银行
        }else if ($value=="F"){
            return "POSTGC_D_B2C";//中国邮政
        }else if ($value=="G"){
            return "CEB_D_B2C";//光大银行
        }else if ($value=="H"){
            return "CNCB_D_B2C";//中信银行
        }else if ($value=="I"){
            return "HXB_D_B2C";//华夏银行
        }else if ($value=="J"){
            return "SPDB_D_B2C";//浦发银行
        }else if ($value=="K"){
            return "CMBCD_D_B2C";//民生银行
        }else if ($value=="L"){
            return "PINGAN_D_B2C";//平安银行
        }else if ($value=="M"){
            return "GDB_D_B2C";//广发银行
        }else if ($value=="N"){
            return "CIB_D_B2C";//兴业银行
        }else{
            return "ICBC_D_B2C";//工商银行
        }
    }

    public function testInsert(){

        $this->load->model("User_model");
        $bankCardResult = $this->User_model->getBankCard(29);
        $bankdata =array("status"=>0,
            "user_id"=>29,
            "payment_id"=>"111",
            "real_name"=>"333",
            "cert_no"=>"4444",
            "cert_type"=>"02",
            "bank_code"=>"abcde",
            "bank_name"=>"",
            "bank_card_no"=>"sdfsdfsdf",
            "card_bind_mobile_phone_no"=>"11363527"
        );

        if($bankCardResult["status"]==-1){
            $bankdata["type"]=2;
            $this->User_model->updateBankInfo($bankdata);
        }else {
            $bankdata["type"]=1;
            $this->User_model->updateBankInfo($bankdata);
        }
    }

    public function testMsgInfo(){
        $this->load->library("session");
        $data = array('title'=>'林伟','status'=>'lastname', 'errormsg'=>'礼物','return'=>'topup');
        $this->session->set_flashdata('message',$data);
        redirect('showmsg/showInfo');

    }


}
