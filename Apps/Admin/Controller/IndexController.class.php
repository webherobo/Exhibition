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

    public function aboutus() {
        //$this->theme('admin')->display('index');
        $this->display();
    }

    public function tubiao() {
        //$this->theme('admin')->display('index');
        $this->display();
    }

}
