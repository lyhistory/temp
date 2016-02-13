<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/6
 * Time: 17:19
 */

class Home extends CI_Controller {

    public function index()
    {
        $data= array();
        $home =site_url("home");
        $player=array(
            array('img'=>"images/iphone_banner/sj_banner1.jpg", 'link'=>$home),
            array('img'=>"images/iphone_banner/sj_banner2.jpg", 'link'=>$home),
            array('img'=>"images/iphone_banner/sj_banner3.jpg", 'link'=>$home),
            array('img'=>"images/iphone_banner/sj_banner4.jpg", 'link'=>$home),
        );
        $data["player"] = $player;
        if(self::check_login()){
            $data["is_login"]=1;
        }else{
            $data["is_login"]=0;
        }

        $this->load->model("Borrow_model");
        $res = $this->Borrow_model->getBorrowList(array("page"=>0,"epage"=>2, "is_flow"=>2, "is_hide"=>0 , "query_type"=>"tender_now","order"=>"index"));
        $data["total_page"]=$res["total_page"];
        //var_dump($res["list"]);
        $data["borrow"]=$res["list"];
        //var_dump($data);
       $this->load->view('home_page',$data);
        //$this->load->view('iscroll_page',$data);
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

    public function test(){
        $params=array("borrow_period"=>"1","borrow_apr"=>"16", "type"=> 'check', "is_auto"=>"1");
        $res = $this->getSuitableIreits($params);
        echo "1------------";
        var_dump($res);

        $params=array("borrow_period"=>"3","borrow_apr"=>"18", "type"=> 'check', "is_auto"=>"1");
        $res = $this->getSuitableIreits($params);
        echo "2------------";
        var_dump($res);

        $params=array("borrow_period"=>"6","borrow_apr"=>"20", "type"=> 'check', "is_auto"=>"1");
        $res = $this->getSuitableIreits($params);
        echo "3------------";
        var_dump($res);

        $params=array("borrow_period"=>"6","borrow_apr"=>"15", "type"=> 'check', "is_auto"=>"1");
        $res = $this->getSuitableIreits($params);
        echo "4------------";
        var_dump($res);

    }

    public function test1(){
        $this->load->model("Borrow_model");
        $user = self::check_login();
        var_dump($user);
        if ($user != false) {
            $sql = "select * from yyd_users where username ='{$user["loginUser"]}'";
            echo $sql;
            $res = $this->Borrow_model->db_fetch_array($sql);
            $data["user_id"] = $res["user_id"];
            $res = $this->Borrow_model->GetAccountInfo($data);
            var_dump($res);
            $h_remain = $this->Borrow_model->IsExist($res["balance"]) ? $res["balance"] : 0;
        } else {
            return;
        }
    }
    public function procou(){
        $this->load->library("session"); // store current type
        $type = $this->uri->segment(3);
        $typeList = array("tfid1","tfid2","tfid3","tfxs","tfzf");

        if (in_array($type, $typeList)) {
            $this->session->set_userdata('tfQueryType',$type);

            $reply["isToufang"] = false;
            if($type =="tfzf" ){
                $reply["isToufang"]  = true;
                $this->load->view("pro_coutent",$reply );
            }else{
                if($type =="tfid1"){
                    $params=array("borrow_period"=>"1","borrow_apr"=>"16"  , "type"=> 'check', "is_auto"=>"1");
                }else if ($type =="tfid2" ){
                    $params=array("borrow_period"=>"3","borrow_apr"=>"18", "type"=> 'check', "is_auto"=>"1");
                }else if ($type == "tfid3"){
                    $params=array("borrow_period"=>"6","borrow_apr"=>"20", "type"=> 'check', "is_auto"=>"1");
                }else if ($type == "tfxs"){
                    $params=array("borrow_period"=>"0.23","borrow_apr"=>"50", "type"=> 'check', "is_auto"=>"1");
                }else if ($type == "tfzf"){
                    $params=array("borrow_period"=>"6","borrow_apr"=>"15", "type"=> 'check', "is_auto"=>"1");
                }

                if($params!=null) {
                    $res = $this->getSuitableIreits($params);
                    //var_dump($res);
                    if ($res != null) {
                        $reply["h_remain"] = $res["h_remain"];
                        $reply["t_return_percent"] = $res["t_return_percent"];
                        $reply["t_return_type"] = $res["t_return_type"];
                        $reply["t_invest_sum"] = $res["t_invest_sum"];
                        $this->session->set_userdata('tfQueryId', $res["t_query_id"]);
                        $this->load->view("pro_coutent", $reply);
                        //var_dump($this->session->get_userdata('tfQueryId'));
                    }else{
                        $this->session->unset_userdata('query_type');
                        $this->session->unset_userdata('tfQueryId');
                    }
                }
            }

        }else{
            $this->session->unset_userdata('query_type');
            $this->session->unset_userdata('tfQueryId');
        }
    }

    public function checkProjectExistStatus(){
        $typelist =Array('tfid1','tfid2','tfid3','tfxs','tfzf');
        $reply =array();
        foreach( $typelist as $type) {
            if ($type == "tfid1") {
                $params = array("borrow_period" => "1", "borrow_apr" => "16" , "type"=> 'checkOnly', "is_auto"=>"1");
            } else if ($type == "tfid2") {
                $params = array("borrow_period" => "3", "borrow_apr" => "18"  , "type"=> 'checkOnly', "is_auto"=>"1");
            } else if ($type == "tfid3") {
                $params = array("borrow_period" => "6", "borrow_apr" => "20" , "type"=> 'checkOnly', "is_auto"=>"1");
            } else if ($type == "tfxs") {
                $params = array("borrow_period" => "0.23", "borrow_apr" => "50" , "type"=> 'checkOnly', "is_auto"=>"1");
            } else if ($type == "tfzf") {
                $params = array("borrow_period" => "6", "borrow_apr" => "15" , "type"=> 'checkOnly', "is_auto"=>"1");
            }

            if ($params != null) {
                $res = $this->getSuitableIreits($params);

                if ($res != null) {
                    $reply["info"][$type]["exist"] = true;
                    $reply["info"][$type]["t_return_percent"] = $res["t_return_percent"];
                    $reply["info"][$type]["t_num"] = $res["t_num"];
                    $reply["info"][$type]["t_invest_sum"] = $res["t_invest_sum"]; // Ê£Óà½ð¶î

                } else {
                    $reply["info"][$type]["exist"] = false;
                }
            } else {
                $reply["info"][$type]["exist"] = false;
            }
        }
        $user = self::check_login();
        if ($user != false) {
            $reply["isLogin"] = true;
        }else{
            $reply["isLogin"] = false;
        }

        echo json_encode($reply);
    }


    private function getSuitableIreits( $params)
    {
        $this->load->model("Borrow_model");
        if( $params["type"] != "checkOnly") {

            $user = self::check_login();
            if ($user != false) {
                $sql = "select * from yyd_users where username ='{$user["loginUser"]}'";
                $res = $this->Borrow_model->db_fetch_array($sql);
                $data["user_id"] = $res["user_id"];
                $res = $this->Borrow_model->GetAccountInfo($data);
                // var_dump($res);
                $h_remain = $this->Borrow_model->IsExist($res["balance"]) ? $res["balance"] : 0;
            } else {
                return;
            }
        }
        $this->load->model("User_model");
        $input = array("getDetail"=>1,"is_flow"=>2, "is_hide"=>0 ,"page"=>0,"epage"=>1, "query_type"=>"tender_now","order"=>"index","borrow_period"=>$params["borrow_period"],"borrow_apr"=>$params["borrow_apr"], "check_period_valid"=>true);

        $res = $this->Borrow_model->getBorrowList($input);
       // var_dump($res);
        if($res["total"] !=0) {
            return array("t_return_percent" => $res["list"]["0"]["t_return_percent"],
                "t_return_type" => $res["list"]["0"]["t_return_type"],
                "t_invest_sum" => $res["list"]["0"]["t_invest_sum"],
                "t_query_id" => $res["list"]["0"]["t_query_id"],
                "t_num" =>$res["list"]["0"]["t_num"] ,
                "h_remain" => $h_remain);
        }else{
            return;
        }

    }



        public function tfgscout(){
       $this->load->view("tfgs_coutent");

    }
} 