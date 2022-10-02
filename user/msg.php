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
$phone = $_POST["phone"];
if($phone)
{
$url = 'http://'.$localhost.'/api.php?act=msg&syskey='.$conf['syskey'].'&user='.$_SESSION['user'].'&phone='.$phone.'&ip='.real_ip();
$data = json_decode(get_curl($url),true);
if($data['code']=='-1')
{
echo(alert($data['msg']));
}
else
{
echo(alert('短信轰炸执行成功！'));
}
}

 ?>

<main class="lyear-layout-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>在线轰炸</h4>
</div>
<div class="card-body">
                  <form action="./msg.php" method="post" class="form-horizontal" role="form"> 
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong> 轰炸任务可能会长时间运行，若长时间无响应，你可以退出浏览器，因为系统将会在服务器中开启php进程持续运行至接口加载完成 
                </div>
<div class="form-group">
	  <label class="col-sm-2 control-label">价格(次)</label>
	  <div class="col-sm-10"><input type="text" placeholder="<?php echo $conf["jiage"]; ?>" class="form-control" readonly/></div>
	</div><br/>
<div class="form-group">
	  <label class="col-sm-2 control-label">手机号</label>
	  <div class="col-sm-10"><input type="text" name="phone" placeholder="13888888888" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="开始" class="btn btn-primary form-control"/><br/>
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
