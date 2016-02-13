<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/9
 * Time: 21:14
 */

class Ireits extends CI_Controller {

    public function index()
    {
        $data= array();
        $this->load->model("Borrow_model");
        $res = $this->Borrow_model->getBorrowList(array("getDetail"=>0,"page"=>0,"epage"=>5, "is_flow"=>2, "is_hide"=>0 , "query_type"=>"tender_now","order"=>"index"));
        //$res = $this->Borrow_model->getBorrowList(array("getDetail"=>0,"page"=>0,"epage"=>5, "is_flow"=>2, "is_hide"=>0 , "query_type"=>"tender_now","order"=>"index"));
        //var_dump($res["list"]);
        $data["borrow"]=$res["list"];
        $data["total_page"]=$res["total_page"];
        $this->load->view('i_reits_page',$data);
    }

    public function getMoreInfo(){
        $data= array();
        $this->load->model("Borrow_model");

        $cPage= $this->input->post("cPage");
        $ePage =$this->input->post("ePage");
        $res = $this->Borrow_model->getBorrowList(array("getDetail"=>0,"page"=>$cPage,"epage"=>$ePage, "is_flow"=>2, "is_hide"=>0 , "query_type"=>"tender_now","order"=>"index"));
        //var_dump($res["list"]);

        $result=$res["list"];
        $replay = array(
            "items" => $result,
        );

        echo json_encode($replay);
    }

    public function test(){
        $this->load->library("pagination");
        $config["total_rows"]= 100;
        $page_size =10;
        $config["per_page"] = 10;
        $config["base_url"] =site_url("Ireits/test");
        $this->pagination->initialize($config);
       $offset =intval($this->uri->segment(3));
        $sql ="select * from blog limit $offset,$page_size";
       // echo $sql;
        $link = $this->pagination->create_links();
       // var_dump($link);

    }
    public function check_login(){
        $this->load->library("session");
        $user = $this->session->userdata("user");
        if($user!= null && $user["isLogin"]==1){
            return $user;
        }else{
            return false;
        }
    }
    public function detailPage()
    {


        $this->load->model("Borrow_model");
        $input["query_id"]= intval($this->uri->segment(3));
        $global["h_query_id"] = $input["query_id"];
        $user = self::check_login();
        if($user!= false){
            $sql = "select * from yyd_users where username ='{$user["loginUser"]}'";
            $res = $this->Borrow_model->db_fetch_array($sql);
            $data["user_id"]= $res["user_id"];
            $data["query_id"]= $input["query_id"];
            $res=$this->Borrow_model->GetAccountInfo($data);
           // var_dump($res);
            $global["h_remain"]=$this->Borrow_model->IsExist($res["balance"])?$res["balance"]:0;
            $global["h_islogin"] =1;

        }
        $this->load->model("User_model");

        $input["getDetail"] =1;
        $res = $this->Borrow_model->getBorrowList($input);

        $input["user_id"] =$res["list"]["0"]["user_id"];
        $borrow_nid = $res["list"]["0"]["borrow_nid"];


        $_list = $this->Borrow_model->GetInfoOne($input);
        $_list["borrow"]=$res["list"]["0"];

        $res=$this->User_model->GetUsersVip($input);

        if ($res["status"]==1)
        {
            if ($res["vip_type"]==1)
                $_list["t_invester_type"] =1;
//                $_list["t_invester_type"]=iconv('GB2312', 'UTF-8',"VIP��Ա");
            else
//                $_list["t_invester_type"]=iconv('GB2312', 'UTF-8',"�߼�Vip��Ա");
                $_list["t_invester_type"] =2;
        }
        else
//            $_list["t_invester_type"]=iconv('GB2312', 'UTF-8',"��ͨ��Ա");
            $_list["t_invester_type"] =0;

        $result=$this->Borrow_model->GetUserCount($input);

        //�������ʣ�
        $_list["t_nofabu"]=$this->Borrow_model->IsExist($result["borrow_times"])?$result["borrow_times"]:0;
        //���ʳɹ���
        $_list["t_nosuccess"]=$this->Borrow_model->IsExist($result["borrow_times"])?$result["borrow_times"]:0;
        //���������
        $_list["t_noreturn"]=$this->Borrow_model->IsExist($result["all_times"])?$result["all_times"]:0;
        //���ڼ�¼��
        $_list["t_nodue"]= $this->Borrow_model->IsExist($result["borrow_times_late"])?$result["borrow_times_late"]:0;
        //�������ڣ�
        $_list["t_nooverdue"]=$this->Borrow_model->IsExist($result["borrow_times_late"])?$result["borrow_times_late"]:0;
        //����ܶ�:
        $_list["t_nochoukuan"]=$this->Borrow_model->IsExist($result["borrow_account"])?$result["borrow_account"]:0;
        //�� �� ��:
        $_list["t_nohuankuan"]=$this->Borrow_model->IsExist($result["borrow_repay_wait"])?$result["borrow_repay_wait"]:0;
        //���ڽ��:
        $_list["t_noyueqi"]=$this->Borrow_model->IsExist($result["borrow_times_late"])?$result["borrow_times_late"]:0;
        //Ͷ���ܶ�:
        $_list["t_notouzi"]=$this->Borrow_model->IsExist($result["tender_success_account"])?$result["tender_success_account"]:0;
        //�����ܶ�:
        $_list["t_nodaishou"]=$this->Borrow_model->IsExist($result["tender_recover_wait"])?$result["tender_recover_wait"]:0;


        $data=array();
        //��ȡ�����Ŀ��Ͷ����ʷ��¼
        $data["borrow_nid"]=$borrow_nid;
        $result=$this->Borrow_model->GetTenderList($data);
        //var_dump($result);
        $i=0;
        foreach ($result as $key => $value){
            //Ͷ���¼
            //Ͷ���� //������ //Ͷ����//��Ч���//״̬//ʱ��
            $_list["t_items"][$i]["t_a"]=$value["username"];//Ͷ����
            $_list["t_items"][$i]["t_b"]=$value["borrow_apr"];//������
            $_list["t_items"][$i]["t_c"]=$value["account"];//Ͷ����
            $_list["t_items"][$i]["t_d"]=$value["account"];//��Ч���
            $_list["t_items"][$i]["t_e"]="";//״̬
            $_list["t_items"][$i]["t_f"]=date ('Ymd',$value["addtime"]);//ʱ��
            $i++;
        }


        //��֤��Ϣ
        $result= $this->User_model->getVerifyStatus($input);

        if($result['email_status'] == 1)//�Ѿ���֤��
            $_list["img_verify_email"]="./images/helps/ir-youxiang.png";
        else
            $_list["img_verify_email"]="./images/helps/ir-youxiang1.png";
        if($result['phone_status']== 1)//�Ѿ���֤��
            $_list["img_verify_phone"]="./images/helps/ir-shouji.png";
        else
            $_list["img_verify_phone"]="./images/helps/ir-shouji1.png" ;
        if($result['realname_status'] == 1)//�Ѿ���֤��
            $_list["img_verify_name"]="./images/helps/ir-shenfen.png" ;
        else
            $_list["img_verify_name"]="./images/helps/ir-shenfen1.png";
        if($result['video_status'] == 1)//�Ѿ���֤��
            $_list["img_verify_video"]="./images/zhuliu/center_41.gif";
        else
            $_list["img_verify_video"]="./images/zhuliu/center_40.gif" ;

        $_list["email_status"] = $result['email_status'];
        $_list["phone_status"] = $result['email_status'];
        $_list["realname_status"] = $result['email_status'];


        $_list["h_islogin"]= isset($global["h_islogin"])?$global["h_islogin"]:0;
        $_list["h_remain"]= isset($global["h_remain"])?$global["h_remain"]:0;
        $_list["h_query_id"]= isset($global["h_query_id"])?$global["h_query_id"]:0;
        //var_dump($_list);


        $this->load->view("i_reits_detail_page",$_list);
    }


} 