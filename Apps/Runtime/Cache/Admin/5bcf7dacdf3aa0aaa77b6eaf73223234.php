<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>用户新增</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/Exhibition/Public/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="/Exhibition/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/Exhibition/Public/css/commcss.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/Exhibition/Public/js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="/Exhibition/Public/bootstrap/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="container">
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
        <style>
            .pagination ul {
                display: inline-block;
                margin-bottom: 0;
                margin-left: 0;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            }
            .pagination ul li {
                display: inline;
            }

            .pagination ul li.rows {
                line-height: 30px;
                padding-left: 5px;
            }
            .pagination ul li.rows b{color: #f00}

            .pagination ul li a, .pagination ul li span {
                float: left;
                padding: 4px 12px;
                line-height: 20px;
                text-decoration: none;
                background-color: #fff;
                background: url('../images/bottom_bg.png') 0px 0px;
                border: 1px solid #d3dbde;
                /*border-left-width: 0;*/
                margin-left: 2px;
                color: #08c;
            }
            .pagination ul li a:hover{
                color: red;
                background: #0088cc;
            }
            .pagination ul li.first-child a, .pagination ul li.first-child span {
                border-left-width: 1px;
                -webkit-border-bottom-left-radius: 3px;
                border-bottom-left-radius: 3px;
                -webkit-border-top-left-radius: 3px;
                border-top-left-radius: 3px;
                -moz-border-radius-bottomleft: 3px;
                -moz-border-radius-topleft: 3px;
            }
            .pagination ul .disabled span, .pagination ul .disabled a, .pagination ul .disabled a:hover {
                color: #999;
                cursor: default;
                background-color: transparent;
            }
            .pagination ul .active a, .pagination ul .active span {
                color: #999;
                cursor: default;
            }
            .pagination ul li a:hover, .pagination ul .active a, .pagination ul .active span {
                background-color: #f0c040;
            }
            .pagination ul li.last-child a, .pagination ul li.last-child span {
                -webkit-border-top-right-radius: 3px;
                border-top-right-radius: 3px;
                -webkit-border-bottom-right-radius: 3px;
                border-bottom-right-radius: 3px;
                -moz-border-radius-topright: 3px;
                -moz-border-radius-bottomright: 3px;
            }

            .pagination ul li.current a{color: #f00 ;font-weight: bold; background: #ddd}
        </style>
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
            <a href="#">
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
    <a href="#">
        <i class="glyphicon glyphicon-calendar"></i>
        图表统计
    </a>
</li>
<li>
    <a href="#">
        <i class="glyphicon glyphicon-fire"></i>
        关于系统
    </a>
</li>

</ul>
</div>


                        <div class="col-md-10 panel panel-default" >
                            <div class="panel-body">
                                <h1>客户管理
                                    <small>新增客户</small>
                                </h1>
                                <form class="form-horizontal" role="form" action="/Exhibition/admin.php?m=Admin&c=students&a=adduser" method="post">
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-2 control-label">名字</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="firstname" 
                                                   placeholder="请输入名字" name="name" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-2 control-label">年龄</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="firstname" 
                                                   placeholder="请输入年龄" name="ages" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-2 control-label">身份证号</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="firstname" 
                                                   placeholder="请输入身份证" name="card_id" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-sm-2 control-label">电话</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lastname" 
                                                   placeholder="请输电话" name="tel">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="firstname" 
                                                   placeholder="请输入邮箱" name="email" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-sm-2 control-label">推荐人</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lastname" 
                                                   placeholder="请输推荐人" name="receiver">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-sm-2 control-label">备注</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lastname" 
                                                   placeholder="请输备注" name="comment">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">新 增</button>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>   

        </div>


        <h1 class="text-center" >Hello, world!</h1>
        <div class="container">
            <div class="jumbotron">
                <h1>我的第一个 Bootstrap 页面</h1>
                <p>重置窗口大小，查看响应式效果！</p> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h3>Column 1</h3>
                    <p>学的不仅是技术，更是梦想！</p>
                    <p>再牛逼的梦想,也抵不住你傻逼似的坚持！</p>
                </div>
                <div class="col-sm-4">
                    <h3>Column 2</h3>
                    <p>学的不仅是技术，更是梦想！</p>
                    <p>再牛逼的梦想,也抵不住你傻逼似的坚持！</p>
                </div>
                <div class="col-sm-4">
                    <h3>Column 3</h3> 
                    <p>学的不仅是技术，更是梦想！</p>
                    <p>再牛逼的梦想,也抵不住你傻逼似的坚持！</p>
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