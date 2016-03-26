<?php
namespace Home\Controller;
use Base\Controller\AdminBaseController;
use Think\Page;
class IndexController extends AdminBaseController {
    
    public function index(){
         $pages=new Page(10000);
         echo $pages->show().$pages->rollPage;


        }
         public function login(){
            $this->display();
        }   
}