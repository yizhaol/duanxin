<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php

if(isset($_POST['phone'])){
$phone=daddslashes($_POST['phone']);

$row=$DB->get_row("SELECT * FROM `msg_phone` WHERE phone='{$phone}' limit 1");
if($row!='')exit("<script language='javascript'>window.alert('当前手机号已是白名单');window.location.href='phone.php';</script>");
	$sql="insert into `msg_phone` (`phone`) values ('$phone')";
	$DB->query($sql);
exit("<script language='javascript'>window.alert('添加成功');window.location.href='phonelist.php';</script>");

} ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">添加白名单</h3></div>
        <div class="panel-body">
          <form action="./phone.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon">手机号</span>
              <input type="text" name="phone" class="form-control" placeholder="13888888888" autocomplete="off" required/>
</div><br/>


            <div class="form-group">
              <div class="col-sm-12"><input type="submit" value="添加" class="btn btn-primary form-control"/></div>
            </div>
          </form>
        任何用户对白名单手机号无权限轰炸
      </div>
    </div>
  </div>