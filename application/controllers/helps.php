<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/9
 * Time: 21:36
 */

class Helps extends CI_Controller {

    public function index()
    {
        $data["security"]=site_url("helps");
        $data["register"]=site_url("register/mailRegister");
        $data["pwmanager"]=site_url("helps");
        $data["datasecurity"]=site_url("helps");
        $data["partner"]=site_url("helps/ourpartner");
        $data["media"]=site_url("helps/showmedia");
        $data["team"]=site_url("helps/ourteam");
        $data["contact"]=site_url("helps/contactus");

        $this->load->view('help_page',$data);
    }
    public function ourpartner(){
        $this->load->view('help_co_team');
    }

    public function contactus(){
        $this->load->view('help_contact_us');
    }
    public function showmedia(){
        $this->load->view('help_media_report');
    }
    public function showquestion(){
        $this->load->view('help_question');
    }
    public function saftyControl(){
        $this->load->view('help_safty');
    }


    public function ourteam(){

        $this->load->view('help_our_team');
    }


} 