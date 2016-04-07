<?php

namespace Home\Controller;

use Base\Controller\AdminBaseController;
use Think\Page;

class IndexController extends AdminBaseController {

    public function index() {
        $pages = new Page(10000);
        header("Content-type: text/html; charset=utf-8");
        echo $pages->show() . $pages->rollPage;
    }

    public function test() {
        header("Content-type:text/html;charset=utf-8");
        echo date("Y  年  m  月  d  日", '1457963399');
        $filename1 =iconv('gb2312','utf-8',"Uploads/Excel/20160407/订单汇总表(20160406-150425)8.xls"); //__ROOT__ . "/Public/8.xls";
        $filename ="Public/8.xls"; //__ROOT__ . "/Public/8.xls";
        $filePath = realpath( $filename1);
        if (file_exists($filePath)) {
            echo $filePath ;
            echo "文件 $filePath 存在";
        } else {
            echo "文件 $filePath 不存在";
        }
    }

    public function login() {
        $this->display();
    }

}
