<?php
$mod='blank';
include("../includes/common.php");
$title='忧乐短信轰炸系统后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php

if(isset($_POST['qq']) && isset($_POST['user']) && isset($_POST['pass'])){
$qq=daddslashes($_POST['qq']);
$user=daddslashes($_POST['user']);
$pass=daddslashes($_POST['pass']);
if(number($conf["zsye"]))
{
$money = $conf["zsye"];
}
else
{
$money = '0';
}
$key = random("18");
$row=$DB->get_row("SELECT * FROM user_list WHERE user='{$user}' limit 1");
if($row!='')exit("<script language='javascript'>alert('用户名重复');window.location.href='user.php';</script>");
	$sql="insert into `user_list` (`qq`,`user`,`pass`,`money`,`key`,`status`) values ('$qq','$user','$pass','$money','$key','0')";
	$DB->query($sql);
exit("<script language='javascript'>alert('添加成功');window.location.href='userlist.php';</script>");
} ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">添加用户</h3></div>
        <div class="panel-body">
          <form action="./user.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon">账号</span>
              <input type="text" name="user" value="<?=@$_POST['user']?>" class="form-control" placeholder="admin" autocomplete="off" required/>
            </div><br/>
            <div class="input-group">
              <span class="input-group-addon">密码</span>
              <input type="text" name="pass" value="<?=@$_POST['pass']?>" class="form-control" placeholder="123456" autocomplete="off" required/>
            </div><br/>
            <div class="input-group">
              <span class="input-group-addon">qq</span>
              <input type="text" name="qq" value="<?=@$_POST['qq']?>" class="form-control" placeholder="2772694408" autocomplete="off" required/>
            

            </div><br/>
            <div class="form-group">
              <div class="col-sm-12"><input type="submit" value="添加" class="btn btn-primary form-control"/></div>
            </div>
          </form>
      </div>
    </div>
  </div>