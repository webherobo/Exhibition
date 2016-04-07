<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>标准网页</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/Exhibition/Public/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="/Exhibition/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/Exhibition/Public/css/commcss.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/Exhibition/Public/js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="/Exhibition/Public/bootstrap/js/bootstrap.min.js"></script>
        <script src="/Exhibition/Public/Chart/Chart.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                $('ul.nav > li').click(function (e) {
                    //e.preventDefault();
                    $('ul.nav > li').removeClass('active');
                    $(this).addClass('active');
                });
                $('#systemSetting').collapse('show');
                // $('#systemSetting').on('show.bs.collapse', function () {
                //       alert('嘿，当您展开时会提示本警告');})

            });
        </script>
        <script>

            var polarData = [
                {
                    value: 300,
                    color: "#F7464A",
                    highlight: "#FF5A5E",
                    label: "Red"
                },
                {
                    value: 50,
                    color: "#46BFBD",
                    highlight: "#5AD3D1",
                    label: "Green"
                },
                {
                    value: 100,
                    color: "#FDB45C",
                    highlight: "#FFC870",
                    label: "Yellow"
                },
                {
                    value: 40,
                    color: "#949FB1",
                    highlight: "#A8B3C5",
                    label: "Grey"
                },
                {
                    value: 120,
                    color: "#4D5360",
                    highlight: "#616774",
                    label: "Dark Grey"
                }

            ];

            window.onload = function () {
                var ctx = document.getElementById("chart-area").getContext("2d");
                window.myPolarArea = new Chart(ctx).PolarArea(polarData, {
                    responsive: true
                });
            };



        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-10 " >
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <a class="navbar-brand"  href="#">CMS管理系统</a>
                        </div>
                        <div>
                            <ul class="nav nav-tabs nav-justified" >
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">SVN</a></li>
                                <li><a href="#">iOS</a></li>
                                <li><a href="#">VB.Net</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Java <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Swing</a></li>
                                        <li><a href="#">jMeter</a></li>
                                        <li><a href="#">EJB</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">分离的链接</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">PHP</a></li>
                            </ul>
                    </nav>
                </div>
                <div class="col-xs-2 ">
                    <div class="btn-group" >
                        <button type="button" class="btn btn-default dropdown-toggle btn-lg" 
                                data-toggle="dropdown" ><i class="glyphicon glyphicon-user"></i>
                            用户管理中心 
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">功能</a></li>
                            <li><a href="#">另一个功能</a></li>
                            <li><a href="#">其他</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo U('User/logout');?>">退出</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">        
                <div class="container-fluid">
                    <div class="row">  
                        <!-- <div class="navbar navbar-duomi navbar-static-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/Admin/index.html" id="logo">配置管理系统（流量包月）
                </a>
            </div>
        </div>
    </div>-->

<div class="col-md-2">
    <ul id="main-nav" class="nav nav-tabs nav-stacked" style="">
        <li class="active">
            <a href="<?php echo U('Index/index');?>">
                <i class="glyphicon glyphicon-th-large"></i>
                首页 		
            </a>
        </li>
        <li class="">
            <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
                <i class="glyphicon glyphicon-cog"></i>
                系统管理
                <span class="pull-right glyphicon glyphicon-chevron-down"></span>
            </a>
            <ul id="systemSetting" class="nav nav-list collapse  secondmenu "  style="height: 0px;">
                <li  <?php if( ACTION_NAME!= 'management' ): ?>class="active" <?php else: ?>  class=""<?php endif; ?> ><a  href="<?php echo U('User/management');?>" ><i class="glyphicon glyphicon-user"></i>用户管理</a></li>
        <li><a  href="<?php echo U('User/rolelist');?>" ><i class="glyphicon glyphicon-asterisk"></i>角色管理</a></li>
        <li><a  href="<?php echo U('User/changepassword');?>" ><i class="glyphicon glyphicon-edit"></i>修改密码</a></li>
        <li><a href="<?php echo U('students/smanagement');?>"><i class="glyphicon glyphicon-th-list"></i>学生列表</a></li>
        <li><a href="<?php echo U('students/adduser');?>"><i class="glyphicon glyphicon-th-list"></i>学生添加</a></li>
        <li><a href="<?php echo U('students/phpexcelimport');?>"><i class="glyphicon glyphicon-th-list"></i>学生数据导入</a></li>
    </ul>
</li>

<li class="">
    <a href="#disSetting" class="nav-header collapsed" data-toggle="collapse">
        <i class="glyphicon glyphicon-cog "></i>
        活动管理
        <span class="pull-right glyphicon glyphicon-chevron-down"></span>
    </a>
    <ul id="disSetting" class="nav nav-list secondmenu collapse">
        <li><a href="<?php echo U('Activity/index');?>"><i class="glyphicon glyphicon-th-list"></i>活动列表</a></li>
    </ul>
</li>



<li>
    <a href="<?php echo U('Index/tubiao');?>">
        <i class="glyphicon glyphicon-calendar"></i>
        图表统计
    </a>
</li>
<li>
    <a href="<?php echo U('Index/aboutus');?>">
        <i class="glyphicon glyphicon-fire"></i>
        关于系统
    </a>
</li>

</ul>
</div>


                        <div class="col-md-10 panel panel-default" >
                            <div class="panel-body">
                                <h1>学的不仅是技术，更是梦想！</h1>
                                <h3>再牛逼的梦想,也抵不住你傻逼似的坚持！</h3>
                                <div id="canvas-holder" style="width:30%">
                                    <canvas id="chart-area" width="300" height="300"/>
                                </div>
                                <div class="alert alert-success">成功！很好地完成了提交。</div>
                                <div class="alert alert-info">信息！请注意这个信息。</div>
                                <div class="alert alert-warning">警告！请不要提交。</div>
                                <div class="alert alert-danger">错误！请进行一些更改。</div>
                            </div>
                        </div>
                    </div>
                </div>   

            </div>
            
    <!-- 底部
    ================================================== -->
      <div class="container text-center">
          <h1> <p> 本站由 <strong><a href="http://www.webherobo.cn" target="_blank">博宇</a></strong> 强力驱动</p></h1>
      </div>


    </body>
</html>