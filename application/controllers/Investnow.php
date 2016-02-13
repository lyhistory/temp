<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/19
 * Time: 22:47
 */

class Investnow extends CI_Controller{



    public function IreitsInvest(){

        $this->load->model("Borrow_model");
        $input["query_id"] =$this->Borrow_model->IsExist($this->input->post("query_id"))?$this->input->post("query_id"):0;
        $input["query_type"] =$this->Borrow_model->IsExist($this->input->post("query_type"))?$this->input->post("query_type"):0;

        if($input["query_type"] =="pro_coutent" ){

            $this->load->library("session");
            $input["query_id"]=$this->session->userdata('tfQueryId');
        }

        $input['money'] =$this->input->post("invest");
        $input["paypassword"] = $this->input->post("paypassword");

        //var_dump($input);

        $sql = "select * from yyd_borrow where id ={$input["query_id"]}";

        $result = $this->Borrow_model->db_fetch_array($sql);

        $this->load->library("session");
        $user = $this->session->userdata("user");
        $input['user_id'] =$user["loginUser_id"];
        $input["borrow_nid"] = $result["borrow_nid"];
        $input['Second_limit_money'] ="";
        $input['flow_count']="";
        //var_dump($input);
        $result =  $this->Borrow_model->tenderNow($input);
        //var_dump($result);
        $data = array();
        if($result == 'success'){
            $data["status"] =$result;
            $data["url"]= site_url()."/showmsg/index/".urlencode("投资信息")."/".urlencode("恭喜你，你已投资成功");
        }else{
            $data["status"] ="fail";
            $data["reason"] =$result;
        }
        if($input["query_type"] =="pro_coutent" ){
            $data["type"]= "pro_coutent";
        }
        echo json_encode($data);

    }
    public function ToufangInvest(){
        $this->load->model("Raise_model");
        $input =array();
        $input["id"] =$this->input->post("query_id");
        $input['account'] =$this->input->post("invest");
        $input["paypassword"] = $this->input->post("password");
//echo $input["id"];
        $this->load->library("session");
        $user = $this->session->userdata("user");
        $input['user_id'] =$user["loginUser_id"];
//        $input["id"] ="3";
//        $input['account'] ="999.99";
//        $input['user_id'] = 18;
//        $input['paypassword'] = "abcde";
        $result = $this->Raise_model->BuyRaise($input);

        $data = array();
        if($result >0){
            $data["status"] ="success";
            $data["url"]= site_url()."/showmsg/index/".urlencode("投资信息")."/".urlencode("恭喜你，你已投资成功");
        }else{
            $data["status"] ="fail";
            $data["reason"] =$result;
        }
        echo json_encode($data);

    }

} 