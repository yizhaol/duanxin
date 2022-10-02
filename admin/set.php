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
	$title=daddslashes($_POST['title']);
	$qq=daddslashes($_POST['qq']);
	$phone=daddslashes($_POST['phone']);
	$syskey=daddslashes($_POST['syskey']);
	$sql="update `msg_config` set `title` ='{$title}',`qq`='{$qq}',`phone` ='{$phone}',`syskey`='{$syskey}' where `id`='{$siteid}'";
	if(!empty($pwd))$DB->query("update `msg_config` set `pwd` ='{$pwd}' where `id`='{$siteid}'");
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">网站信息设置</h3></div>
<div class="panel-body">
  <form action="./set.php" method="post" class="form-horizontal" role="form">

	<div class="form-group">
	  <label class="col-sm-2 control-label">网站名称</label>
	  <div class="col-sm-10"><input type="text" name="title" value="<?php echo $conf['title']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站客服QQ</label>
	  <div class="col-sm-10"><input type="text" name="qq" value="<?php echo $conf['qq']; ?>" class="form-control" required/></div>
	</div><br/>

	<div class="form-group">
	  <label class="col-sm-2 control-label">安全密钥(随便填就行)</label>
	  <div class="col-sm-10"><input type="text" name="syskey" value="<?php echo $conf['syskey']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">测试手机号</label>
	  <div class="col-sm-10"><input type="text" name="phone" value="<?php echo $conf['phone']; ?>" class="form-control" required/></div>
	</div><br/>

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
