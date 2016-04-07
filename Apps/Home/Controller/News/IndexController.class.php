<?php
namespace Home\Controller\news;
use Base\Controller\HomeBaseController;
use Think\Controller;
class IndexController extends HomeBaseController {
    public function index(){
        $User = D("user"); // 实例化User对象
        $data['username'] = 'ThinkPHP';
        $data['password'] = 'ThinkPHP@gmail.com';
        $data['logintime'] = date('Y-m-d H:i:s',strtotime('+1 day'));
        $data['loginip'] =  get_client_ip();
        $data['status'] = '1';
        $data['createtime'] = date('Y-m-d H:i:s');
        if (!$User->create($data)){    
            // 如果创建失败 表示验证没有通过 输出错误提示信息   
              exit($User->getError());
             }else{  
                 $User->add($data);
                 // 验证通过 可以进行其他数据操作}
        }
        //$User->add($data);
        //print_r(get_client_ip());
        $this->theme('default')->display('index');
  }

}