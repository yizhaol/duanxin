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
if(isset($_POST['submit'])) {
$login=daddslashes($_POST['login']);
	$user=daddslashes($_POST['user'])?daddslashes($_POST['user']):$conf["user"];
	$pwd=daddslashes($_POST['pwd'])?daddslashes($_POST['pwd']):$conf["pwd"];	$face_image=daddslashes($_POST['face_image'])?daddslashes($_POST['face_image']):$conf["face_image"];
	$sql="update `msg_config` set `user` ='{$user}',`login` ='{$login}',`face_image` ='{$face_image}' where `id`='{$siteid}'";
	if(!empty($pwd))$DB->query("update `msg_config` set `pwd` ='{$pwd}' where `id`='{$siteid}'");
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">账户设置</h3></div>
<div class="panel-body">
  <form action="./account.php" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">登录方式</label>
	  <div class="col-sm-10"><select name="login" class="form-control" default="<?php echo $conf['login']; ?>">
	  <option value="password">密码登录</option>
	  <option value="face">人脸识别</option>
	  </select></div>
	</div>
            </div>
<?php 
if($conf["login"]!=="face")
{
?>
	<div class="form-group">
	  <label class="col-sm-2 control-label">用户名</label>
	  <div class="col-sm-10"><input type="text" name="user" value="<?php echo $conf['user']; ?>" class="form-control" required/></div>
	</div><br/>
  <form action="./money.php" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">后台密码设置</label>
	  <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/></div>
	  <br/>
	</div><br/>
<?php }
else{
?>
	<div class="form-group">
	  <label class="col-sm-2 control-label">人脸地址</label>
	  <div class="col-sm-10"><input type="text" name="face_image" value="<?php echo $conf['face_image']; ?>" class="form-control" required/></div>
	</div><br/>
<?php } ?>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>
<?php
}?>

    </div>
  </div>
