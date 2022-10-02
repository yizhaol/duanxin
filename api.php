<?php
set_time_limit(0);
ignore_user_abort(true);
include './includes/common.php';
header('Content-Type:Appliction/json;Charset=utf-8');
$act = $_GET["act"];
$ip = $_GET['ip']?$_GET['ip']:real_ip();
if(!$act){
exit('{"code":-1,"msg":"No Act"}');
}
if($act=='msg')
{
$syskey = $_GET["syskey"];
if(empty($conf["syskey"])){
exit('{"code":-1,"msg":"请先前往后台设置syskey安全密钥"}');
}
if(!$syskey)
{
exit('{"code":-1,"msg":"syskey不能为空"}');
}
if($syskey!==$conf["syskey"]){
exit('{"code":-1,"msg":"syskey错误"}');
}
$user = $_GET["user"];
if(!$user)
{
exit('{"code":-1,"msg":"user用户名不能为空"}');
}
$row=$DB->get_row("SELECT * FROM user_list WHERE user='".$_GET['user']."'");
if(!$row)
{
exit('{"code":-1,"msg":"user用户名不存在"}');
}
if($row['status']=='1')
{
exit('{"code":-1,"msg":"用户已被封禁"}');

}
$phone = $_GET["phone"];
if(preg_match('/([1][3|5|6|7|8][0-9])([0-9]{8,})/',$phone)){
$cs=$DB->get_row("SELECT * FROM  msg_phone WHERE phone='".$_GET["phone"]."'");
if($cs)
{
exit('{"code":-1,"msg":"白名单手机号"}');
}
}
else
{
exit('{"code":-1,"msg":"手机号不合法"}');
}
$jiage = $conf["jiage"];
if($row["money"] < $jiage)
{
exit('{"code":-1,"msg":"余额不足，请充值！"}');
}
$deduct="update user_list set money = money-{$conf['jiage']}  where user = '{$_GET['user']}'";
if($DB->query($deduct))
{
$num = $DB->count("SELECT count(*) from msg_api WHERE status=1");
if($num==0)
{
exit('{"code":-1,"msg":"暂无可用接口"}');
}
$jg = $conf['jiage'];
$da = date('Y-m-d H:i:s');
$phone = $_GET["phone"];
$sql="insert into `msg_log` (`user`,`money`, `date`, `phone`, `ip`) values ('$user','$jg','$da','$phone','$ip')";
$DB->query($sql);

$rs=$DB->query("SELECT * FROM msg_api WHERE status=1");
while($res = $DB->fetch($rs))
{
$url = $res['url'];
if($res['post']=='')//不传输post的
{
$url = preg_replace('/\[手机号码\]/',$_GET["phone"],$url);
$url = preg_replace('/\[时间\]/',time(),$url);
get_curl($url);
}
else
{
$url = preg_replace('/\[手机号码\]/',$_GET["phone"],$url);
$url = preg_replace('/\[时间\]/',time(),$url);
$post = preg_replace('/\[手机号码\]/',$_GET["phone"],$res["post"]);
$post = preg_replace('/\[时间\]/',time(),$post);
get_curl($url,$post);
}
}
exit('{"code":1,"msg":"执行成功"}');
}
else
{
exit('{"code":-1,"msg":"SQL执行错误:余额扣除失败！"}');
}
}
if($act=='api')//获取全部接口
{
$syskey = $_GET["syskey"];
if(!$syskey)
{
exit('{"code":-1,"msg":"syskey不能为空""}');
}
if($syskey!==$conf["syskey"])
{
exit('{"code":-1,"msg":"syskey错误"}');
}

$ok = $DB->count("SELECT count(*) from msg_api WHERE status=1");//启用接口
$err = $DB->count("SELECT count(*) from msg_api WHERE status=0");//停用接口
$all = $DB->count("SELECT count(*) from msg_api WHERE 1");//全部接口
$ok = $ok -1;
if($err==0)
{
$err = '1';
}else
{
$err = $err+1;
}
$rs=$DB->query("SELECT * FROM msg_api WHERE 1");
while($res = $DB->fetch($rs))
{
$data[] = array("url"=>$res["url"],"post"=>$res["post"],"status"=>$res["status"]);
}
exit('{"code":1,"msg":"执行成功","data":'.json_encode($data).'}');
}
if($act=='user')
{
$key = $_GET['key'];
$phone = $_GET['phone'];
if(!$key)
{
exit('{"code":-1,"msg":"key密钥不能为空"}');
} if(!$phone)
{
exit('{"code":-1,"msg":"手机号不能为空"}');
}
$row=$DB->get_row("SELECT * FROM user_list WHERE `key`='".$_GET['key']."'");
if(!$row){
exit('{"code":-1,"msg":"找不到对应用户"}');
}
if($row['status']=='1')
{
exit('{"code":-1,"msg":"用户已被封禁"}');
}
if($conf['jiage']>$row['money'])
{
exit('{"code":-1,"msg":"余额不足，请充值！"}');
}
if(preg_match('/([1][3|5|6|7|8][0-9])([0-9]{8,})/',$phone)){
$url = 'http://'.$_SERVER['HTTP_HOST'].'/api.php?act=msg&syskey='.$conf['syskey'].'&user='.$row['user'].'&phone='.$phone.'&ip='.$ip;
$data = json_decode(get_curl($url),true);
if($data["code"]==1)
{
exit('{"code":1,"msg":"执行成功"}');
}
else
{
exit('{"code":-1,"msg":"'.$data["msg"].'"}');
}
}
else
{
exit('{"code":-1,"msg":"手机号不合法"}');
}
}
if($act=='log'){
$key = $_GET['key'];
if(!$key)
{
exit('{"code":-1,"msg":"key密钥不能为空"}');
}
$row=$DB->get_row("SELECT * FROM user_list WHERE `key`='".$_GET['key']."'");
if(!$row)
{
exit('{"code":-1,"msg":"找不到对应用户"}');
}
if($row['status']=='1')
{
exit('{"code":-1,"msg":"用户已被封禁"}');
}
$user = $row['user'];//得出用户名
$all = $DB->count("SELECT count(*) from msg_log WHERE user='".$user."'");//全部接口
if($all=='0')
{
exit('{"code":1,"msg":"该用户无轰炸日志"}');
}
$rs=$DB->query("SELECT * FROM msg_log WHERE user='".$user."'");
while($res = $DB->fetch($rs))
{
$data[] = array("phone"=>$res["phone"],"money"=>$res["money"],"date"=>$res["date"]);
}
exit('{"code":1,"msg":"查询成功","data":'.json_encode($data).'}');
}
exit('{"code":-1,"msg":"No Act"}');
?>