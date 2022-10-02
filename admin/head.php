<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?=$title?></title>
  <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">忧乐短信轰炸系统</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="./"><span class="glyphicon glyphicon-user"></span> 平台首页</a>
         
		
		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-lock"></span>接口管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./add.php">添加接口</a></li> 
<li><a href="./list.php">接口列表</a></li> 
<li><a href="./kelong.php">克隆接口</a></li> 
            </ul>
          </li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-signal"></span>白名单管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./phone.php">添加白名单</a></li>  
  <li><a href="./phonelist.php">白名单列表</a></li>
            </ul>
          </li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-barcode"></span>卡密管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./km.php">添加卡密</a></li>  
  <li><a href="./kmlist.php">卡密列表</a></li>
            </ul>
          </li>


		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span>用户管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./user.php">添加用户</a></li>  
  <li><a href="./userlist.php">用户列表</a></li>
            </ul>
          </li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-zoom-in"></span>数据管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./log.php">轰炸日志</a></li>   
            </ul>
          </li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-flag"></span>高级选项<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./set.php">网站设置</a></li>  
<li><a href="./account.php">账户设置</a></li>  
  <li><a href="./money.php">消费设置</a></li>
<li><a href="./notice.php">公告管理</a></li>  
            </ul>
          </li>

          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->