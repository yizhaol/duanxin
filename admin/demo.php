<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">接口测试</h3></div>
        <div class="panel-body">
<?php 
$id = $_GET['id'];
if(!$id)
{
exit(showmsg('接口ID不能为空<br/><br/><a href="./list.php">>>返回接口列表</a>', 4));
}
$row=$DB->get_row("SELECT * FROM  msg_api WHERE id='".$id."'");
if(!$row)
{
exit(showmsg('接口不存在br/><br/><a href="./list.php">>>返回接口列表</a>', 4));
}
if($row["status"]==0)
{
exit(showmsg('接口已停用<br/><br/><a href="./list.php">>>返回接口列表</a>', 4));
}
$cs=$DB->get_row("SELECT * FROM  msg_phone WHERE phone='".$conf["phone"]."'");
if($cs)
{
exit(showmsg('白名单手机号<br/><br/><a href="./list.php">>>返回接口列表</a>', 4));
}

if($row["post"]=='')
{
$url = preg_replace('/\[手机号码\]/',$conf["phone"],$row["url"]);
$url = preg_replace('/\[时间\]/',time(),$url);
echo '接口调试成功！<hr>
请求地址：'.substr($url,0,30).'...<hr/>
响应内容：<br/><br/>';
echo htmlspecialchars(get_curl($url));
}
else
{
$url = preg_replace('/\[手机号码\]/',$conf["phone"],$row["url"]);
$url = preg_replace('/\[时间\]/',time(),$url);

$post = preg_replace('/\[手机号码\]/',$conf["phone"],$row["post"]);
$post = preg_replace('/\[时间\]/',time(),$post);
echo '接口调试成功！<hr>
请求地址：'.substr($url,0,30).'...<br/>
POST数据：'.$post.'<hr/>
响应内容：<br/><br/>';
echo htmlspecialchars(get_curl($url,$post));
}
?>

      </div>
    </div>
  </div>