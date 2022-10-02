<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

set_time_limit(0);
//即使浏览器关闭还继续运营
ignore_user_abort(true);
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php 
if(empty($conf["phone"])){
exit(showmsg('请先配置测试手机号<br/><br/><a href="./set.php">>>前往设置</a>', 4));
}
$cs=$DB->get_row("SELECT * FROM  msg_phone WHERE phone='".$conf["phone"]."'");
if($cs)
{
exit(showmsg('白名单手机号<br/><br/><a href="./list.php">>>返回接口列表</a>', 4));
} 
$count = $DB->count("SELECT count(*) from msg_api WHERE status=1");
if($count==0)
{

exit(showmsg('暂无可用接口<br/><br/><a href="./list.php">>>返回接口列表</a>', 4));
}
?>
 <?php
echo '成功请求接口：<b>'.$DB->count("SELECT count(*) from msg_api WHERE status=1").'</b>条';
$rs=$DB->query("SELECT * FROM msg_api WHERE status=1");
while($res = $DB->fetch($rs))
{
$url = $res['url'];
if($res['post']=='')//不传输post的
{

$url = preg_replace('/\[手机号码\]/',$conf["phone"],$url);
$url = preg_replace('/\[时间\]/',time(),$url);
echo htmlspecialchars(get_curl($url)).'<hr/>';

}
else
{
$url = preg_replace('/\[手机号码\]/',$conf["phone"],$url);
$url = preg_replace('/\[时间\]/',time(),$url);
$post = preg_replace('/\[手机号码\]/',$conf["phone"],$res["post"]);
$post = preg_replace('/\[时间\]/',time(),$post);
echo htmlspecialchars(get_curl($url,$post))."<hr/>";
}
}
?>