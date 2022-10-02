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
$jiage=daddslashes($_POST['jiage']);
$zsye=daddslashes($_POST['zsye']);
$kmtips=daddslashes($_POST['kmtips']);
	$sql="update `msg_config` set `jiage`='{$jiage}',`zsye` ='{$zsye}',`kmtips`='{$kmtips}' where `id`='{$siteid}'";
	if(!empty($pwd))$DB->query("update `msg_config` set `pwd` ='{$pwd}' where `id`='{$siteid}'");
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">消费设置</h3></div>
<div class="panel-body">
  <form action="./money.php" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">价格(元)</label>
	  <div class="col-sm-10"><input type="text" name="jiage" value="<?php echo $conf['jiage']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">注册赠送(元)</label>
	  <div class="col-sm-10"><input type="text" name="zsye" value="<?php echo $conf['zsye']; ?>" class="form-control" required/></div>
	</div><br/>

			<div class="form-group">
	  <label class="col-sm-2 control-label">卡密充值提示框</label>
	  <div class="col-sm-10"><textarea class="form-control" name="kmtips" rows="6"><?php echo $conf['kmtips']; ?></textarea></div>
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
