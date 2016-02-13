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
        //ע��ʱ�䣺
        $_list["register_date"]=date ('Y-m-d H:i:s',$result["reg_time"]);
        //����¼ʱ�䣺
        $_list["last_date"]=date ('Y-m-d H:i:s',$result["last_time"]);
        $result=$this->Borrow_model->GetBorrowCredit($input);
        $_list["approve_credit"]=$result["approve_credit"];
        $result=$this->Borrow_model->GetUserCount($input);
        //��׬����:
        $_list["e_total"]=$this->Borrow_model->IsExist($result["tender_interest_yes"])?$result["tender_interest_yes"]:0;
        //��׬��Ϣ
        $_list["e_fine"]=$this->Borrow_model->IsExist($result["all_late_interest"])?$result["all_late_interest"]:0;
        //��׬ΥԼ��
        $_list["e_weiyue"]=$this->Borrow_model->IsExist($result["weiyue"])?$result["weiyue"]:0;
        //���ս��:
        $_list["e_wait"]=$this->Borrow_model->IsExist($result["await"])?$result["await"]:0;
        //��׬����
        $_list["e_bonus"]=$this->Borrow_model->IsExist($result["award_add"])?$result["award_add"]:0;
        //�����ձ�Ϣ
        $_list["e_total_wait"]=$this->Borrow_model->IsExist($result["tender_recover_wait"])?$result["tender_recover_wait"]:0;
        //�ѻ��ձ�Ϣ:
        $_list["a_total_ready"]=$this->Borrow_model->IsExist($result["tender_recover_yes"])?$result["tender_recover_yes"]:0;
        //����ܶ�
        $_list["c_total"]=$this->Borrow_model->IsExist($result["borrow_account"])?$result["borrow_account"]:0;
        //����������
        $_list["c_total_num"]=$this->Borrow_model->IsExist($result["borrow_times"])?$result["borrow_times"]:0;
        //�ѻ���Ϣ
        $_list["c_pay_total"]=$this->Borrow_model->IsExist($result["borrow_repay_yes"])?$result["borrow_repay_yes"]:0;
        //������Ϣ
        $_list["c_unpay_total"]=$this->Borrow_model->IsExist($result["borrow_repay_wait"])?$result["borrow_repay_wait"]:0;
        $_list["num_record"]=$this->Borrow_model->IsExist($result["borrow_times"])?$result["borrow_times"]:0;//�����ʼ�¼
        $_list["num_apply"]=$this->Borrow_model->IsExist($result["tender_times"])?$result["tender_times"]:0; //��Ͷ���¼



        $result = $this->Borrow_model->GetAmountUsers($input);
        $_list["a_credit_amount"]=$result["borrow_amount"];//���ö��:
        $_list["a_valid_c_amount"]=$result["borrow_amount_use"];//���ö��:

        $result=$this->Borrow_model->GetRechargeCount_log($input);
        //��ֵ�ɹ��ܶ�
        $_list["a_suc_d"]=$this->Borrow_model->IsExist($result["recharge_all"])?$result["recharge_all"]:0;
        //���߳�ֵ�ܶ�
        $_list["a_online_d"]=$this->Borrow_model->IsExist($result["recharge_all_up"])?$result["recharge_all_up"]:0;
        //���³�ֵ�ܶ�
        $_list["a_offline_d"]=$this->Borrow_model->IsExist($result["recharge_all_down"])?$result["recharge_all_down"]:0;
        //�ֶ���ֵ�ܶ�
        $_list["a_manual_d"]=$this->Borrow_model->IsExist($result["recharge_all_other"])?$result["recharge_all_other"]:0;

        $result=$this->Borrow_model->GetAccountInfo($input);
        //�˻��ܶ�
        $_list["a_total"]=$this->Borrow_model->IsExist($result["total"])?$result["total"]:0;
        //�������
        $_list["a_remain"]=$this->Borrow_model->IsExist($result["balance"])?$result["balance"]:0;
        //�������
        $_list["a_freeze"]=$this->Borrow_model->IsExist($result["frost"])?$result["frost"]:0;
        //���ս��
        $_list["a_wait"]=$this->Borrow_model->IsExist($result["await"])?$result["await"]:0;
        //���ֳɹ��ܶ�
        $_list["a_suc_r"]=$this->Borrow_model->IsExist($result["account_log"]["cash_success"]["account"])?$result["account_log"]["cash_success"]["account"]:0;
        //�ɹ�����
        $_list["a_suc_r_num"]=$this->Borrow_model->IsExist($result["account_log"]["cash_success"]["num"])?$result["account_log"]["cash_success"]["num"]:0;
        //��֤��Ϣ
        $result= $this->User_model->getVerifyStatus($input);
        //������֤��
        $_list["reg_email_status"]=$result['email_status'];
        $_list["reg_email"]=$result['email_address'];
        //�ֻ���֤��
        $_list["reg_phone_status"]=$result['phone_status'];
        $_list["reg_phone"]=$result['phone_num'];
        //�����֤��
        $_list["reg_ic_status"]=$result['realname_status'];
        $_list["reg_ic"]=$result['realname_name'];
        //��Ƶ��֤��
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
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"��֤�벻��ȷ");
                $this->load->view('register_page',$extral);
                return;
            }

            $newpwd = $this->input->post("newpassword");
            $newpwdmd5 = md5($newpwd);
            $this->db->query("Update yyd_users SET  password='$newpwdmd5' where  username='$username'");
            $this->session->unset_userdata('user');

            $test = "/showmsg/index/".urlencode("��������")."/".urlencode("�����������óɹ�");
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
                $this->form_validation->set_message('oldpassword_check', iconv('GB2312', 'UTF-8', '�����벻��ȷ'));
                return FALSE;
            }
            return TRUE;

    }
    public function password_compare($newpasswordcmf){
        if( $this->input->post("newpassword")== $newpasswordcmf){
            return TRUE;
        }else{
            $this->form_validation->set_message('password_compare', iconv('GB2312', 'UTF-8', '�����벻���'));
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
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"��֤�벻��ȷ");
                $this->load->view('deposit_pw_page',$extral);
                return;
            }


            $data["user_id"]=$user["loginUser_id"];
            $data["password"] = $this->input->post("newpassword");
            $reply= $this->User_model->setDepositPwd($data);
            if($reply ==1){
                //$extral["errormsg"]=iconv('GB2312', 'UTF-8',"�����������óɹ�");
                $test = "/showmsg/index/".urlencode("��������")."/".urlencode("�����������óɹ�");
                redirect( $test , 'refresh');
            }else{
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"������������δ�ɹ�");
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
                $test = "/showmsg/index/".urlencode("��ȡ������")."/".urlencode("�������ѷ���,�����");
                redirect( $test , 'refresh');
                //$extral["errormsg"]=iconv('GB2312', 'UTF-8',"�������ѷ����� �����");
            }else{
                //$reply= "���뷢��ʧ��,ԭ��".$reply;
                $extral["errormsg"]=iconv('GB2312', 'UTF-8',"���뷢��ʧ��,ԭ���ǣ�");
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
                $msg = iconv("GB2312", "UTF-8", "����д�ĺ����ʽ����ȷ");
            }
            else if($result == 1){
                $msg = iconv("GB2312", "UTF-8", "����д�ĺ����Ѿ�����");
            }else{
                if($result ==2){
                    if ($_SESSION['smscode_time']+60>time() && $_SESSION['smscode_phone']==$data['phone'])
                    {
                        $msg = iconv("GB2312", "UTF-8","���1���Ӻ�������");
                    }
                    else
                    {
                        $result = $this->Sms_model->AddSms($data);
                        if ($result>0){
                            $data['status'] = 1;
                            $data['user_id'] = $data['user_id'];
                            $data['type'] = "smscode";
                            $data['code'] = rand(100000,999999);
                            $data['contents'] = "�����ֻ���֤��Ϊ:".$data['code']."���벻Ҫ����֤��й¶���κ��ˡ���91Ͷ����";

                            $result = $result = $this->Sms_model->SendSMS($data);
                            $_SESSION['smscode_time'] = time();
                            $_SESSION['smscode_othertime'] = $_SESSION['smscode_time']-time();
                            $_SESSION['smscode_phone'] = $data['phone'];
                            if ($result > 0) {
                                $msg = iconv("GB2312", "UTF-8", '��֤���ŷ����ѷ��������');
                            } else {
                                $msg = iconv("GB2312", "UTF-8", '��֤���ŷ���ʧ�ܣ�����ϵ�ͷ���');
                            }

                        }else{
                            $msg = iconv("GB2312", "UTF-8","�ֻ���֤ʧ��").$result;
                        }
                    }
                }else{
                    if ($_SESSION['smscode_time']+60>time() && $_SESSION['smscode_phone']==$data['phone'])
                    {
                        $msg = iconv("GB2312", "UTF-8","���1���Ӻ�������");
                    }else{
                        $result = $this->Sms_model->AddSms($data);
                        if (strrpos($result, "approve_sms")!==false){
                            $msg = iconv("GB2312", "UTF-8","�ֻ���֤ʧ��").$result;
                        }
                        else{
                            $data['status'] = 1;
                            $data['user_id'] = $data['user_id'];
                            $data['type'] = "smscode";
                            $data['code'] = rand(100000,999999);
                            $data['contents'] = "�������޸���֤�ֻ�����֤��Ϊ:".$data['code']."���벻Ҫ����֤��й¶���κ��ˡ���91Ͷ����";
                            //$data['phone'] = $_G['user_info']['phone'];
                            $result = $this->Sms_model->SendSMS($data);
                            $_SESSION['smscode_time'] = time();
                            $_SESSION['smscode_othertime'] = $_SESSION['smscode_time']-time();
                            $_SESSION['smscode_phone'] = $data['phone'];
                            if ($result > 0) {
                                $msg = iconv("GB2312", "UTF-8", '��֤���ŷ����ѷ��������');
                            } else {
                                $msg = iconv("GB2312", "UTF-8", '��֤���ŷ���ʧ�ܣ�����ϵ�ͷ���');
                            }
                        }
                    }
                }
            }
        echo $msg;
    }
    public function check_phonenum(){
        $phonenum= $this->input->post('phonenum');
        //�ж��ֻ��Ƿ���ȷ
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/", $phonenum)){
            $this->form_validation->set_message('check_verify', iconv('GB2312', 'UTF-8', '�ֻ������ʽ����ȷ'));
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
                //$extral["errormsg"] = iconv('GB2312', 'UTF-8',"ע��ɹ�");
                $test = "/showmsg/index/".urlencode("�ֻ���֤")."/".urlencode("�ֻ���֤�ɹ�");
                redirect( $test , 'refresh');
            }else{
                $extral["errormsg"] = iconv('GB2312', 'UTF-8',"�ֻ���֤ʧ��");
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
                    $extral["errormsg"] = iconv("GB2312", "UTF-8", "���¼�¼ʧ��") . $result;
                } else {

                    $data['username'] = $user["loginUser"];
                    $data['webname'] = "91Ͷ��-���ز��ڳ��쵼��";
                    $data['title'] = "ע���ʼ�ȷ��";
                    $data['msg'] = $this->User_model->RegEmailMsg($data);
                    $data['type'] = "reg";
                    //var_dump($data);
                    if (isset($_SESSION['sendemail_time']) && $_SESSION['sendemail_time']+60>time()){
                        $extral["errormsg"] = iconv("GB2312","UTF-8","��1���Ӻ��ٴ�����");
                        $this->load->view("mailbox_proof_page",$extral);
                    }else
                    {
                        $result = $this->User_model->sendEmail($data);
                        //var_dump($result);
                        if ($result == true) {
                            $_SESSION['sendemail_time'] = time();
                            $test = "/showmsg/index/".urlencode("������֤")."/".urlencode("������Ϣ�Ѿ����͵��������䣬��ע����ա�");
                            redirect( $test , 'refresh');
                        } else {
                            $extral["errormsg"] = iconv("GB2312", "UTF-8", "����ʧ�ܣ��������Ա��ϵ��");

                        }
                    }
                }
            } else {
                $extral["errormsg"] = iconv("GB2312", "UTF-8", "��������д�������Ѿ�����");
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
                        $extral["errormsg"] =iconv("GB2312","UTF-8","���֤������"). $msg;
                    }else{
                        $extral["errormsg"] =iconv("GB2312","UTF-8","���֤������"). $msg;
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
                        $log_info["user_id"] = $data['user_id'];//�����û�id
                        $log_info["nid"] = "realname_fee_".$data['user_id'].time();//������
                        $log_info["money"] = $fee;//�������
                        $log_info["income"] = 0;//����
                        $log_info["expend"] = $log_info["money"];//֧��
                        $log_info["balance_cash"] = -$log_info["money"];//�����ֽ��
                        $log_info["balance_frost"] =0;//�������ֽ��
                        $log_info["frost"] = 0;//������
                        $log_info["await"] = 0;//���ս��
                        $log_info["type"] = "realname_fee";//����
                        $log_info["to_userid"] = $data['user_id'];//����˭
                        $log_info["remark"] = "ʵ����֤����{$times}�Σ��շ�{$fee}Ԫ";
                        $result = $this->User_model->AddLog($log_info);
                    }
                    $this->User_model->UpdateUsersInfo(array("user_id"=>$data['user_id'],"realname_times"=>$Info['realname_times']+1));

                    $test = "/showmsg/index/".urlencode("������֤")."/".urlencode("������֤��ӳɹ�����ȴ�����Ա���");
                    redirect( $test , 'refresh');

                }else{
                    $extral["errormsg"] = iconv("GB2312","UTF-8","�ύʧ��").$result;
                }
            }
        }

        //else
        {
            $this->load->view("identity_proof_page", $extral);
        }


    }





} 