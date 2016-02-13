<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/6
 * Time: 23:17
 */

class Login extends CI_Controller{
    public function index()
    {

        $destination =intval($this->uri->segment(3));
        $query_id =intval($this->uri->segment(4));
        if($query_id != 0){
            $destination =$destination."/". $query_id;
        }

        $this->load->library("form_validation");
        $bool = $this->form_validation->run("signup");
        $data["errormsg"]="";
        if($bool){
            $this->load->library("session");
            $data['username']=$this->input->post('username');
            $data['password']=$this->input->post('password');

           //var_dump($data);
            $this->load->model("User_model");
            $result = $this->User_model->login($data);
            //var_dump($result);

            if($result["status"]==1){
                //登入成功
                $user = array('loginUser_id'=>$result["userid"],'loginUser'=>$result["username"],"isLogin"=>1);

                $this->session->set_userdata('user',$user);
                switch ($destination){
                    case 7:
                        $tmp = '/home';
                        redirect($tmp, 'refresh');
                        break;
                    case 6:
                        $tmp = '/topup/bindingPageOne';
                        redirect($tmp, 'refresh');
                        break;
                    case 5:
                        $tmp = '/topup/index';
                        redirect($tmp, 'refresh');
                        break;
                    case 4:

                        $tmp = '/toufang/detailPage/'.$query_id;
                        redirect($tmp, 'refresh');
                        break;
                    case 3:

                        $tmp = '/ireits/detailPage/'.$query_id;
                        redirect($tmp, 'refresh');
                        break;
                    case 1:
                        //header('Location:'.site_url('myaccount/setting'));
                        redirect('/myaccount/setting', 'refresh');
                        break;
                    case 2:
                        //header('Location:'.site_url('myaccount/account'));
                        redirect('/myaccount/account', 'refresh');
                        break;
                    case 0:
                    default:
                        header('Location:'.site_url('home'));
                        break;
                }

            }else{
                $user = $this->session->userdata("user");
				//var_dump($user);
                if($user!= null){
                     $this->session->unset_userdata('user');
                }
				$data["status"]=$result["status"];
				//$data["test"]='test';
                //$data["errormsg"]=iconv('GB2312', 'UTF-8',"登录失败,请检查用户名或密码");
                $this->load->view('login_page',$data);

            }

            //在其他地方获取
            //只有页面重新加载后或跳到其他url 才能获取
        }else{
			if(strcasecmp($_SERVER['REQUEST_METHOD'],"POST")==0){
            $data["status"]=-100;
            $error=$this->form_validation->error_array();
            $data["username_error"]=$error["username"];
            $data["password_error"]=$error["password"];
			}
            //失败，显示措湖信息
            $data["destination"]=$destination;
            $this->load->view('login_page',$data);
        }
    }

    public function check_login(){
        $this->load->library("session");
        $user = $this->session->userdata("user");
        if($user!= null && $user["isLogin"]==1){

            return true;
        }else{

            return false;
        }
    }
    public function Logoff(){
        $this->load->library("session");
        $this->session->unset_userdata('user');
        header('Location:'.site_url('home'));
    }
    public function check_login_status(){
        $type= $this->input->post("type");
        $reply["type"] =$type;
        $reply["isLogin"] = false;
        if (check_login){
            $reply["isLogin"] = true;
        }
        echo json_encode($reply);
    }



} 