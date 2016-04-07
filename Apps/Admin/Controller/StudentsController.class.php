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

    function file_exists_case($filename) {
        if (is_file($filename)) {
            if (strstr(PHP_OS, 'WIN')) {
                if (basename(realpath($filename)) != basename($filename))
                    return false;
            }
            return true;
        }
        return false;
    }

    public function phpexcelimport() {
        if (IS_POST) {

            vendor("ThinkExcel.PHPExcel");
            $objPHPExcel = new \PHPExcel();
            $PHPReader = new \PHPExcel_Reader_Excel5(); //默认是excel2007 
            //获取上传的文件名
            $filename = $_FILES['inputExcel'];
            //上传到服务器上的临时文件名
            $filepathname = "Uploads/Excel/" . $this->uploadFile($filename); //"Uploads/Excel/20160407/studentsExcel14600096433.xls";
            if (file_exists($filepathname)) {
                echo $filepathname;
                if (!$PHPReader->canRead($filepathname)) {
                    $PHPReader = new \PHPExcel_Reader_Excel2007(); //如果不成功的时候用以前的版本来读取  
                    if (!$PHPReader->canRead($filepathname)) {
                        echo 'no Excel';
                        return;
                    }
                }
            } else {
                echo "文件 $filepathname 不存在";
            }

            $objPHPExcel = $PHPReader->load($filepathname);
            $currentSheet = $objPHPExcel->getSheet(0);
            //取得一共有多少列  
            $allColumn = $currentSheet->getHighestColumn();
            //取得一共有多少行  
            $allRow = $currentSheet->getHighestRow();
            //循环读取数据,默认是utf-8输出  
            for ($i = 3; $i <= $allRow; $i++) {
                $ACELL = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                if (!is_null($ACELL)) {  //如果列不给空就得到它的坐标和计算的值
                    $data['name'] = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
                    $data['ages'] = $objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
                    $data['card_id'] = $objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
                    $data['tel'] = $objPHPExcel->getActiveSheet()->getCell("E" . $i)->getValue();
                    $data['email'] = $objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
                    $data['receiver'] = $objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue();
                    $data['create_time'] = $objPHPExcel->getActiveSheet()->getCell("H" . $i)->getValue();
                    $data['comment'] = $objPHPExcel->getActiveSheet()->getCell("I" . $i)->getValue();
                    $User = D("Students");
                    $uid = $User->adduser($data);
                }
            }

            $this->success('数据导入成功跳转中...', U('phpexcelimport'), 3);
        } else {
            $this->display();
        }
    }

    public function phpexcelexport() {

        // $phpexcel = new \PHPExcel();

        $userlist = D("Students")->userlist($nowpage);
        $this->assign("userlist", $userlist);
        //print_r($userlist);exit;
        vendor("ThinkExcel.PHPExcel");
        // Create new PHPExcel object  
        $objPHPExcel = new \PHPExcel();
        // Set properties  
        $objPHPExcel->getProperties()->setCreator("博宇")
                ->setLastModifiedBy("博宇")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");

        //set width  
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(26);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(32);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(88);

        //设置行高度  
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        //set font size bold  
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //设置水平居中  
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //合并cell  
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
//        //插入图像
//        $objDrawing = new PHPExcel_Worksheet_Drawing();
//        /* 设置图片路径 切记：只能是本地图片 */
//        $objDrawing->setPath('图像地址');
//        /* 设置图片高度 */
//        $objDrawing->setHeight(180); //照片高度
//        $objDrawing->setWidth(150); //照片宽度
//        /* 设置图片要插入的单元格 */
//        $objDrawing->setCoordinates('E2');
//        /* 设置图片所在单元格的格式 */
//        $objDrawing->setOffsetX(5);
//        $objDrawing->setRotation(5);
//        $objDrawing->getShadow()->setVisible(true);
//        $objDrawing->getShadow()->setDirection(50);
//        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objRichText = new \PHPExcel_RichText();
        $objPayable = $objRichText->createTextRun('订单数据汇总  时间:' . date('Y-m-d H:i:s'));
        $objPayable->getFont()->setBold(true); //加粗
        $objPayable->getFont()->setItalic(true); //倾斜
        $objPayable->getFont()->setColor(new \PHPExcel_Style_Color(\PHPExcel_Style_Color::COLOR_DARKGREEN)); //设置颜色为绿色
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFill()->getStartColor()->setARGB('FFDDDDDD');
        // set table header content  
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', $objRichText)
                ->setCellValue('A2', '客户ID')
                ->setCellValue('B2', '姓名')
                ->setCellValue('C2', '年龄')
                ->setCellValue('D2', '身份证号')
                ->setCellValue('E2', '电话')
                ->setCellValue('F2', '邮箱')
                ->setCellValue('G2', '推荐人')
                ->setCellValue('H2', '添加時間')
                ->setCellValue('I2', '备注');

//        综合设置样例
//        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
//                array(
//                    'font' => array(
//                        'bold' => true
//                    ),
//                    'alignment' => array(
//                        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//                    ),
//                    'borders' => array(
//                        'top' => array(
//                            'style' => \PHPExcel_Style_Border::BORDER_THIN
//                        )
//                    ),
//                    'fill' => array(
//                        'type' => \PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
//                        'rotation' => 90,
//                        'startcolor' => array(
//                            'argb' => 'FFA000A0'
//                        ),
//                        'endcolor' => array(
//                            'argb' => 'FFF00FFF'
//                        )
//                    )
//                )
//        );
//         Miscellaneous glyphs, UTF-8  
        for ($i = 0; $i < count($userlist) + 12; $i++) {
            $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3))->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3))->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $userlist[$i]['id']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $userlist[$i]['name']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $userlist[$i]['ages']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $userlist[$i]['create_time']); //这里调用了common.php的时间戳转换函数  
            $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $userlist[$i]['tel']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $userlist[$i]['email']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), $userlist[$i]['receiver']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('H' . ($i + 3), $userlist[$i]['create_time']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('I' . ($i + 3), $userlist[$i]['comment']);
            $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':I' . ($i + 3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':I' . ($i + 3))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':I' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);
        }


        //  sheet命名  
        $objPHPExcel->getActiveSheet()->setTitle('订单汇总表');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet  
        $objPHPExcel->setActiveSheetIndex(0);

        ob_end_clean(); //清除缓冲区,避免乱码 
        // excel头参数  
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition: attachment;filename="订单汇总表(' . date('Ymd-His') . ').xls"');  //日期为文件名后缀  
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式  
        $objWriter->save('php://output');

        //$this->success('数据导出成功跳转中...', U('smanagement'), 3);
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

    //导入Excel文件
    function uploadFile($file) {
        header("Content-Type:text/html;charset=utf-8");
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'xls'); // 设置附件上传类型
        $upload->rootPath = './Uploads/Excel/'; // 设置附件上传根目录
        $name = explode('.', $file['name']);
        $upload->saveName = "studentsExcel" . rand(1, 3); // 设置附件上传根目录
        $upload->autoSub = true;
        $upload->replace = true;
        $upload->subName = array('date', 'Ymd');
        // 上传单个文件 
        $info = $upload->uploadOne($file);
        if (!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        } else {// 上传成功 获取上传文件信息
            return iconv('gb2312', 'utf-8', $info['savepath'] . $info['savename']);
        }
    }

}
