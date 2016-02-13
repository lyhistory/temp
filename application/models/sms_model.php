<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/8/2
 * Time: 15:27
 */ 	/**
 * 发送短信
 *
 * @param Array $data = array("type"=>"类型","type"=>"类型","user_id"=>"用户","phone"=>"电话","content"=>"内容","time"=>"发送时间");
 * @return Array
 */

class Sms_model extends  CI_Model{

    public function ip_address() {
        if(!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip_address = $_SERVER["HTTP_CLIENT_IP"];
        }else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $ip_address = array_pop(explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']));
        }else if(!empty($_SERVER["REMOTE_ADDR"])){
            $ip_address = $_SERVER["REMOTE_ADDR"];
        }else{
            $ip_address = '';
        }
        return $ip_address;
    }
    public  function testSMS(){

        $http = 'http://www.smswst.com:80/api/httpapi.aspx';		//短信接口
        $uid = 'wangzel';							//用户账号
        $pwd = '888888';							//密码
        $phone	 = '15980265711';	//号码
        $AddSing = 'N';
        $action = 'send';
        $content = '验证码:121212。请不要把验证码泄露给任何人。【地产大亨网】';		//内容
        //即时发送
        $res = self::SendSMS_Common($http,$uid,$pwd,$phone,$content,$AddSing,$action);
        $res = 'test 测试，【地产大亨】';
        return $res;
    }
    public  function SendSMS($data)
    {
        $url = 'http://www.smswst.com:80/api/httpapi.aspx?wangzel?91toufang';
        $sms_url = explode("?",$url);
        $http =$sms_url[0];
        $uid = $sms_url[1];
        $pwd = $sms_url[2];

        if ($data['phone']=="" && $data['user_id']>0){
            $sql = "select phone,phone_status from yyd_users_info where user_id='{$data['user_id']}'";
            $result = $this->db_fetch_array($sql);
            if ($result['phone_status']==1){
                $data['phone'] = $result['phone'];
            }
        }
        $phone=$data['phone'];
        $data['contents'] = $data['contents'];//.$_G['system']['con_sms_text'];
        $content=$data['contents'];
        $AddSing = 'N';
        $action = 'send';
        $result=self::SendSMS_Common($http,$uid,$pwd,$phone,$content,$AddSing,$action); //$result= self::postSMS($data['phone'],$data['contents']);		//POST方式提交
        $data['contents']=  iconv('GB2312', 'UTF-8', $data['contents']);
        $sql = "insert into yyd_approve_smslog set `addtime` = '".time()."',`addip` = '".$this->ip_address()."',user_id='{$data['user_id']}',status='{$result}',`phone`='{$data['phone']}',`type`='{$data['type']}',`code`='{$data['code']}',`contents`='{$data['contents']}'";
      // echo $sql;
        $this->db->query($sql);

        return $result;
    }

    public  function SendSMS_Common($http,$uid,$pwd,$phone,$content,$AddSing,$action)
    {
        $data = array
        (
            'account'=>$uid,					//用户账号
            'password'=>$pwd,			//MD5位32密码,密码和用户名拼接字符
            'mobile'=>$phone,				//号码
            'AddSing'=>$AddSing,
            'action'=>$action,
            'content'=>$content //Encoding::toUTF8($content) //mb_convert_encoding($content,"UTF-8",mb_detect_encoding($content)),			//内容
            //'content'=>mb_convert_encoding($content,"UTF-8",mb_detect_encoding($content)),
        );
        //return $data['content'];
        //return mb_detect_encoding($data['content']);
        //echo "-----dfd---------";
        //var_dump($data);

        $re= self::postSMS_Common($http,$data);			//POST方式提交
        //$re = mb_convert_encoding($re,'UTF-8','ASCII');//mb_detect_encoding($re);

        $xml = simplexml_load_string($re);
        //echo "-----dfd---------";
        //var_dump($xml);
        if($xml->errorstatus->error[0].PHP_EOL>0){
            return "发送失败! 状态：";//.$xml->errorstatus->remark[0].PHP_EOL;
        }else{

            if($xml->successCounts[0].PHP_EOL>0){
                return 1;//"发送成功!";
            }else{
                if($xml->taskID!=null){
                    return "发送失败! taskID:";//.$xml->taskID[0].PHP_EOL;
                }
            }
        }

        return "发送失败!";//+","+$data['password']+","+$data['mobile']+","+$data['content'];

    }

    public static function postSMS_Common($url,$data='')
    {
        $row = parse_url($url);
        $host = $row['host'];
        $port = $row['port'] ? $row['port']:80;
        $file = $row['path'];
        $post = '';
        while (list($k,$v) = each($data))
        {
            $post .= rawurlencode($k)."=".rawurlencode($v)."&";	//转URL标准码
        }
        $post = substr( $post , 0 , -1 );
        $len = strlen($post);
        $fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
        if (!$fp) {
            return "$errstr ($errno)\n";
        } else {
            $receive = '';
            $out = "POST $file HTTP/1.1\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Content-type: application/x-www-form-urlencoded;charset=gb2312\r\n";
            $out .= "Connection: Close\r\n";
            $out .= "Content-Length: $len\r\n\r\n";
            $out .= $post;//mb_convert_encoding($post,'UTF-8');

            //echo "--------------------";
            //var_dump($out);
            fwrite($fp, $out); //fwrite($fp, mb_convert_encoding($out,'UTF-8','ASCII'));
            while (!feof($fp)) {
                $receive .= fgets($fp);
            }
            fclose($fp);
            //return $receive;

            $receive = explode("\r\n\r\n",$receive);
            //echo "-----------111---------";
            //var_dump($receive);
            unset($receive[0]);
            //$xml=simplexml_load_string($receive[1]);
            //return count(exploade("",$receive));
            return implode("",$receive);

        }
    }

    public function db_fetch_array($sql){
        //echo $sql;
        $query = $this->db->query($sql);
        $_res = "";
        $res = $query->result_array();

        if (is_array($res[0])){
            foreach ($res[0] as $key =>$value)
                $_res[$key] =$value;
        }

        return $_res;
    }
    private function IsExist($val)
    {
        if (isset($val)) {
            return $val;
        } else {
            return false;
        }
    }
    function CheckPhoneExist($phone)
    {
        $sql = "select * from yyd_approve_sms where phone =  $phone";
        //echo $sql;
        $result = $this->db_fetch_array($sql);
        //var_dump($result);
        if ($result == false) {

        return false;
       }else{
           return "此号码已经存在";}

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
    function CheckPhoneNumStatus($data)
    {
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/", $data["phone"])){
            return 0;
        }

        $sql = "select * from yyd_approve_sms where phone =  {$data["phone"]} and user_id != {$data["user_id"]}";
        $result = $this->db_fetch_array($sql);
        if ($result == false) {
            $sql = "select * from yyd_approve_sms where  user_id = {$data["user_id"]}";
            $result = $this->db_fetch_array($sql);
            $phone = $result["phone"];
            if($phone == $data["phone"])
                return 2;
            else
                return 3;
        }else{
            return 1;
        }

    }
    function CheckSmsCode($data){
        //echo "CheckSmsCode-----------";
        //var_dump($data);
        $sql="select * from yyd_users where username='".$data["username"]."'";
        $result=$this->db_fetch_array($sql);
        $data['user_id']=$result["user_id"];
       // var_dump($data);
        $sql = "select * from yyd_approve_smslog where user_id={$data['user_id']} and type='{$data['type']}' order by id desc";
        //echo $sql;
        $result =$this->db_fetch_array($sql);
        //$result = end($result);
        //var_dump($result);
        //echo "---------4-----------";
        //var_dump($result);
        if ($result==false) return "approve_sms_not_exiest";
        if ($result['code_status']==1) return "approve_sms_check_yes";
        if ($result['phone']!=$data['phone']) return "approve_sms_phone_error";
        if ($result['code']!=$data['code']) return "approve_sms_code_error";

        $sql = "update yyd_approve_smslog set code_status=1,code_time='".time()."' where id={$result['id']}";
        $this->db->query($sql);

        $sql = "select id from yyd_approve_sms where user_id='{$data['user_id']}'";
        //echo $sql;
        $result = $this->db_fetch_array($sql);
        //echo "---------5-----------";
        //var_dump($result);
        $_data['id'] = $result['id'];
        $_data['verify_remark'] = iconv("GB2312", "UTF-8","用户手机认证通过");
        $_data['status'] = 1;
        $_data['verify_userid'] = 0;
       // var_dump($_data);
        self::CheckSms($_data);
        return $_data['status'];

    }
    function CheckSms($data = array())
    {
        if (!self::IsExist($data['id'])) return "approve_sms_id_empty";

        $sql = "select p1.* from yyd_approve_sms as p1  where id='{$data['id']}'";
       // echo $sql."---------";

        $result = $this->db_fetch_array($sql);
        if ($result == false)
            return "approve_sms_not_exist";
        $user_id = $result['user_id'];
        $phone = $result['phone'];
        //如果不通过的话，则积分变为0
        if ($data['status'] == 2) $data['credit'] = 0;

        //如果通过的话则将短信认证状态都变为3
        if ($data['status'] == 1) {
            $sql = "update yyd_approve_sms set status=3,credit=0 where user_id='{$result['user_id']}' and status=1";
          //  echo $sql."----1-----";
            $result = $this->db->query($sql);
        }

        $sql = "update yyd_approve_sms set verify_userid='{$data['verify_userid']}',verify_remark='{$data['verify_remark']}', verify_time='" . time() . "',status='{$data['status']}',credit='{$data['credit']}' where id='{$data['id']}'";
      //  echo $sql."----2-----";
        $result = $this->db->query($sql);
        if ($result != false) {
            $user_info['user_id'] = $user_id;
            if ($data['status'] != 1) {
                $phone = "";
            }
            $user_info['phone'] = $phone;
            $user_info['phone_status'] = $data['status'];
            $this->load->model("User_model");
            $result = $this->User_model->UpdateUsersInfo($user_info);
        }

        return $data['id'];
    }
    function AddSms($data = array()){

        //echo "-------------3-------------3--------";
        //手机号码不能为空
        if (!self::IsExist($data['phone'])) return "approve_sms_phone_empty";

        //判断手机是否正确
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/", $data['phone'])){
            return "approve_sms_phone_error";
        }

        //判断用户名是否存在
        if (self::IsExist($data['username']) != false){
            $sql = "select user_id from yyd_users where username='{$data['username']}'";
            $result =  $this->db_fetch_array($sql);
            if ($result==false) return "approve_sms_username_not_exiest";
            $data['user_id'] = $result['user_id'];
        }

        //判断用户id是否存在
        if (!self::IsExist($data['user_id'])){
            return "approve_sms_userid_not_exiest";
        }

        //判断是否有待审核的短信验证码
        $status =0 ;
        $sql = "select * from yyd_approve_sms where `user_id`='{$data['user_id']}' ";
        $result = $this->db_fetch_array($sql);
        if ($result!=false && $result['status']==1) return "approve_sms_phone_status_exiest";
        if ($result!=false) $status = 1;
        //判断手机号码是否存在,状态0表示申请中，1表示通过，2表示审核不通过，3表示过期
        $sql = "select * from yyd_approve_sms where `phone`='{$data['phone']}' and status=1";
        $result = $this->db_fetch_array($sql);
        if ($result!=false) return "approve_sms_phone_exiest";

        if ($status==0){
            $sql = "insert into yyd_approve_sms set `addtime` = '".time()."',`addip` = '".$this->ip_address()."',user_id='{$data['user_id']}',status=0,`phone`='{$data['phone']}'";
           // echo $sql."-----------1---------";
            $this->db->query($sql);
        }else{
            $sql = "update yyd_approve_sms set phone='{$data['phone']}',status=0 where user_id='{$data['user_id']}'";
            //echo $sql."-----------2---------";
            $this->db->query($sql);

        }
        return $data['user_id'];
    }

}