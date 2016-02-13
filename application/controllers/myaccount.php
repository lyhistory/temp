<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/9
 * Time: 21:24
 */

class Myaccount  extends CI_Controller {

    public function check_login(){
        $this->load->library("session");
        $user = $this->session->userdata("user");
        if($user!= null && $user["isLogin"]==1){
            return $user;
        }else{
            return false;
        }
    }


    public function account()
    {
        if(($user=self::check_login())!=false) {
            $input["username"] = $user["loginUser"];
            $data=self::getDetailInfo($input);
            $this->load->view('my_account_page',$data);
        }else{
            redirect('/login/index/2', 'refresh');
        }
    }
    public function setting()
    {
        if(($user=self::check_login())!=false) {
            $input["username"] = $user["loginUser"];
            $data=self::getDetailInfo($input);
            $this->load->view('my_setting_page',$data);
        }else{
            redirect('/login/index/1', 'refresh');
        }
    }
    public function getDetailInfo($input =array()){

        $sql="select * from yyd_users where username='".$input["username"]."'";
        $this->load->model("User_model");
        $this->load->model("Borrow_model");
        $result=$this->User_model->db_fetch_array($sql);
        $input["user_id"]=$result["user_id"];
        $_list["user_name"]=$result["username"];
        //注册时间：
        $_list["register_date"]=date ('Y-m-d H:i:s',$result["reg_time"]);
        //最后登录时间：
        $_list["last_date"]=date ('Y-m-d H:i:s',$result["last_time"]);
        $result=$this->Borrow_model->GetBorrowCredit($input);
        $_list["approve_credit"]=$result["approve_credit"];
        $result=$this->Borrow_model->GetUserCount($input);
        //已赚收益:
        $_list["e_total"]=$this->Borrow_model->IsExist($result["tender_interest_yes"])?$result["tender_interest_yes"]:0;
        //已赚罚息
        $_list["e_fine"]=$this->Borrow_model->IsExist($result["all_late_interest"])?$result["all_late_interest"]:0;
        //已赚违约金
        $_list["e_weiyue"]=$this->Borrow_model->IsExist($result["weiyue"])?$result["weiyue"]:0;
        //待收金额:
        $_list["e_wait"]=$this->Borrow_model->IsExist($result["await"])?$result["await"]:0;
        //已赚奖励
        $_list["e_bonus"]=$this->Borrow_model->IsExist($result["award_add"])?$result["award_add"]:0;
        //待回收本息
        $_list["e_total_wait"]=$this->Borrow_model->IsExist($result["tender_recover_wait"])?$result["tender_recover_wait"]:0;
        //已回收本息:
        $_list["a_total_ready"]=$this->Borrow_model->IsExist($result["tender_recover_yes"])?$result["tender_recover_yes"]:0;
        //借款总额
        $_list["c_total"]=$this->Borrow_model->IsExist($result["borrow_account"])?$result["borrow_account"]:0;
        //发布借款笔数
        $_list["c_total_num"]=$this->Borrow_model->IsExist($result["borrow_times"])?$result["borrow_times"]:0;
        //已还本息
        $_list["c_pay_total"]=$this->Borrow_model->IsExist($result["borrow_repay_yes"])?$result["borrow_repay_yes"]:0;
        //待还本息
        $_list["c_unpay_total"]=$this->Borrow_model->IsExist($result["borrow_repay_wait"])?$result["borrow_repay_wait"]:0;
        $_list["num_record"]=$this->Borrow_model->IsExist($result["borrow_times"])?$result["borrow_times"]:0;//条筹资记录
        $_list["num_apply"]=$this->Borrow_model->IsExist($result["tender_times"])?$result["tender_times"]:0; //条投标记录



        $result = $this->Borrow_model->GetAmountUsers($input);
        $_list["a_credit_amount"]=$result["borrow_amount"];//信用额度:
        $_list["a_valid_c_amount"]=$result["borrow_amount_use"];//可用额度:

        $result=$this->Borrow_model->GetRechargeCount_log($input);
        //充值成功总额
        $_list["a_suc_d"]=$this->Borrow_model->IsExist($result["recharge_all"])?$result["recharge_all"]:0;
        //在线充值总额
        $_list["a_online_d"]=$this->Borrow_model->IsExist($result["recharge_all_up"])?$result["recharge_all_up"]:0;
        //线下充值总额
        $_list["a_offline_d"]=$this->Borrow_model->IsExist($result["recharge_all_down"])?$result["recharge_all_down"]:0;
        //手动充值总额
        $_list["a_manual_d"]=$this->Borrow_model->IsExist($result["recharge_all_other"])?$result["recharge_all_other"]:0;

        $result=$this->Borrow_model->GetAccountInfo($input);
        //账户总额
        $_list["a_total"]=$this->Borrow_model->IsExist($result["total"])?$result["total"]:0;
        //可用余额
        $_list["a_remain"]=$this->Borrow_model->IsExist($result["balance"])?$result["balance"]:0;
        //冻结余额
        $_list["a_freeze"]=$this->Borrow_model->IsExist($result["frost"])?$result["frost"]:0;
        //待收金额
        $_list["a_wait"]=$this->Borrow_model->IsExist($result["await"])?$result["await"]:0;
        //提现成功总额
        $_list["a_suc_r"]=$this->Borrow_model->IsExist($result["account_log"]["cash_success"]["account"])?$result["account_log"]["cash_success"]["account"]:0;
        //成功笔数
        $_list["a_suc_r_num"]=$this->Borrow_model->IsExist($result["account_log"]["cash_success"]["num"])?$result["account_log"]["cash_success"]["num"]:0;
        //认证信息
        $result= $this->User_model->getVerifyStatus($input);
        //邮箱认证：
        $_list["reg_email_status"]=$result['email_status'];
        $_list["reg_email"]=$result['email_address'];
        //手机认证：
        $_list["reg_phone_status"]=$result['phone_status'];
        $_list["reg_phone"]=$result['phone_num'];
        //身份认证：
        $_list["reg_ic_status"]=$result['realname_status'];
        $_list["reg_ic"]=$result['realname_name'];
        //视频认证：
        $_list["reg_video_status"]=$result['video_status'];

        return $_list;

    }
    public function passwordControl(){


        if(($user=self::check_login())!=false) {
            $this->load->view('pw_manage_page');
        }else{
            redirect('/login/index/5', 'refresh');
        }

    }
    public function resetPassword(){
        $this->load->library("form_validation");
        $user = self::check_login();
        $username = $user["loginUser"];
        $bool = $this->form_validation->run("resetPwd");
        $extral["errormsg"]="";
        if($bool){
            $capsdata= $this->input->post('verify');
            $caps =$this->session->get_userdata('cap');
            if($capsdata!= $caps['cap']){
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"验证码不正确");
                $this->load->view('register_page',$extral);
                return;
            }

            $newpwd = $this->input->post("newpassword");
            $newpwdmd5 = md5($newpwd);
            $this->db->query("Update yyd_users SET  password='$newpwdmd5' where  username='$username'");
            $this->session->unset_userdata('user');

            $test = "/showmsg/index/".urlencode("密码设置")."/".urlencode("密码重新设置成功");
            redirect( $test , 'refresh');

        }else{
            $this->load->view('set_pw_page',$extral);
        }

    }
    public function oldpassword_check($old_password)
    {
            $user = self::check_login();
            $this->load->model("User_model");
            $user = $this->User_model->get_user_by_username($user["loginUser"]);
            $oldpasswordmd5 = md5($old_password);
            if ($oldpasswordmd5 != $user["password"]) {
                $this->form_validation->set_message('oldpassword_check', iconv('GB2312', 'UTF-8', '旧密码不正确'));
                return FALSE;
            }
            return TRUE;

    }
    public function password_compare($newpasswordcmf){
        if( $this->input->post("newpassword")== $newpasswordcmf){
            return TRUE;
        }else{
            $this->form_validation->set_message('password_compare', iconv('GB2312', 'UTF-8', '新密码不相等'));
            return FALSE;
        }
    }
    public function setPayPassword(){

        $this->load->library("form_validation");
        $bool = $this->form_validation->run("setPayPwd");
        $this->load->model("User_model");
        $extral["errormsg"]="";

        if($bool){
            $user = self::check_login();
            $capsdata= $this->input->post('verify');
            $caps =$this->session->get_userdata('cap');
            if($capsdata!= $caps['cap']){
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"验证码不正确");
                $this->load->view('deposit_pw_page',$extral);
                return;
            }


            $data["user_id"]=$user["loginUser_id"];
            $data["password"] = $this->input->post("newpassword");
            $reply= $this->User_model->setDepositPwd($data);
            if($reply ==1){
                //$extral["errormsg"]=iconv('GB2312', 'UTF-8',"付款密码设置成功");
                $test = "/showmsg/index/".urlencode("付款密码")."/".urlencode("付款密码设置成功");
                redirect( $test , 'refresh');
            }else{
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"付款密码设置未成功");
                $this->load->view("deposit_pw_page",$extral);
            }
        }else
             $this->load->view("deposit_pw_page",$extral);
    }
    public function getPassword(){
        $this->load->library("form_validation");
        $bool = $this->form_validation->run("getPwd");
        $this->load->model("User_model");
        $extral["errormsg"]="";
        if($bool) {
            $user = self::check_login();
            $data["username"]=$this->input->post("username");
            $data["email"] = $this->input->post("email");
            $reply= $this->User_model->getPwd($data);
            if($reply ==1){
                $test = "/showmsg/index/".urlencode("获取新密码")."/".urlencode("新密码已发出,请查收");
                redirect( $test , 'refresh');
                //$extral["errormsg"]=iconv('GB2312', 'UTF-8',"新密码已发出， 请查收");
            }else{
                //$reply= "密码发送失败,原因".$reply;
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"密码发送失败,原因是：");
                $extral["errormsg"]=  $extral["errormsg"].$reply;
                $this->load->view("get_pw_page", $extral);
            }
        }else
            $this->load->view("get_pw_page", $extral);
    }

    public function sendMobileVerifyCode(){
            $this->load->model("Sms_model");
            $data["phone"] =$this->input->post("phonenum");
            $this->load->library("session");
            $user = $this->session->userdata("user");
            $data["user_id"] = $user["loginUser_id"];
            $this->load->model("Sms_model");
            $result =$this->Sms_model->CheckPhoneNumStatus($data);
            if($result == 0){
                $msg = iconv("GB2312", "UTF-8", "你填写的号码格式不正确");
            }
            else if($result == 1){
                $msg = iconv("GB2312", "UTF-8", "你填写的号码已经存在");
            }else{
                if($result ==2){
                    if ($_SESSION['smscode_time']+60>time() && $_SESSION['smscode_phone']==$data['phone'])
                    {
                        $msg = iconv("GB2312", "UTF-8","请过1分钟后再申请");
                    }
                    else
                    {
                        $result = $this->Sms_model->AddSms($data);
                        if ($result>0){
                            $data['status'] = 1;
                            $data['user_id'] = $data['user_id'];
                            $data['type'] = "smscode";
                            $data['code'] = rand(100000,999999);
                            $data['contents'] = "您的手机验证码为:".$data['code']."。请不要把验证码泄露给任何人。【91投房】";

                            $result = $result = $this->Sms_model->SendSMS($data);
                            $_SESSION['smscode_time'] = time();
                            $_SESSION['smscode_othertime'] = $_SESSION['smscode_time']-time();
                            $_SESSION['smscode_phone'] = $data['phone'];
                            if ($result > 0) {
                                $msg = iconv("GB2312", "UTF-8", '验证短信发送已发出请查收');
                            } else {
                                $msg = iconv("GB2312", "UTF-8", '验证短信发送失败，请联系客服！');
                            }

                        }else{
                            $msg = iconv("GB2312", "UTF-8","手机验证失败").$result;
                        }
                    }
                }else{
                    if ($_SESSION['smscode_time']+60>time() && $_SESSION['smscode_phone']==$data['phone'])
                    {
                        $msg = iconv("GB2312", "UTF-8","请过1分钟后再申请");
                    }else{
                        $result = $this->Sms_model->AddSms($data);
                        if (strrpos($result, "approve_sms")!==false){
                            $msg = iconv("GB2312", "UTF-8","手机验证失败").$result;
                        }
                        else{
                            $data['status'] = 1;
                            $data['user_id'] = $data['user_id'];
                            $data['type'] = "smscode";
                            $data['code'] = rand(100000,999999);
                            $data['contents'] = "您正在修改认证手机，验证码为:".$data['code']."。请不要把验证码泄露给任何人。【91投房】";
                            //$data['phone'] = $_G['user_info']['phone'];
                            $result = $this->Sms_model->SendSMS($data);
                            $_SESSION['smscode_time'] = time();
                            $_SESSION['smscode_othertime'] = $_SESSION['smscode_time']-time();
                            $_SESSION['smscode_phone'] = $data['phone'];
                            if ($result > 0) {
                                $msg = iconv("GB2312", "UTF-8", '验证短信发送已发出请查收');
                            } else {
                                $msg = iconv("GB2312", "UTF-8", '验证短信发送失败，请联系客服！');
                            }
                        }
                    }
                }
            }
        echo $msg;
    }
    public function check_phonenum(){
        $phonenum= $this->input->post('phonenum');
        //判断手机是否正确
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/", $phonenum)){
            $this->form_validation->set_message('check_verify', iconv('GB2312', 'UTF-8', '手机号码格式不正确'));
            return FALSE;
        }else{
            return TRUE;
        }

    }
    public function mobileProof(){
        $this->load->library("form_validation");
        $bool = $this->form_validation->run("phoneverify");
        $extral["errormsg"]="";
        if($bool) {
            $data['code'] = $this->input->post('verify');
            $data['phone'] = $this->input->post('phonenum');
            $data['type'] = "smscode";
            $this->load->library("session");
            $user = $this->session->userdata("user");
            $data["username"] = $user["loginUser"];
            $this->load->model("Sms_model");
            $result = $this->Sms_model->CheckSmsCode($data);
            if ($result ==1){
                //$extral["errormsg"] = iconv('GB2312', 'UTF-8',"注册成功");
                $test = "/showmsg/index/".urlencode("手机认证")."/".urlencode("手机认证成功");
                redirect( $test , 'refresh');
            }else{
                $extral["errormsg"] = iconv('GB2312', 'UTF-8',"手机认证失败");
                $this->load->view('mobile_proof_page',$extral);
            }
        }

        $this->load->view("mobile_proof_page",$extral);
    }

    public function mailProof(){

        $this->load->library("form_validation");
        $bool = $this->form_validation->run("mailverify");
        $extral["errormsg"]="";

        if($bool) {
            $this->load->library("session");
            $user = $this->session->userdata("user");
            $userid = $user["loginUser_id"];
            $data['user_id'] = $userid;
            $data['email'] = $this->input->post('email');
            $this->load->model("User_model");
            $result = $this->User_model->CheckEmail($data);
            if ($result == false) {
                $result = $this->User_model->UpdateEmail($data);
                if ($result == false) {
                    $extral["errormsg"] = iconv("GB2312", "UTF-8", "更新记录失败") . $result;
                } else {

                    $data['username'] = $user["loginUser"];
                    $data['webname'] = "91投房-房地产众筹领导者";
                    $data['title'] = "注册邮件确认";
                    $data['msg'] = $this->User_model->RegEmailMsg($data);
                    $data['type'] = "reg";
                    //var_dump($data);
                    if (isset($_SESSION['sendemail_time']) && $_SESSION['sendemail_time']+60>time()){
                        $extral["errormsg"] = iconv("GB2312","UTF-8","请1分钟后再次请求。");
                        $this->load->view("mailbox_proof_page",$extral);
                    }else
                    {
                        $result = $this->User_model->sendEmail($data);
                        //var_dump($result);
                        if ($result == true) {
                            $_SESSION['sendemail_time'] = time();
                            $test = "/showmsg/index/".urlencode("邮箱认证")."/".urlencode("激活信息已经发送到您的邮箱，请注意查收。");
                            redirect( $test , 'refresh');
                        } else {
                            $extral["errormsg"] = iconv("GB2312", "UTF-8", "发送失败，请跟管理员联系。");

                        }
                    }
                }
            } else {
                $extral["errormsg"] = iconv("GB2312", "UTF-8", "你重新填写的邮箱已经存在");
            }
            $this->load->view("mailbox_proof_page",$extral);
        }else
            $this->load->view("mailbox_proof_page",$extral);

    }

    function identityProof(){
        //$config['upload_path']='./uploads/images';

        $this->load->library("form_validation");
        $bool = $this->form_validation->run("identityverify");
        $extral["errormsg"]="";

        if($bool) {

            $config['upload_path'] = '../site/data/upfiles/images/';
            $config['upload_path'].= date("Y-m",time())."/".date("d",time())."/";
            $upload_path =  'data/upfiles/images/'.date("Y-m",time())."/".date("d",time())."/";
            $config["allowed_types"]='gif|png|jpg|bmp';
            $config["max_size"]="2048";
            $config['overwrite']= TRUE;
            $this->load->library("upload");
            $this->load->model("User_model");
            $this->load->library("session");

            $data['realname'] = $this->input->post("username");
            $data['card_id'] = $this->input->post("icnumber");
            $data['sex'] =$this->input->post("sex");

            $user = $this->session->userdata("user");
            $userid = $user["loginUser_id"];
            $Info=$this->User_model->GetUsersInfo(array("user_id"=>$userid));
//            echo "-----1--------";
//            var_dump($Info);

            $times = 0 ;
            $fee =0;
            $data['user_id'] = $userid;
            $data['status'] = 0;

            $errorHappened = false ;
            $i=0;
            foreach ($_FILES as $file => $file_data) {
                $config["file_name"]=(isset($data['user_id'])?$data['user_id']:"0")."_approve_realname_".time().rand(0,9);

                if (!is_dir($config['upload_path'])){
                    mkdir($config['upload_path'], 0777, true);
                }
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($file))
                {
                    $msg= $this->upload->display_errors();
                    $extral["errormsg"] =$msg;
                    if($i==0){
                        $extral["errormsg"] =iconv("GB2312","UTF-8","身份证正面照"). $msg;
                    }else{
                        $extral["errormsg"] =iconv("GB2312","UTF-8","身份证反面照"). $msg;
                    }
                    $errorHappened =true;
                    break;
                }
                else
                {
                    $msg = $this->upload->data();
                    //var_dump($msg);
                    $sql = "insert into yyd_users_upfiles  set code='approve',type='realname',article_id='{$data['user_id']}',user_id='{$data['user_id']}',`name`='{$msg["client_name"]}',filesize='{$msg["file_size"]}',filetype='{$msg["file_type"]}',fileurl='".$upload_path.$msg["orig_name"]."',filename='".$msg["orig_name"]."',`addtime` = '".time()."', `updatetime` = '".time()."',`addip` = '".$this->User_model->ip_address()."',`updateip` = '".$this->User_model->ip_address()."'";
                    $this->db->query($sql);
                    $upfiles_id = $this->db->insert_id();
                    if($i==0){
                        $data["card_pic1"] = $upfiles_id;
                    }else{
                        $data["card_pic2"] = $upfiles_id;
                    }

                }
                $i++;
            }
            //echo "-------2------";
            //var_dump($data);
            if($errorHappened == false ){
               $result =  $this->User_model->UpdateRealname($data);
                if ($result>0){
                    if($Info['realname_times']>$times){
                        $log_info["user_id"] = $data['user_id'];//操作用户id
                        $log_info["nid"] = "realname_fee_".$data['user_id'].time();//订单号
                        $log_info["money"] = $fee;//操作金额
                        $log_info["income"] = 0;//收入
                        $log_info["expend"] = $log_info["money"];//支出
                        $log_info["balance_cash"] = -$log_info["money"];//可提现金额
                        $log_info["balance_frost"] =0;//不可提现金额
                        $log_info["frost"] = 0;//冻结金额
                        $log_info["await"] = 0;//待收金额
                        $log_info["type"] = "realname_fee";//类型
                        $log_info["to_userid"] = $data['user_id'];//付给谁
                        $log_info["remark"] = "实名认证超过{$times}次，收费{$fee}元";
                        $result = $this->User_model->AddLog($log_info);
                    }
                    $this->User_model->UpdateUsersInfo(array("user_id"=>$data['user_id'],"realname_times"=>$Info['realname_times']+1));

                    $test = "/showmsg/index/".urlencode("姓名认证")."/".urlencode("姓名认证添加成功，请等待管理员审核");
                    redirect( $test , 'refresh');

                }else{
                    $extral["errormsg"] = iconv("GB2312","UTF-8","提交失败").$result;
                }
            }
        }

        //else
        {
            $this->load->view("identity_proof_page", $extral);
        }


    }





} 