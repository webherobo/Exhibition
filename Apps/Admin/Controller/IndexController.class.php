<?php

namespace Admin\Controller;

use Base\Controller\AdminBaseController;

class IndexController extends AdminBaseController {

    public function index() {
        //$this->theme('admin')->display('index');
        if (session("admininfo")) {
            $this->display();
        } else {
            $this->redirect('User/login', array(), 5, '请登录！页面跳转中...');
        }
    }



}
