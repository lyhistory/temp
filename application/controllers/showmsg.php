<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/16
 * Time: 19:14
 */

class Showmsg extends CI_Controller {
   public function index(){
       $data["title"]=iconv("GB2312","UTF-8",urldecode($this->uri->segment(3)));
       $data["status"]=iconv("GB2312","UTF-8",urldecode($this->uri->segment(4)));
       $return=($this->uri->segment(5));
       if($return=="topup"){
           $data["returnlink"]= site_url("topup/");
       }else{
           $data["returnlink"]= site_url("home");
       }
       $data["error"]="";
       $this->load->view("showmsg_page",$data);
   }
    public function showInfo(){
        $this->load->library("session");
        $msg= $this->session->flashdata('message');
        $data["title"]= $msg["title"];
        $data["status"]= $msg["status"];
        if($msg["return"]=="topup"){
            $data["returnlink"]= site_url("topup/");
        }else if ($msg["return"]=="topupbindingPageOne"){
            $data["returnlink"]= site_url("topup/bindingPageOne");
        }else{
            $data["returnlink"]= site_url("home");
        }
        $data["error"] =$msg["error"];
        $this->load->view("showmsg_page",$data);
    }

} 