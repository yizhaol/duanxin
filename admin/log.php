<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
function alert($tips)
{
return '<script>window.alert("'.$tips.'");window.location.href="./log.php";</script>';
}
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php 
if($_GET['my']=='c'){
	$id=intval($_GET['id']);
$row=$DB->get_row("SELECT * FROM msg_log WHERE id='".$id."'");
$user = $row['user'];//查询到用户名

$row=$DB->get_row("SELECT * FROM user_list WHERE user='".$row['user']."'");
$id = $row['id'];//查询到id
exit('<script>window.alert("用户名'.$user.',ID:'.$id.'");window.location.href="./edit.php?my=update&id='.$id.'";</script>');
}
if($_GET['my']=='rm')
{
$rs=$DB->query("SELECT * FROM msg_log WHERE 1");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql="DELETE FROM msg_log WHERE id='$id' limit 1";
$DB->query($sql);
}
exit(alert("清空完成"));
}

if($_GET['my']=='del'){
	$id=intval($_GET['id']);
	$sql="DELETE FROM msg_log WHERE id='$id' limit 1";
	if($DB->query($sql)){
		showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);exit;
	}
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);exit;
}
	$gls=$DB->count("SELECT count(*) from msg_log WHERE 1");
	$sql=" 1";
	


$pagesize=30;
if (!isset($_GET['page'])) {
	$page = 1;
	$pageu = $page - 1;
} else {
	$page = $_GET['page'];
	$pageu = ($page - 1) * $pagesize;
}

echo '当前系统共执行：<b>'.$gls.'</b>次轰炸任务<br/><br/>功能选项：[<a href="./log.php?my=rm"onclick="return confirm(\'你真的要清空所有日志吗\');">清空日志</a>]';
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>手机号</th><th>消费金额</th> <th>操作IP</th> <th>日期</th><th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM msg_log WHERE{$sql} order by id desc limit $pageu,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$res['id'].'</td><td>'.$res['phone'].'</td><td>'.$res['money'].'</td> <td>'.$res['ip'].'</td><td>'.$res['date'].'</td> <td> <a href="./log.php?my=c&id='.$res['id'].'" class="btn btn-xs btn-info">查询用户</a> <a href="./log.php?my=del&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个日志吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$s = ceil($gls / $pagesize);
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$s;
if ($page>1)
{
echo '<li><a href="log.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="log.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="log.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="log.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="log.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="log.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>