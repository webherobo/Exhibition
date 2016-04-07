<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author 程波宁
 */

namespace Admin\Model;

use Think\Model\RelationModel;

class UserModel extends RelationModel {

    protected $fields = array('id', 'username', 'rolename', 'email', 'password', 'update_time', 'create_time');

    /* 用户模型自动验证 */
    protected $_validate = array(
        /* 验证用户名 */
        array('username', '1,30', -1, self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
        array('username', '', '帐号名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        array('username', '', -3, self::EXISTS_VALIDATE, 'unique'), //用户名被占用

        /* 验证密码 */
        array('password', 'require', '密码必须'),
        /* 验证邮箱 */
        array('email', 'email', -5, self::EXISTS_VALIDATE), //邮箱格式不正确
        array('email', '1,32', -6, self::EXISTS_VALIDATE, 'length'), //邮箱长度不合法
        array('email', 'checkDenyEmail', -7, self::EXISTS_VALIDATE, 'callback'), //邮箱禁止注册
        array('email', '', -8, self::EXISTS_VALIDATE, 'unique'), //邮箱被占用
    );

    /* 用户模型自动完成 */
    protected $_auto = array(
        array('comment', '', 2, 'ignore'),
        array('password', 'pwdHash', self::MODEL_BOTH, 'callback'),
        array('create_time', 'dateftime', self::MODEL_INSERT, 'callback'),
        array('update_time', 'dateftime', self::MODEL_BOTH, 'callback'),
    );

//加密
    protected function pwdHash() {
        $pwd = I("post.password");
        if (isset($pwd)) {
            $pwd = md5($_POST['password']);
            return $pwd;
            //return hash('md5',$_POST['password']);
        } else {
            return false;
        }
    }

    /**
     * 获取时间
     */
    protected function dateftime() {
        return date("Y-m-d H:i:s", NOW_TIME);
    }

    /**
     * 检测用户名是不是被禁止注册
     * @param  string $username 用户名
     * @return boolean          ture - 未禁用，false - 禁止注册
     */
    protected function checkDenyMember($username) {
        return true; //TODO: 暂不限制，下一个版本完善
    }

    /**
     * 检测邮箱是不是被禁止注册
     * @param  string $email 邮箱
     * @return boolean       ture - 未禁用，false - 禁止注册
     */
    protected function checkDenyEmail($email) {
        return true; //TODO: 暂不限制，下一个版本完善
    }

    /**
     * 检测手机是不是被禁止注册
     * @param  string $mobile 手机
     * @return boolean        ture - 未禁用，false - 禁止注册
     */
    protected function checkDenyMobile($mobile) {
        return true; //TODO: 暂不限制，下一个版本完善
    }

    /**
     * 根据配置指定用户状态
     * @return integer 用户状态
     */
    protected function getStatus() {
        return true; //TODO: 暂不限制，下一个版本完善
    }

    /**
     * 新增一个新用户
     * @param  string $username 用户名
     * @param  string $password 用户密码
     * @param  string $email    用户邮箱
     * @param  string $mobile   用户手机号码
     * @return integer          注册成功-用户信息，注册失败-错误编号
     */
    public function adduser($udata = '') {
        $data = array(
            'username' => $udata['username'],
            'password' => $udata['password'],
            'rolename' => $udata['rolename'],
            'email' => $udata['email'],
        );

        /* 添加用户 */
        if ($this->create($data)) {
            $uid = $this->add();
            return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }

    /**
     * 用户登录认证
     * @param  string  $username 用户名
     * @param  string  $password 用户密码
     * @param  integer $type     用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function verifyUsers($username, $password) {

        $map = array();
        $map['username'] = $username;

        /* 获取用户数据 */
        $user = $this->where($map)->find();

        if (is_array($user)) {
            /* 验证用户密码 */
            if (md5($password) === $user['password']) {
                return $user; //登录成功，返回用户ID
            } else {
                return -2; //密码错误
            }
        } else {
            return -1; //用户不存在或被禁用
        }
    }

    //用户列表

    public function userlist($currentpage, $condition = "") {
        if($condition!= "") {
            
            $userlist = $this->where($condition)->select();
        } else {
            $userlist = $this->page($currentpage != "" ? $currentpage : 1, 2)->order('id asc')->select();
        }
        return $userlist;
    }

//    //用户统计
//    
//    public function usercount(){
//        
//        $userCount = $this->count("id");
//        return $userCount;
//    }

    /**
     * 获取用户信息
     * @param  string  $uid         用户ID或用户名
     * @param  boolean $is_username 是否使用用户名查询
     * @return array                用户信息
     */
    public function getuserinfo($uid, $is_username = false) {
        $map = array();
        if ($is_username) { //通过用户名获取
            $map['username'] = $uid;
        } else {
            $map['id'] = $uid;
        }
        $user = $this->where($map)->find();
        if (is_array($user) && $user['status'] = 1) {
            return $user;
        } else {
            return -1; //用户不存在或被禁用
        }
    }

    /**
     * 检测用户信息
     * @param  string  $field  用户名
     * @param  integer $type   用户名类型 1-用户名，2-用户邮箱，3-用户电话
     * @return integer         错误编号
     */
    public function checkField($field, $type = 1) {
        $data = array();
        switch ($type) {
            case 1:
                $data['username'] = $field;
                break;
            case 2:
                $data['email'] = $field;
                break;
            case 3:
                $data['mobile'] = $field;
                break;
            default:
                return 0; //参数错误
        }

        return $this->create($data) ? 1 : $this->getError();
    }

    /**
     * 更新用户信息
     * @param array $data 修改的字段数组
     * @return true 修改成功，false 修改失败
     * @author huajie <banhuajie@163.com>
     */
    public function updateUserFields($data) {
        if (empty($data)) {
            $this->error = '参数错误！';
            return false;
        }

        //更新用户信息
        $data1 = $this->create($data);
        
        // print_r($data) ;exit;
        // print_r($data);exit;
        if ($data1) {
            return $this->save();
        }
        return false;
    }

    /**
     * 验证用户密码
     * @param int $uid 用户id
     * @param string $password_in 密码
     * @return true 验证成功，false 验证失败
     * @author huajie <banhuajie@163.com>
     */
    public function verifyUser($uid, $password) {
        $upassword = $this->getFieldById($uid, 'password');
        if (md5($password) === $upassword) {
            return true;
        }
        return false;
    }

}
