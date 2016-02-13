<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/8/2
 * Time: 15:27
 */ 	/**
 * ���Ͷ���
 *
 * @param Array $data = array("type"=>"����","type"=>"����","user_id"=>"�û�","phone"=>"�绰","content"=>"����","time"=>"����ʱ��");
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

        $http = 'http://www.smswst.com:80/api/httpapi.aspx';		//���Žӿ�
        $uid = 'wangzel';							//�û��˺�
        $pwd = '888888';							//����
        $phone	 = '15980265711';	//����
        $AddSing = 'N';
        $action = 'send';
        $content = '��֤��:121212���벻Ҫ����֤��й¶���κ��ˡ����ز��������';		//����
        //��ʱ����
        $res = self::SendSMS_Common($http,$uid,$pwd,$phone,$content,$AddSing,$action);
        $res = 'test ���ԣ����ز���ࡿ';
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
        $result=self::SendSMS_Common($http,$uid,$pwd,$phone,$content,$AddSing,$action); //$result= self::postSMS($data['phone'],$data['contents']);		//POST��ʽ�ύ
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
            'account'=>$uid,					//�û��˺�
            'password'=>$pwd,			//MD5λ32����,������û���ƴ���ַ�
            'mobile'=>$phone,				//����
            'AddSing'=>$AddSing,
            'action'=>$action,
            'content'=>$content //Encoding::toUTF8($content) //mb_convert_encoding($content,"UTF-8",mb_detect_encoding($content)),			//����
            //'content'=>mb_convert_encoding($content,"UTF-8",mb_detect_encoding($content)),
        );
        //return $data['content'];
        //return mb_detect_encoding($data['content']);
        //echo "-----dfd---------";
        //var_dump($data);

        $re= self::postSMS_Common($http,$data);			//POST��ʽ�ύ
        //$re = mb_convert_encoding($re,'UTF-8','ASCII');//mb_detect_encoding($re);

        $xml = simplexml_load_string($re);
        //echo "-----dfd---------";
        //var_dump($xml);
        if($xml->errorstatus->error[0].PHP_EOL>0){
            return "����ʧ��! ״̬��";//.$xml->errorstatus->remark[0].PHP_EOL;
        }else{

            if($xml->successCounts[0].PHP_EOL>0){
                return 1;//"���ͳɹ�!";
            }else{
                if($xml->taskID!=null){
                    return "����ʧ��! taskID:";//.$xml->taskID[0].PHP_EOL;
                }
            }
        }

        return "����ʧ��!";//+","+$data['password']+","+$data['mobile']+","+$data['content'];

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
            $post .= rawurlencode($k)."=".rawurlencode($v)."&";	//תURL��׼��
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
           return "�˺����Ѿ�����";}

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
        $_data['verify_remark'] = iconv("GB2312", "UTF-8","�û��ֻ���֤ͨ��");
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
        //�����ͨ���Ļ�������ֱ�Ϊ0
        if ($data['status'] == 2) $data['credit'] = 0;

        //���ͨ���Ļ��򽫶�����֤״̬����Ϊ3
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
        //�ֻ����벻��Ϊ��
        if (!self::IsExist($data['phone'])) return "approve_sms_phone_empty";

        //�ж��ֻ��Ƿ���ȷ
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/", $data['phone'])){
            return "approve_sms_phone_error";
        }

        //�ж��û����Ƿ����
        if (self::IsExist($data['username']) != false){
            $sql = "select user_id from yyd_users where username='{$data['username']}'";
            $result =  $this->db_fetch_array($sql);
            if ($result==false) return "approve_sms_username_not_exiest";
            $data['user_id'] = $result['user_id'];
        }

        //�ж��û�id�Ƿ����
        if (!self::IsExist($data['user_id'])){
            return "approve_sms_userid_not_exiest";
        }

        //�ж��Ƿ��д���˵Ķ�����֤��
        $status =0 ;
        $sql = "select * from yyd_approve_sms where `user_id`='{$data['user_id']}' ";
        $result = $this->db_fetch_array($sql);
        if ($result!=false && $result['status']==1) return "approve_sms_phone_status_exiest";
        if ($result!=false) $status = 1;
        //�ж��ֻ������Ƿ����,״̬0��ʾ�����У�1��ʾͨ����2��ʾ��˲�ͨ����3��ʾ����
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