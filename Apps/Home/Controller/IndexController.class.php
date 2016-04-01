<?php
namespace Home\Controller;
use Base\Controller\AdminBaseController;
use Think\Page;
class IndexController extends AdminBaseController {
    
    public function index(){
         $pages=new Page(10000);
         header("Content-type: text/html; charset=utf-8"); 
         echo $pages->show().$pages->rollPage;


        }
         public function login(){
            $this->display();
        }   
}