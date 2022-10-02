<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
function alert($tips)
{
return '<script>window.alert("'.$tips.'");window.location.href="./list.php";</script>';
}
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
if($_GET['my']=='rm')
{
$rs=$DB->query("SELECT * FROM msg_api WHERE 1");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql="DELETE FROM msg_api WHERE id='$id' limit 1";
$DB->query($sql);
}
exit(alert("清空完成"));
}

if($_GET['my']=='s')
{
$rs=$DB->query("SELECT * FROM msg_api WHERE status=0");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql="DELETE FROM msg_api WHERE id='$id' limit 1";
$DB->query($sql);
}
exit(alert("清空所有停用接口完成"));
}
if($_GET['my']=='o')
{
$rs=$DB->query("SELECT * FROM msg_api WHERE status=0");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql= "update `msg_api` set `status` ='1' where `id`='{$id}'";
$DB->query($sql);
}
exit(alert("所有接口已启用"));
}
if($_GET['my']=='f')
{
$rs=$DB->query("SELECT * FROM msg_api WHERE status=1");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql= "update `msg_api` set `status` ='0' where `id`='{$id}'";
$DB->query($sql);
}
exit(alert("所有接口已停用"));
}

if($_GET['my']=='del'){
	$id=intval($_GET['id']);
	$sql="DELETE FROM msg_api WHERE id='$id' limit 1";
	if($DB->query($sql)){
		showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);exit;
	}
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);exit;
}
if($_GET['my']=='upo'){
	$id=intval($_GET['id']);
	$sql="update `msg_api` set `status` ='1' where `id`='{$id}'";
	if($DB->query($sql)){
		exit(alert("启用成功"));
	}
	else exit(alert("启用失败"));
}

if($_GET['my']=='upn'){
	$id=intval($_GET['id']);
	$sql="update `msg_api` set `status` ='0' where `id`='{$id}'";
	if($DB->query($sql)){
		exit(alert("停用成功"));
	}
	else exit(alert("停用失败"));
}


	$gls=$DB->count("SELECT count(*) from msg_api WHERE 1");
	$sql=" 1";

$pagesize=30;
if (!isset($_GET['page'])) {
	$page = 1;
	$pageu = $page - 1;
} else {
	$page = $_GET['page'];
	$pageu = ($page - 1) * $pagesize;
}
$ok=$DB->count("SELECT count(*) from msg_api WHERE status=1");
$no=$DB->count("SELECT count(*) from msg_api WHERE status=0");
echo '当前系统共有：<b>'.$gls.'</b>条接口，其中<b>'.$ok.'</b>条接口启用，<b>'.$no.'</b>条接口停用<br/><br/>功能选项：[<a href="./get.php"onclick="return confirm(\'轰炸任务可能会长时间运行，若长时间无响应，你可以退出浏览器，因为系统将会在服务器中开启php进程持续运行至接口加载完成\');">测试轰炸</a>][<a href="./kelong.php">克隆接口</a>][<a href="./list.php?my=rm"onclick="return confirm(\'你真的要清空所有接口吗\');">清空接口</a>] [<a href="./list.php?my=s"onclick="return confirm(\'你真的要清空所有停用接口吗\');">清空停用接口</a>] [<a href="./list.php?my=o"onclick="return confirm(\'你真的要启用所有接口吗\');">启用所有接口</a>] [<a href="./list.php?my=f"onclick="return confirm(\'你真的要停用所有接口吗\');">停用所有接口</a>]';
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>地址</th><th>POST</th> <th>状态</th> <th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM msg_api WHERE{$sql} order by id desc limit $pageu,$pagesize");
while($res = $DB->fetch($rs))
{
if($res["status"]==1)
{
$status = "<font color='success'>启用</font>";
$t = '停用';
$s = 'n';
$c = 'warning';
}
else
{
$status = "<font color='red'>停用</font>";
$t = '启用';
$s = 'o';
$c = 'success';
}
if($res['post']==''){

$post = '<a href="javascript:;" onclick="return alert(\'不传输POST\');">查看POST</a>';
}
else
{
$post = '<a href="javascript:;" onclick="return alert(\''.$res["post"].'\');">查看POST</a>';
}
$url = '<a href="javascript:;" class="btn btn-xs btn-danger" onclick="return alert(\''.$res["url"].'\');">查看</a>';

echo '<tr><td>'.$res['id'].'</td><td>'.$url.'</td><td>'.$post.'</td> <td>'.$status.'</td> <td> <a href="./demo.php?id='.$res['id'].'" class="btn btn-xs btn-info">调式接口</a>  <a href="./list.php?my=up'.$s.'&id='.$res['id'].'" class="btn btn-xs btn-'.$c.'"\');">'.$t.'</a> <a href="./list.php?my=del&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个接口吗？\');">删除</a></td></tr>';
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
echo '<li><a href="list.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="list.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="list.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="list.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>