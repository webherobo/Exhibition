<?php

namespace Admin\Controller;

use Base\Controller\AdminBaseController;
use Think\Page;

class UserController extends AdminBaseController {

    public function login() {

        if (IS_POST) {
            $user = D("User")->verifyUsers(I('post.username'), I('post.password'));

            if (is_array($user)) {
                session("admininfo", $user);
                $this->success('登陆成功页面跳转中...', U('Index/index'), 3);
            } else {
                $this->error('用户不存在或者密码错误，请重新登陆！');
            }
        } else {
            $this->display();
        }
    }

    public function logout() {
        session("admininfo", null);
        $this->success('退出成功！页面跳转中...', U('User/login'), 3);
    }

    public function management() {

        $nowpage = I("get.p");
        $userlist = D("User")->userlist($nowpage);
        $usercount = D("User")->count("id");
        $this->assign("userlist", $userlist);

        $pages = new Page($usercount, 5);
        $this->assign("pages", $pages->show());
        //print_r($pages . $usercount);
        $this->display();
    }

    public function deleteuser() {

        $id = array("id" => I("get.id"));
        $usercount = D("User")->where($id)->delete();
        if ($usercount) {
            $this->success('删除成功页面跳转中...', U('management'), 3);
        } else {
            //如果返回值是false则表示SQL出错，返回值如果为0表示没有删除任何数据。
            $this->error('用户删除失败！');
        }
    }

    public function adduser($username = '', $password = '', $email = '',$rolename='') {

        if (IS_POST) { //注册用户
            /* 调用注册接口注册用户 */
            $User = D("user");
            $data['username'] = $username;
            $data['rolename'] = $rolename;
            $data['password'] = $password;
            $data['email'] = $email;
            $uid = $User->adduser($data);

            if (0 < $uid) { //注册成功
                //TODO: 发送验证邮件
                $this->success('添加成功！', U('management'));
            } else { //注册失败，显示错误信息
                $this->error($this->showRegError($uid));
            }
        } else { //显示注册表单
            $where = array('status' => "on");
            $rolelist = M('role')->where($where)->select();
            $this->assign('rolelist', $rolelist);
            $this->display();
        }
    }

    public function editer($username = '', $password = '', $email = '',$rolename ='') {

        $User = D("User");
        if (IS_POST) { //修改用户

            /* 调用用户修改接口 */

            $data['id'] = I('get.id');
            $data['username'] = I("post.username");
            $data['rolename'] = I("post.rolename");
            I("post.password") != "" ? $data['password'] = md5(I("post.password")) : "";
            $data['email'] = I("post.email");
            $data['update_time'] = date("Y-m-d H:i:s", time());

            $uid = $User->updateUserFields($data);

            if ($uid !== false) { //注册成功
                //TODO: 发送验证邮件
                $this->success('修改成功！', U('management'));
            } else { //注册失败，显示错误信息
                $this->error("修改失败！");
            }
        } else { //显示注册表单
            $userinfo = $User->getuserinfo(I('get.id'));
            $this->assign('userinfo', $userinfo);
            $where = array('status' => "on");
            $rolelist = M('role')->where($where)->select();
            $this->assign('rolelist', $rolelist);
            $this->display();
        }
    }

    /**
     * 修改密码
     */
    public function changepassword($password = "", $newpassword = "") {
        if (IS_POST) {
            $istrue = D("User")->verifyUser(session("admininfo.id"), $password);

            if ($istrue) {
                $where = array("id" => session("admininfo.id"));
                D("User")->where($where)->setField("password", md5($newpassword));
                $this->success("密码修改成功！", U("changePassword"));
            } else {
                $this->error("原始密码不对，密码修改失败！", U("changePassword"));
            }
        } else {

            $this->display();
        }
    }

    /**
     * 角色添加
     */
    public function addrole() {
        if (IS_POST) {
            $date['name'] = I("post.rolename");
            $date['enname'] = I("post.roleenname");
            $date['pid'] = I("post.pid");
            $date['status'] = I("post.status");
            $isadd = M('role')->add($date);
            if ($isadd) {
                $this->success("角色添加成功！", U("rolelist"));
            } else {
                $this->error("角色添加失败！", U("rolelist"));
            }
        } else {
            $this->display();
        }
    }

    /**
     * 角色添加
     */
    public function editrole() {
        if (IS_POST) {
            $date['name'] = I("post.rolename");
            $date['enname'] = I("post.roleenname");
            $date['pid'] = I("post.pid");
            $date['status'] = I("post.status");
            $where['id'] = I("get.id");
            $isadd = M('role')->where($where)->save($date);
            if ($isadd !== false) {
                $this->success("角色修改成功！", U("rolelist"));
            } else {
                $this->error("角色修改失败！", U("rolelist"));
            }
        } else {
            $where['id'] = I("get.id") ? I("get.id") : session("admininfo.id");
            $role = M('role')->where($where)->find();
            $this->assign("role", $role);
            $this->display();
        }
    }

    /**
     * 角色删除
     */
    public function deleterole() {

        $date['pid'] = I("get.id") ? I("get.id") : I("post.id");

        $isadd = M('role')->where($date)->delete();
        if ($isadd) {
            $this->success("角色删除成功！", U("rolelist"));
        } else {
            $this->error("角色删除失败！", U("rolelist"));
        }
    }

    /**
     * 角色列表
     */
    public function rolelist() {
        
        $nowpage = I("get.p");
        $where = array('status' => "on");
        $rolecount = D("Role")->count("id");
        $this->assign("userlist", $userlist);

        $pages = new Page($rolecount, 4);
        $this->assign("pages", $pages->show());
        $rolelist = M('role')->where($where)->page($nowpage,$pages->listRows)->select();
        $this->assign('rolelist', $rolelist);
        $this->display();
    }

    /**
     * 获取用户注册错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    private function showRegError($code = 0) {
        switch ($code) {
            case -1: $error = '用户名长度必须在16个字符以内！';
                break;
            case -2: $error = '用户名被禁止注册！';
                break;
            case -3: $error = '用户名被占用！';
                break;
            case -4: $error = '密码长度必须在6-30个字符之间！';
                break;
            case -5: $error = '邮箱格式不正确！';
                break;
            case -6: $error = '邮箱长度必须在1-32个字符之间！';
                break;
            case -7: $error = '邮箱被禁止注册！';
                break;
            case -8: $error = '邮箱被占用！';
                break;
            case -9: $error = '手机格式不正确！';
                break;
            case -10: $error = '手机被禁止注册！';
                break;
            case -11: $error = '手机号被占用！';
                break;
            default: $error = '未知错误';
        }
        return $error;
    }

}
