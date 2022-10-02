<?php

$title='后台管理';
include './head.php';
include("../includes/common.php"); 
$row=$DB->get_row("SELECT * FROM user_list WHERE user='".$_SESSION['user']."'");
?>
<main class="lyear-layout-content">
<div class="container-fluid"><?php
function alert($tips)
{
return '<script>layer.alert("'.$tips.'");</script>';
}
if(isset($_POST['submit'])) {
	$key=random("18");
	$sql="update`user_list` set `key` ='{$key}' where `user`='{$_SESSION['user']}'";
	if($DB->query($sql))echo(alert('你的新KEY:'.$key));
	else echo(alert($DB->error()));
}
?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>KEY修改</h4>
</div>
<div class="card-body">
  <form action="./keyset.php" method="post" class="form-horizontal" role="form">
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong> KEY修改操作不可逆，请谨慎操作！
                </div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="点击更换" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
        
    
</div></div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>
