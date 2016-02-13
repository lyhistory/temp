<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/9
 * Time: 22:29
 */

class Toufang extends CI_Controller {

    public function index()
    {
        $data= array();
        $this->load->model("Raise_model");
        $res = $this->Raise_model->getRaiseList(array("page"=>0,"epage"=>5, "is_hide"=>0));
        //var_dump($res["list"]);
        $data["total_page"]=$res["total_page"];
        //var_dump($data["total_page"]);
        $data["raise"]=$res["list"];
        $this->load->view('toufang_page',$data);
    }
    public function getMoreInfo(){

        $this->load->model("Raise_model");
        $cPage= $this->input->post("cPage");
        $ePage =$this->input->post("ePage");

        $res = $this->Raise_model->getRaiseList(array("page"=>$cPage,"epage"=>$ePage, "is_hide"=>0));
        $result=$res["list"];
        $replay = array(
            "items" => $result,
        );
        echo json_encode($replay);
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

    public function detailPage(){
        $input["query_id"] = intval($this->uri->segment(3));
        $this->load->model("Raise_model");
        $global["h_query_id"] = $input["query_id"];
        $user = self::check_login();

        if($user!= false){
            $sql = "select * from yyd_users where username ='{$user["loginUser"]}'";
            $res = $this->Raise_model->db_fetch_array($sql);
            $data["user_id"]= $res["user_id"];
            $data["query_id"]= $input["query_id"];
            $res=$this->Raise_model->GetAccountInfo($data);
            $global["h_remain"]=$this->Raise_model->IsExist($res["balance"])?$res["balance"]:0;
            $global["h_islogin"] =1;
        }

        $result = $this->Raise_model->getRaiseOne($input);
        //echo "----------1----------";
       // var_dump($result);
        $_list["h_name"]=$result["raise_name"];
        $_list["h_target_day"]=$result["raise_period"];
        if(intval($result["end_day"])<0){
			$_list["h_left_day"]="0";
		}else{
			$_list["h_left_day"]=$result["end_day"];
		}
        $_list["h_target_num"]=$result["raise_account"];
        $_list["h_sup_num"]=$result["tender_times"];
        $_list["h_raised_num"]=$result["raise_account_yes"];
        $_list['i_img']='http://www.91toufang.com'.$result["fileurl"];
        $this->load->library("utility");
        $status= $this->utility->getRaisestatus($result["status"],$result["end_day"]);

        $_list["h_status"]=iconv('GB2312','UTF-8',$status);
        $str=preg_replace('#src="/#is', 'style=width:100%; src="http://www.91toufang.com/', $result["raise_contents"]);
        $_list["t_raise_content"]= $str;
        $result=  $this->Raise_model->getRaiseTenderList($input);
        //echo "----------2----------";
        //var_dump($result);
        foreach($result as $key =>$value)
        {
            $_list["h_items"][$key]["h_tender_time"]=date ('Y-m-d',$value["addtime"]);
            $_list["h_items"][$key]["h_tender_val"]=$value["tender_account"];
            $_list["h_items"][$key]["h_tender_name"]=iconv('GB2312','UTF-8',$value["username"]);
        }

        $_list["h_islogin"]= isset($global["h_islogin"])?$global["h_islogin"]:0;
        $_list["h_remain"]= isset($global["h_remain"])?$global["h_remain"]:0;
        $_list["h_query_id"]= isset($global["h_query_id"])?$global["h_query_id"]:0;

//        echo "----------3----------";
//        var_dump($_list);
        $this->load->view('toufang_detail_page',$_list);
    }




} 