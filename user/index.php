<?php

$title='后台管理';
include './head.php';
include("../includes/common.php"); 
?>
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>个人信息</h4>
</div>
<div class="card-body">

            <li class="list-group-item"><span class="icon-ok"></span> <b>账户余额：</b> <?php echo $row['money']?></li>
               <li class="list-group-item"><span class="icon-ok"></span> <b>用户账号：</b> <?php echo $row['user']?></li>
          			<li class="list-group-item"><span class="icon-rss"></span> <b>用户QQ：</b> <?php echo $row['qq']?></li>

<li class="list-group-item"><span class="incon-rss"><b>我的KEY: </b> <?php echo $row['key'];
?></span></li>

                  </li>
          </ul>
      </div>
      </div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>网站公告</h4>
</div>
<div class="card-body">          <div class="panel-body bg-gonggao-p"> <?php $rs=$DB->query("SELECT  *  FROM msg_notice WHERE 1 order by id asc"); while($res = $DB->fetch($rs)) { echo '<li style="line-height: 25px;"><i class="fa fa-caret-right fa-li"></i>'.$res['center'].'<small> - '.$res['date'].'</small>'; } ?>
         </li>
	</ul>
</div>     
  
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>