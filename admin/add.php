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

if(isset($_POST['url'])){
$url=daddslashes($_POST['url']);
$post=daddslashes($_POST['post']);
$status=daddslashes($_POST['status']);

$row=$DB->get_row("SELECT * FROM `msg_api` WHERE url='{$url}' limit 1");
if($row!='')exit("<script language='javascript'>window.alert('当前API已经存在');window.location.href='add.php';</script>");
	$sql="insert into `msg_api` (`url`,`post`, `status`) values ('$url','$post','$status')";
	$DB->query($sql);
exit("<script language='javascript'>window.alert('添加成功');window.location.href='list.php';</script>");

} ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">添加接口</h3></div>
        <div class="panel-body">
          <form action="./add.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon">接口地址</span>
              <input type="text" name="url" class="form-control" placeholder="抓包得到的地址" autocomplete="off" required/>
</div><br/>

            <div class="input-group">
              <span class="input-group-addon">POST数据</span>
              <input type="text" name="post" class="form-control" placeholder="没有请留空" autocomplete="off"/>
</div><br/>

           <div class="input-group">
              <span class="input-group-addon">接口状态</span><select name="status" class="form-control" default="1">
	  <option value="1">启用</option>
	  <option value="0">停用</option>
	  </select></div>


	</div>



            <div class="form-group">
              <div class="col-sm-12"><input type="submit" value="添加" class="btn btn-primary form-control"/></div>
            </div>
          </form>
        替换字符:<br/>
手机号：[手机号码] 时间戳：[时间]
      </div>
    </div>
  </div>