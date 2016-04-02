<?php

namespace Admin\Controller;

use Base\Controller\AdminBaseController;
use Think\Page;

class StudentsController extends AdminBaseController {

    public function smanagement() {
        $nowpage = I("get.p");
        $nowpage = isset($nowpage) ? $nowpage : 1;
        $userlist = D("Students")->userlist($nowpage);
        $usercount = D("Students")->count("id");
        $this->assign("userlist", $userlist);

        $pages = new Page($usercount, 6);
        $this->assign("pages", $pages->show());
        //print_r( $pages->show() . $usercount);
        $this->display();
    }

    public function deleteuser() {

        $id = array("id" => I("get.id"));
        $usercount = D("Students")->where($id)->delete();
        if ($usercount) {
            $this->success('删除成功页面跳转中...', U('smanagement'), 3);
        } else {
            //如果返回值是false则表示SQL出错，返回值如果为0表示没有删除任何数据。
            $this->error('用户删除失败！');
        }
    }

    public function adduser() {

        if (IS_POST) { //注册用户
            /* 调用注册接口注册用户 */
            $User = D("Students");
            $data = I("post.");
            $uid = $User->adduser($data);
            if (0 < $uid) { //注册成功
                //TODO: 发送验证邮件
                $this->success('添加成功！', U('adduser'));
            } else { //注册失败，显示错误信息
                $this->error($this->showRegError($uid));
            }
        } else { //显示注册表单
            $this->display();
        }
    }

    public function searchuser() {


        if (IS_POST) {
            $where[I("post.type")] = trim(I("post.searchvalue"));
            if (I("post.searchvalue") != "") {
                $usercount = D("Students")->where($map)->count(); //查询数据条数
            } else {
                $this->error("参数不能为空！");
            }
            $usercount = D("Students")->where($where)->count(); //查询数据条数
            $pages = new Page($usercount, 3, $where);

            $userlist = D("Students")->where($where)->page('1,' . $pages->listRows)->select();

            $this->assign("userlist", $userlist);
            $this->assign("pages", $pages->show());
        } else {
            isset($_GET['name']) ? $map['name'] = trim($_GET['name']) : "";
            isset($_GET['receiver']) ? $map['receiver'] = trim($_GET['receiver']) : "";
            if ($map != "") {
                $usercount = D("Students")->where($map)->count(); //查询数据条数
            } else {
                $this->error("参数错误！");
            }
            $pages = new Page($usercount, 3, $map);

            $userlist = D("Students")->where($map)->page($pages->nowPage . ',' . $pages->listRows)->select();

            $this->assign("userlist", $userlist);
            $this->assign("pages", $pages->show());
        }


        //print_r($pages . $usercount);
        $this->display();
    }

    public function receipt($id, $receipt) {
        $condition = array('id' => $id);
        if ($receipt) {
            $data = array('receipt' => 0);
        } else {
            $data = array('receipt' => 1);
        }

        $result = M("Students")->where($condition)->setField($data);
        // print_r($result);exit;
        if ($result !== false) {
            $this->success('修改成功，页面跳转中...', U('smanagement'), 3);
        } else {
            $this->error('用户修改失败！');
        }
    }

    public function editer($username = '', $password = '', $email = '', $rolename = '') {

        $User = D("Students");
        if (IS_POST) { //修改用户

            /* 调用用户修改接口 */


            $data = I("post.");
            $data['id'] = I('get.id');
            $uid = $User->updateUserFields($data);

            if ($uid !== false) { //注册成功
                //TODO: 发送验证邮件
                $this->success('修改成功！', U('smanagement'));
            } else { //注册失败，显示错误信息
                $this->error("修改失败！");
            }
        } else { //显示注册表单
            $userinfo = $User->getuserinfo(I('get.id'));
            //print_r(I('get.id'));exit;
            $this->assign('userinfo', $userinfo);
            $where = array('status' => "on");
            $this->display();
        }
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
