<?php
/**
 * Created by PhpStorm.
 * User: linwei
 * Date: 2015/9/11
 * Time: 8:51
 */
$config = array(
    'signup' => array(
        array(
            'field' => 'username',
            'label' => iconv('GB2312', 'UTF-8','用户名'),
            'rules' => 'trim|required|min_length[1]|max_length[40]',
        ),
        array(
            'field' => 'password',
            'label' => iconv('GB2312', 'UTF-8','密码'),
            'rules' => 'trim|required|min_length[6]|alpha_numeric',
        )
    ),
    'mailRegister' => array(
        array(
            'field' => 'email',
            'label' => iconv('GB2312', 'UTF-8','邮箱'),
            'rules' => 'trim|required|valid_email',
        ),
        array(
            'field' => 'username',
            'label' => iconv('GB2312', 'UTF-8','用户名'),
            'rules' => 'trim|required|min_length[1]|max_length[40]',
        ),
        array(
            'field' => 'password',
            'label' => iconv('GB2312', 'UTF-8','密码'),
            'rules' => 'trim|required|min_length[6]|alpha_numeric',
        ),
         array(
             'field' => 'verify',
             'label' => iconv('GB2312', 'UTF-8','验证码'),
             'rules' => 'trim|required|callback_check_verify',
         ),
         array(
             'field' => 'checkbox',
             'label' => iconv('GB2312', 'UTF-8','隐私条款'),
             'rules' => 'required',
         )

    ),
    "resetPwd" => array(

        array(
            'field' => 'oldpassword',
            'label' => iconv('GB2312', 'UTF-8','原密码'),
            'rules' => 'trim|required|min_length[6]|alpha_numeric|callback_oldpassword_check',
        ),
        array(
            'field' => 'newpasswordcmf',
            'label' => iconv('GB2312', 'UTF-8','确认新密码'),
            'rules' => 'trim|required|min_length[6]|alpha_numeric|callback_password_compare',
        ),
        array(
            'field' => 'newpassword',
            'label' => iconv('GB2312', 'UTF-8','新密码'),
            'rules' => 'trim|required|min_length[6]|alpha_numeric',
        ),
        array(
            'field' => 'verify',
            'label' => iconv('GB2312', 'UTF-8','验证码'),
            'rules' => 'trim|required',
        ),
    ),
    "setPayPwd" => array(
        array(
            'field' => 'newpasswordcmf',
            'label' => iconv('GB2312', 'UTF-8','确认新密码'),
            'rules' => 'trim|required|min_length[6]|alpha_numeric|callback_password_compare',
        ),
        array(
            'field' => 'newpassword',
            'label' => iconv('GB2312', 'UTF-8','新密码'),
            'rules' => 'trim|required|min_length[6]|alpha_numeric',
        ),
        array(
            'field' => 'verify',
            'label' => iconv('GB2312', 'UTF-8','验证码'),
            'rules' => 'trim|required',
        )
    ),
     "getPwd" => array(
        array(
            'field' => 'email',
            'label' => iconv('GB2312', 'UTF-8','邮箱'),
            'rules' => 'trim|required|valid_email',
        ),
        array(
            'field' => 'username',
            'label' => iconv('GB2312', 'UTF-8','用户名'),
            'rules' => 'trim|required|min_length[5]|max_length[40]',
        ),
     ),
     "smsverify" => array(
         array(
             'field' => 'phonenum',
             'label' => iconv('GB2312', 'UTF-8','电话号码'),
             'rules' => 'required|numeric|callback_check_phonenum',
         ),
         array(
             'field' => 'username',
             'label' => iconv('GB2312', 'UTF-8','用户名'),
             'rules' => 'trim|required|min_length[1]|max_length[40]',
         ),
         array(
             'field' => 'password',
             'label' => iconv('GB2312', 'UTF-8','密码'),
             'rules' => 'trim|required|min_length[6]|alpha_numeric',
         ),
         array(
             'field' => 'verify',
             'label' => iconv('GB2312', 'UTF-8','验证码'),
             'rules' => 'trim|required|numeric|callback_check_verify',
         ),
         array(
             'field' => 'smsverify',
             'label' => iconv('GB2312', 'UTF-8',"sms验证码"),
             'rules' => 'trim|required|numeric',
         ),
         array(
             'field' => 'checkbox',
             'label' => iconv('GB2312', 'UTF-8','隐私条款'),
             'rules' => 'required',
         )
     ),

     "identityverify" => array(

        array(
            'field' => 'username',
            'label' => iconv('GB2312', 'UTF-8','姓名'),
            'rules' => 'trim|required|min_length[1]|max_length[40]',
        ),
        array(
            'field' => 'icnumber',
            'label' => iconv('GB2312', 'UTF-8','身份证号'),
            'rules' => 'trim|required|min_length[15]|max_length[18]|numeric',
        ),

     ),
     "phoneverify" => array(

         array(
             'field' => 'phonenum',
             'label' => iconv('GB2312', 'UTF-8','电话号码'),
             'rules' => 'required|numeric|callback_check_phonenum',
         ),
         array(
             'field' => 'verify',
             'label' => iconv('GB2312', 'UTF-8','验证码'),
             'rules' => 'trim|required|numeric',
         )
     ),


     "mailverify" => array(

         array(
             'field' => 'email',
             'label' => iconv('GB2312', 'UTF-8','邮箱'),
             'rules' => 'trim|required|valid_email',
         ),

     ),
    "beitopupstep2" => array
    (
        array(
            'field' => 'cardbindmobilephoneno',
            'label' => iconv('GB2312', 'UTF-8','电话号码'),
            'rules' => 'numeric|callback_check_bindphonenum',
        ),
        array(
            'field' => 'certno',
            'label' => iconv('GB2312', 'UTF-8','身份证号'),
            'rules' => 'trim|min_length[15]|max_length[18]|numeric',
        ),
        array(
            'field' => 'cardno',
            'label' => iconv('GB2312', 'UTF-8','银行卡号'),
            'rules' => 'trim|min_length[15]|max_length[25]|numeric',
        ),
        array(
            'field' => 'amount',
            'label' => iconv('GB2312', 'UTF-8','支付金额'),
            'rules' => 'trim|numeric',
        ),
    )
);