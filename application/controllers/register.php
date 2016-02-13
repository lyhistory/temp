<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/9
 * Time: 21:23
 */

class Register extends CI_Controller {

    public function mailRegister(){

        $this->load->library("form_validation");
        $bool = $this->form_validation->run("mailRegister");
        $extral["errormsg"]="";
        $extral["username"]=$this->input->post("username");
        $extral["email"]=$this->input->post("email");
        $extral["verify"]=$this->input->post("verify");


        if($bool){
            $data['username']=$this->input->post('username');
            $data['password']=$this->input->post('password');
            $data['email']=$this->input->post('email');
            $this->load->model("User_model");
            $result = $this->User_model->register($data);
            //echo "-----------";
            //var_dump($result);
            if($result["status"]==1){
                $status = $this->User_model->sendActiveEmail($data);
               // var_dump($status);
                if($status==1) {
                    //$extral["errormsg"]=iconv('GB2312', 'UTF-8',"<a href=''>ע��ɹ�,��ת����ҳ��</a>");
                    //$this->load->view('register_page',$extral);
                    $test = "/showmsg/index/".urlencode("����ע��")."/".urlencode("��ӭ����91Ͷ��");
                    redirect( $test , 'refresh');
                }else{
                    $extral["errormsg"]=iconv('GB2312', 'UTF-8',"��֤���䷢��ʧ�ܣ�����ϵ����Ա");
                    $this->load->view('register_page',$extral);
                }
            }else{
                $data["status"]=$result["status"];
                $data["errormsg"] =iconv('GB2312', 'UTF-8', $result["errormsg"]);
                $this->load->view('register_page',$extral);
            }

        }else{
            //ʧ�ܣ���ʾ�����Ϣ
            $error=$this->form_validation->error_array();
            $data["status"]=-100;
            $data["email"]=$error["email"];
            $data["username_error"]=$error["username"];
            $data["password_error"]=$error["password"];
            $data["verify_error"]=$error["verify"];
            $data["checkbox_error"]=$error["checkbox"];

            $this->load->view('register_page',$extral);
        }

    }

    public function test(){
        $test = "/showmsg/index/".urlencode("��ȡ������")."/".urlencode("�������ѷ���,�����");
       var_dump($test);
        redirect($test, 'refresh');
    }

    public function newCaptcha(){

        if ($this->input->is_ajax_request()) {
            $this->load->helper('captcha');
            $vals = array(
                'word'=>rand(10000, 99999),
                'img_path' =>'./captcha/',
                'img_url' => base_url().'/captcha/',
                'img_width' => "100",
                'img_height' => 25,
                'expiration' => 60*10,
            );
            $cap = create_captcha($vals);
            $this->load->library("session");
            $this->session->set_userdata('cap',$cap["word"]);
            echo $cap["image"];
        } else {
            show_404();
        }

    }
    public function test1(){
        $data['username']="linwei";
        $data['password']="dsfsdf";
        $data['email']="63052533@qq.com";
        $this->load->model("User_model");
        $result = $this->User_model->sendActiveEmail($data);
        var_dump($result);
    }

    public function check_phonenum(){
        $phonenum= $this->input->post('phonenum');
        //�ж��ֻ��Ƿ���ȷ
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/", $phonenum)){
            $this->form_validation->set_message('check_phonenum', iconv('GB2312', 'UTF-8', '�ֻ������ʽ����ȷ'));
            return FALSE;
        }else{
            return TRUE;
        }

    }
    public function testlin(){

        $this->load->model("User_model");


//        $invite_username = "aslin1126";
//        //�ж��Ƽ����Ƿ��Ѿ�����
//        if ($this->User_model->IsExist($invite_username) != false && $invite_username != "") {
//            $result = $this->User_model->GetUsers(array("username" => $invite_username));
//            if ($result != false) {
//                $data_info['invite_userid'] = $result['user_id'];
//            } else {
//                $msg = "�Ƽ���:" . $invite_username . "������";
//            }
//        }
//
//        $data_info['user_id'] ="280";
//        $data_info['invite_userid'] = "262";
//
//        $this->User_model->invite_hongbao($data_info);

//        $this->User_model->UpdateUsersInfo($data_info);echo "1------";
//
//        $credit_log['user_id'] = "278";
//        $credit_log['nid'] = "reg";
//        $credit_log['code'] = "payment";
//        $credit_log['type'] = "reg";
//        $credit_log['addtime'] = time();
//        $credit_log['article_id'] = "278";
//        $credit_log['remark'] = iconv('GB2312', 'UTF-8', "ע���ý��");
//        $this->User_model->ActionCreditLog($credit_log);
//        $credit_log['user_id']="278";
//        $credit_log['nid']="hongbao";
//        $credit_log['code'] = "payment";
//        $credit_log['type'] = "hongbao";
//        $credit_log['addtime'] = time();
//        $credit_log['article_id'] = "278";
//        $credit_log['remark'] = iconv('GB2312', 'UTF-8', "ע����100Ԫ���");
//        $this->User_model->ActionCreditLog($credit_log);
//
//        {
//            $_G['system']['con_reg_vip'] =3;
//            $data['vip_type'] = 1;
//            $data['gold_status'] = 0;
//            $data['user_id'] = "278";
//            $data['remark'] = "ע������VIP";
//            $data['kefu_userid'] = 0;
//            $data['money'] = 0;
//            $data['vip_time']=$_G['system']['con_reg_vip'];
//            $this->User_model->UsersVipApply($data);
//        }
//        echo "------------7----------";
//        $_result = $this->User_model->GetUsersTypeCheck();
//        $data_info['type_id'] = $_result['id'];
//        $data_info['status'] = 1;
//        $data_info['user_id'] =  "278";
//        var_dump($_result);
    }
    public function phoneRegister(){
        $this->load->library("form_validation");
        $bool = $this->form_validation->run("smsverify");
        $extral["errormsg"]="";
        $extral["username"]=$this->input->post("username");
        $extral["phonenum"]=$this->input->post("phonenum");
        $extral["verify"]=$this->input->post("verify");
        $extral["invite_username"]=$this->input->post("invite_username");
        $extral["smsverify"]=$this->input->post("smsverify");






        if($bool) {
            $this->load->model("Sms_model");
            $this->load->model("User_model");

            $msg = "";
            $invite_username = $this->input->post("invite_username");
            //�ж��Ƽ����Ƿ��Ѿ�����
            if ($this->User_model->IsExist($invite_username) != false && $invite_username != "") {
                $result = $this->User_model->GetUsers(array("username" => $invite_username));
                if ($result != false) {
                    $data_info['invite_userid'] = $result['user_id'];
                } else {
                    $msg = "�Ƽ���:" . $invite_username . "������";
                }
            }

//            echo "------------2------------";
//            echo $msg;
//            echo "------3--------";
//            var_dump($data_info);
            if ($msg == "") {
                $data['type'] = "sms_register";
                $data['username'] = $this->input->post("username");
                $data['code'] = $this->input->post("smsverify");
                $data['phone'] = $this->input->post("phonenum");
                $result = $this->Sms_model->CheckSmsCode($data);

//                echo "------4--------";
//                var_dump($result);
                if ($result == 1) {

//                    echo "------------3----------".$data['username'];
                    $result = $this->User_model->GetUsers(array("username" =>  $data['username']));

                    $tmp["phone"] =  $data['phone'];
                    $tmp["user_id"] =$result["user_id"];
                    $this->Sms_model->AddSms($tmp);


//                    echo "------------4----------".$result["user_id"];
                    $data_info['user_id'] = $result["user_id"];
//                    var_dump($data_info);
                    $this->User_model->invite_hongbao($data_info);
//                    echo "------------5--1--------";
                    $credit_log['user_id'] = $result["user_id"];
                    $credit_log['nid'] = "reg";
                    $credit_log['code'] = "payment";
                    $credit_log['type'] = "reg";
                    $credit_log['addtime'] = time();
                    $credit_log['article_id'] = $result["user_id"];
                    $credit_log['remark'] = iconv('GB2312', 'UTF-8', "ע���ý��");
                    $this->User_model->ActionCreditLog($credit_log);
//                    echo "------------5----------";
                    //ע�����ֽ� by lyhistory
                    $credit_log['user_id']=$result["user_id"];
                    $credit_log['nid']="hongbao";
                    $credit_log['code'] = "payment";
                    $credit_log['type'] = "hongbao";
                    $credit_log['addtime'] = time();
                    $credit_log['article_id'] = $result["user_id"];
                    $credit_log['remark'] = iconv('GB2312', 'UTF-8', "ע����100Ԫ���");
                    $this->User_model->ActionCreditLog($credit_log);
//                    echo "------------6----------";
                    //ע����VIP
                    //if($_G['system']['con_reg_vip']>0)
                    {
                        $_G['system']['con_reg_vip'] =3;
                        $data['vip_type'] = 1;
                        $data['gold_status'] = 0;
                        $data['user_id'] = $result["user_id"];
                        $data['remark'] = "ע������VIP";
                        $data['kefu_userid'] = 0;
                        $data['money'] = 0;
                        $data['vip_time']=$_G['system']['con_reg_vip'];
                        $this->User_model->UsersVipApply($data);
                    }
//                    echo "------------7----------";
                    $_result = $this->User_model->GetUsersTypeCheck();
                    $data_info['type_id'] = $_result['id'];
                    $data_info['status'] = 1;
                    $data_info['user_id'] = $result["user_id"];
                    $this->User_model->UpdateUsersInfo($data_info);
//                    $extral["errormsg"] = iconv('GB2312', 'UTF-8', "�ֻ�ע��ɹ�����ӭ����91Ͷ��");
//                    $this->load->view('phone_register_page', $extral);

                    $test = "/showmsg/index/" . urlencode("�ֻ�ע��") . "/" . urlencode("�ֻ�ע��ɹ�����ӭ����91Ͷ��");
                    redirect($test, 'refresh');
                } else {
                    $extral["smsverify"]="";
                    $extral["status"]=-5;
                    $extral["errormsg"] = iconv('GB2312', 'UTF-8', "SMS��֤�����");
                    $this->load->view('phone_register_page', $extral);
                }
                //$this->load->view('phone_register_page',$extral);
            }else{
                $extral["invite_username"]="";
                $extral["status"]=-6;
                $extral["errormsg"] = iconv('GB2312', 'UTF-8', $msg);
                $this->load->view('phone_register_page',$extral);
            }
        }
        else {
            $error=$this->form_validation->error_array();
            $extral["status"]=-100;
            if($error["phonenum"]!=""){
                $extral["phonenum"]="";
                $extral["phonenum_error"]=$error["phonenum"];
            }
            if($error["username"]!=""){
                $extral["username"]="";
                $extral["username_error"]=$error["username"];
            }
            if($error["password"]!=""){
                $extral["password"]="";
                $extral["password_error"]=$error["password"];
            }
            if($error["verify"]!=""){
                $extral["verify"]="";
                $extral["verify_error"]=$error["verify"];
            }
            if($error["smsverify"]!=""){
                $extral["smsverify"]="";
                $extral["smsverify_error"]=$error["smsverify"];
            }
            $extral["checkbox_error"]=$error["checkbox"];

            $this->load->view('phone_register_page',$extral);
        }


    }

    public function check_verify(){
        $capsdata= $this->input->post('verify');
        $this->load->library("session");
        $caps =$this->session->get_userdata('cap');
        if($capsdata!= $caps['cap']){
            $this->form_validation->set_message('check_verify', iconv('GB2312', 'UTF-8', '��֤�벻��ȷ'));
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    public function check_smscode(){

        $verify= $this->input->post('verify');
        $this->load->library("session");
        $sms_codes =$this->session->get_userdata('sms_code');
        if($verify!= $sms_codes['sms_code']){
            $this->form_validation->set_message('check_smscode', iconv('GB2312', 'UTF-8', '��֤�벻���'));
            return FALSE;
        }
        else{
           return TRUE;
        }
    }

    public function testcheck(){
        $phone= $this->input->post('phonenum');
        $this->load->model("Sms_model");
        $reply = $this->Sms_model->CheckPhoneExist("185184298563");
 //       var_dump($reply);
    }
    public function sendVerifyCode()
    {
        session_start();
        $phone = $this->input->post('phonenum');
        $tmp["phone"] = $phone;
        $this->load->model("Sms_model");
        $this->load->model("User_model");
        $reply = $this->Sms_model->CheckPhoneExist($phone);
        if ($reply != false) {
            $data['status']=-5;
			$data['errormsg'] = iconv("GB2312", "UTF-8", $reply);
            //$msg = $reply;
           // $msg =  $reply;
           
        }
        else
        {
                 $reply = $this->User_model->CheckUsername(array("username" => $this->input->post['username']));

                 if ($reply != false) {
                     $data['status']=0;
                     $data['errormsg'] = iconv("GB2312", "UTF-8", $reply);
                 }
                 else
                {
                    if ($_SESSION['smscode_time'] + 60 > time() && $_SESSION['smscode_phone'] == $phone) {
                        $data['status']=0;
                        $data['errormsg'] = iconv("GB2312", "UTF-8", "���1���Ӻ�������11");
                    } else {


                        $username = $this->input->post('username');
                        $input['username'] = $this->input->post('username');
                        $input['password'] = $this->input->post('password');
                        $input['email'] = $this->input->post('email');
                        $input["regtype"] = 1;
                        if (isset($_SESSION['smscode_username']) && $_SESSION['smscode_username'] != "" && $_SESSION['smscode_username'] == $username) {
                            $result["status"] = "success";
                            $result["user_id"] = $_SESSION['smscode_user_id'];
                        } else {
                            $result = $this->User_model->register($input);

                        }
                        //var_dump($result);
                        if ($result["status"] == "success") {
                            $data = array();
                            $data['phone'] = $phone;
                            $data['status'] = 1;
                            $data['user_id'] = $result["user_id"];
                            $userid = $result["user_id"];
                            $data['type'] = "sms_register";
                            $data['code'] = rand(100000, 999999);
                            $data['contents'] ="��֤��:" . $data['code'] . "�������ڽ����ֻ�ע��������벻Ҫ����֤��й¶���κ��ˡ���91Ͷ����";

                            $this->load->model("Sms_model");
                            $result = $this->Sms_model->SendSMS($data);
                            $_SESSION['smscode_time'] = time();
                            $_SESSION['smscode_othertime'] = $_SESSION['smscode_time'] - time();
                            $_SESSION['smscode_phone'] = $phone;
                            $_SESSION['smscode_username'] = $input['username'];
                            $_SESSION['smscode_user_id'] = $data['user_id'];
                            if ($result > 0) {
                                $data['status']=0;
                                $data['errormsg'] = iconv("GB2312", "UTF-8", '��֤���ŷ����ѷ��ͣ�����գ�' );
                            } else {
                                $_SESSION['smscode_username'] = "";
                                $_SESSION['smscode_time'] = $_SESSION['smscode_time'] - 60;
                                $result = $this->User_model->unRegister($input);
                                $data['status']=0;
                                $data['errormsg'] = iconv("GB2312", "UTF-8", '��֤���ŷ���ʧ�ܣ�����ϵ�ͷ���');

                            }
                        } else {
                            $_SESSION['smscode_username'] = "";
                            $_SESSION['smscode_time'] = $_SESSION['smscode_time'] - 60;
                            $data['status']=$result['status'];
                            $data['errormsg']= iconv("GB2312", "UTF-8", $result["errormsg"]);
                        }
                    }
                }
        }
        echo json_encode($data);

    }

    public  function testSMS(){

        $http = 'http://www.smswst.com:80/api/httpapi.aspx';		//���Žӿ�
        $uid = 'wangzel';							//�û��˺�
        $pwd = '888888';							//����
        $phone	 = '15200557107';	//����
        $AddSing = 'N';
        $action = 'send';
        $content = '��֤��:121212���벻Ҫ����֤��й¶���κ��ˡ����ز��������';		//����
        //��ʱ����
        $this->load->model("Sms_model");
        $res = $this->Sms_model->SendSMS_Common($http,$uid,$pwd,$phone,$content,$AddSing,$action);
        $res = 'test ���ԣ����ز���ࡿ';
        return $res;
    }
} 