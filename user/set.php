<?php

$title='后台管理';
include './head.php';
include("../includes/common.php"); 
$row=$DB->get_row("SELECT * FROM user_list WHERE user='".$_SESSION['user']."'");
?>
<main class="lyear-layout-content">
<div class="container-fluid"><?php
if(isset($_POST['submit'])) {
	$pass=daddslashes($_POST['pass']);
	$qq=daddslashes($_POST['qq']);
	$sql="update`user_list` set `pass` ='{$pass}', `qq` ='{$qq}'  where `user`='{$_SESSION['user']}'";
	if(!empty($pwd))$DB->query("update `user_list` set `key` ='{$key}',  `qq` ='{$qq}' where `user`='{$_SESSION['user']}'");
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{ 
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>个人信息</h4>
</div>
<div class="card-body">
  <form action="./set.php" method="post"  role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">我的账号</label>
	  <div class="col-sm-10"><input type="text" name="" readonly  value="<?php echo $_SESSION['user']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">我的QQ</label>
	  <div class="col-sm-10"><input type="number" name="qq"  value="<?php echo $row['qq'] ?>" class="form-control" required/></div>
	</div><br/>


	<div class="form-group">
	  <label class="col-sm-2 control-label">密码</label>
	  <div class="col-sm-10"><input type="text" name="pass"  value="<?php echo $row['pass'] ?>" class="form-control" required/></div>
</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
        
    
</div></div>
<?php } ?>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>
