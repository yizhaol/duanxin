<?php
$title='后台管理';
include './head.php';
include("../includes/common.php"); 
$row=$DB->get_row("SELECT * FROM user_list WHERE user='".$_SESSION['user']."'");
$localhost = $_SERVER['HTTP_HOST'];

function alert($tips)
{
return '<script>layer.alert("'.$tips.'");</script>';
}
$km = $_POST["km"];
if($km)
{
$res=$DB->get_row("SELECT * FROM msg_km WHERE km='".$_POST['km']."'");
if($res)
{
if($res["status"]==0)
{
$money = $res['money'];//卡密值

$deduct="update msg_km set status=1 where km='{$_POST['km']}'";
$DB->query($deduct);

$deduct="update user_list set money = money+{$money}  where user = '{$_SESSION['user']}'";
$DB->query($deduct);
echo alert('卡密充值成功，面额:'.$money."元");
}else
{
echo alert("卡密已被使用");
}
}
else
{
echo alert("卡密不存在");
}
}

 ?>
<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密充值</h4>
</div>
<div class="card-body">
                  <form action="./km.php" method="post" class="form-horizontal" role="form">  <div class="alert alert-info" role="alert"><?php echo $conf["kmtips"]; ?></div> <div class="form-group">
	  <label class="col-sm-2 control-label">输入卡密</label>
	  <div class="col-sm-10"><input type="text" name="km" placeholder="请输入你的卡密" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="确定" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
	</form>
</div>
</div>
</div>
</div>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
</body>
</html>
