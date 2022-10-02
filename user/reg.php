<?php
/**
 * 代理登录
**/
@header('Content-Type: text/html; charset=UTF-8');
include("../includes/common.php");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo $conf["title"] ?> - 用户注册</title>
<link rel="icon" href="../assets/LightYear/favicon.ico" type="image/ico">
<meta name="keywords" content="<?php echo $conf["title"] ?>-全网最好用的短信轰炸框架"/>
<meta name="description" content="<?php echo $conf["title"] ?> - 虚拟主机,服务器都可以安全运行。！"/>
<meta name="author" content="yinqi">
<link href="../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/style.min.css" rel="stylesheet">
<style>
.lyear-wrapper {
    position: relative;
}
.lyear-login {
    display: flex !important;
    min-height: 100vh;
    align-items: center !important;
    justify-content: center !important;
}
.login-center {
    background: #fff;
    min-width: 38.25rem;
    padding: 2.14286em 3.57143em;
    border-radius: 5px;
    margin: 2.85714em 0;
}
.login-header {
    margin-bottom: 1.5rem !important;
}
.login-center .has-feedback.feedback-left .form-control {
    padding-left: 38px;
    padding-right: 12px;
}
.login-center .has-feedback.feedback-left .form-control-feedback {
    left: 0;
    right: auto;
    width: 38px;
    height: 38px;
    line-height: 38px;
    z-index: 4;
    color: #dcdcdc;
}
.login-center .has-feedback.feedback-left.row .form-control-feedback {
    left: 15px;
}
</style>
</head>
  
<body>
<div class="row lyear-wrapper">
  <div class="lyear-login">
    <div class="login-center">
      <div class="login-header text-center">
      <h1>用户注册</h3>
      </div>
       <form action="./reg.php" method="POST" role="form" class="form-horizontal">
        <div class="form-group has-feedback feedback-left">
          <input type="text" name="user" value="<?php echo @$_POST['user']?>" placeholder="请输入用户账号" class="form-control" required/>
          <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left">
          <input type="password" name="pass" placeholder="请输入用户密码" class="form-control" required/>
          <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left">
          <input type="number" name="qq" placeholder="请输入用户 Q Q" class="form-control" required/>
          <span class="mdi mdi-qqchat form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left"> <img src="./code.php?r=<?php echo time();?>"height="32"onclick="this.src='./code.php?r='+Math.random();" title="点击更换验证码">
          <input type="text" name="code" placeholder="请输入验证码" class="form-control" required/>
          <span class="mdi mdi-qqchat form-control-feedback" aria-hidden="true"></span>
        </div><br/><br/>
        <div class="form-group has-feedback feedback-left row">
          <button class="btn btn-block btn-primary"  type="submit" name="submit">立即注册</button>
        </div>
      </form>
                <p style="text-align: right;">
                    <a href="/user/login.php">
                        已有账号？
                    </a>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href=""><?php echo $conf["title"] ?></a></p>
      </footer>

<?php
$user = $_POST['user'];
$pass = $_POST['pass']; 
$qq = $_POST['qq'];

if(!$user || !$pass || !$qq)
{}
else
{
if(isset($_POST['qq']) && isset($_POST['user']) && isset($_POST['pass'])){
$qq=daddslashes($_POST['qq']);
$user=daddslashes($_POST['user']);
$pass=daddslashes($_POST['pass']);
$code=daddslashes($_POST['code']);
if(!$code || strtolower($_SESSION['mulin_code'])!=strtolower($code)){exit("<script language='javascript'>alert('验证码错误');window.location.href='./reg.php';</script>");

}
if(number($conf["zsye"]))
{
$money = $conf["zsye"];
}
else
{
$money = '0';
}
//$key = random("18");
$row=$DB->get_row("SELECT * FROM user_list WHERE user='{$user}' limit 1");
if($row!='')exit("<script language='javascript'>alert('该账号已经注册！');window.location.href='./reg.php';</script>");
$key = random("18");
	$sql="insert into `user_list` (`qq`,`user`,`pass`,`money`,`key`,`status`) values ('$qq','$user','$pass','$money','$key','0')";
	$DB->query($sql);
echo "<script language='javascript'>alert('恭喜你,注册成功！');window.location.href='./';</script>";
}
}


?>
    </div>
  </div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
</body>
</html>