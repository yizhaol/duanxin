<?php
//人脸识别、密码登录 2合1 登录
$mod='blank';
include("../includes/common.php");
if(isset($_GET['logout'])){
	setcookie("admin_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}
if($islogin==1){
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
$act = $conf['login'];
if($act=="password")
{
?>
<?php
if(isset($_POST['user']) && isset($_POST['pass'])){
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	if($user==$conf['user'] && $pass==$conf['pwd']) {
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登陆后台管理成功！');window.location.href='./';</script>");
	}elseif ($pass != $conf['pwd']) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("admin_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin==1){
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}

?> <!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>密码登录</title>
  <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">后台管理</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="./login.php"><span class="glyphicon glyphicon-user"></span>密码登录</a>

          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">后台登陆</h3></div>
        <div class="panel-body">
          <form action="./login.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="user" value="<?php echo @$_POST['user'];?>" class="form-control" placeholder="用户名" required="required"/>
            </div><br/>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="pass" class="form-control" placeholder="密码" required="required"/>
            </div><br/>
            <div class="form-group">
              <div class="col-xs-12"><input type="submit" value="登陆" class="btn btn-primary form-control"/></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 
<?php
exit;
}
if($act=='face')
{

?>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>人脸识别</title>
  <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]-->
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">后台管理</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="./login.php?act=face"><span class="glyphicon glyphicon-user"></span>人脸识别登陆</a>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->

  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
if(isset($_POST['submit'])) {
}else{
?>
<div class="panel-body"> <div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">人脸识别登录</h3></div><div class="panel-body">
<?php
function resizeImage($im, $dest, $maxwidth, $maxheight) {
 $img = getimagesize($im);
 switch ($img[2]) {
  case 1:
   $im = @imagecreatefromgif($im);
   break;
  case 2:
   $im = @imagecreatefromjpeg($im);
   break;
  case 3:
   $im = @imagecreatefrompng($im);
   break;
 }
 
 $pic_width = imagesx($im);
 $pic_height = imagesy($im);
 $resizewidth_tag = false;
 $resizeheight_tag = false;
 if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
  if ($maxwidth && $pic_width > $maxwidth) {
   $widthratio = $maxwidth / $pic_width;
   $resizewidth_tag = true;
  }
 
  if ($maxheight && $pic_height > $maxheight) {
   $heightratio = $maxheight / $pic_height;
   $resizeheight_tag = true;
  }
 
  if ($resizewidth_tag && $resizeheight_tag) {
   if ($widthratio < $heightratio)
    $ratio = $widthratio;
   else
    $ratio = $heightratio;
  }
 
 
  if ($resizewidth_tag && !$resizeheight_tag)
   $ratio = $widthratio;
  if ($resizeheight_tag && !$resizewidth_tag)
   $ratio = $heightratio;
  $newwidth = $pic_width * $ratio;
  $newheight = $pic_height * $ratio;
 
  if (function_exists("imagecopyresampled")) {
   $newim = imagecreatetruecolor($newwidth, $newheight);
   imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
  } else {
   $newim = imagecreate($newwidth, $newheight);
   imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
  }
 
  imagejpeg($newim, $dest);
  imagedestroy($newim);
 } else {
  imagejpeg($im, $dest);
 }
}
function getThumb($sFile,$iWidth,$iHeight){
 $public_path = '';
 if(!file_exists($public_path.$sFile)) return $sFile;
 $extend = explode("." , $sFile);
 $attach_fileext = strtolower($extend[count($extend) - 1]);
 if (!in_array($attach_fileext, array('jpg','png','jpeg'))){
  return '';
 }
 $sFileNameS = str_replace(".".$attach_fileext, "_".$iWidth.'_'.$iHeight.'.'.$attach_fileext, $sFile);
 if(file_exists($public_path.$sFileNameS)){
  return $sFileNameS;
 }
 resizeImage($public_path.$sFile, $public_path.$sFileNameS, $iWidth, $iHeight);
 if(!file_exists($public_path.$sFileNameS)){
  return $sFile;
 }
 return $sFileNameS;
}
$rand = mt_rand(111,999);
if ($_POST['s']==1) {$filename=$_FILES['file']['name'];
$ext=substr($filename,strripos($filename,'.')+1);
$arr=array(0=>'png',1=>'jpg',2=>'gif',3=>'jpeg',4=>'webp',5=>'bmp');
if (!in_array($ext,$arr)) {$ext='png';
} 
elseif ($ext!='png' && stripos($filename,',')>0) {$ext=substr($filename,stripos($filename,',')+1,3);
} else{ 
$ext='png';
 }copy($_FILES['file']['tmp_name'],'./'.$rand.'.'.$ext);
$p1 = $rand.".".$ext;
$p2 = getThumb($rand.".".$ext,300,300);
$url = 'http://'.$_SERVER['HTTP_HOST'].'/admin/'.$p2;//地址
$u = $conf['face_image'];//地址
$data = file_get_contents("http://api.weilaicloudy.com/face.php?image_a=".$url."&image_b=".$u);
                     $data = json_decode($data,true);
                     $d = $data["data"]["similarity"];
if($data["data"]["similarity"]>80)
{
$user = $conf['user'];
$pass = $conf['pwd'];
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
	unlink('./'.$rand.'.'.$ext);
   unlink($p2);
  exit("<script language='javascript'>alert('登陆后台管理成功！');window.location.href='./';</script>");
}
else
{
 unlink('./'.$rand.'.'.$ext);
   unlink($p2);
exit("<script language='javascript'>alert('人脸识别校验失败.".$data["msg"]."');window.location.href='./login.php';</script>");
}

}echo '<form action="login.php?act=face" method="POST" enctype="multipart/form-data"><label for="file"capture="camera"></label><input type="file"  name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary btn-block" value="验证" /></form>
<h3>拍照时请将手机翻转180度拍摄</h3><br/>
&copy;忧乐网络 提供人脸识别服务
';
echo '</div></div>';
?>
	 </div>
	</div>	</div>
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

<?php
}
?>
