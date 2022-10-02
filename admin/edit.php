<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
if($_GET['my']=='update') {
$id=intval($_GET['id']);
$row=$DB->get_row("SELECT * FROM user_list WHERE id='{$id}' limit 1");
if($row=='')exit("<script language='javascript'>alert('后台不存在该用户！');history.go(-1);</script>");
if(isset($_POST['submit'])) {
	$qq=daddslashes($_POST['qq']);
	$pass=daddslashes($_POST['pass']);
	$user=daddslashes($_POST['user']);
	$key=daddslashes($_POST['key']);       $money=daddslashes($_POST['money']);       $status=daddslashes($_POST['status']);


		$sql="update `user_list` set `qq` ='{$qq}',`pass` ='{$pass}',`user` ='{$user}' ,`key` ='{$key}' ,`money` ='{$money}' ,`status` ='{$status}'  where `id`='{$id}'";
	if($DB->query($sql)){
		showmsg('修改成功！',1,$_POST['backurl']);
	}
	else showmsg('修改失败！<br/>'.$DB->error(),4,$_POST['backurl']);
}else{
?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">修改</h3></div>
        <div class="panel-body">
          <form action="./edit.php?my=update&id=<?php echo $id; ?>" method="post" class="form-horizontal" role="form">
		  <input type="hidden" name="backurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>"/>
			<div class="form-group">
              <label class="col-sm-2 control-label">ＱＱ</label>
              <div class="col-sm-10"><input type="text" name="qq" value="<?php echo $row['qq']; ?>" class="form-control" required/></div>
            </div><br/>
			<div class="form-group">
              <label class="col-sm-2 control-label">用户名</label>
              <div class="col-sm-10"><input type="text" name="user" value="<?php echo $row['user']; ?>" class="form-control" required/></div>
            </div><br/>

			<div class="form-group">
              <label class="col-sm-2 control-label">用户密码</label>
              <div class="col-sm-10"><input type="text" name="pass" value="<?php echo $row['pass']; ?>" class="form-control"/></div>
            </div><br/>


			<div class="form-group">
              <label class="col-sm-2 control-label">key</label>
              <div class="col-sm-10"><input type="text" name="key" value="<?php echo $row['key']; ?>" class="form-control" required/></div>
            </div><br/>


			<div class="form-group">
              <label class="col-sm-2 control-label">余额</label>
              <div class="col-sm-10"><input type="text" name="money" value="<?php echo $row['money']; ?>" class="form-control" required/></div>
            </div><br/>
<?php 
if($row["status"] == '0')
{

echo '
	<div class="form-group">
	  <label class="col-sm-2 control-label">用户状态</label>
	  <div class="col-sm-10"><select name="status" class="form-control"  default="0">
	  <option value="0">激活</option>
	  <option value="1">封禁</option>
	  </select></div>
	</div><br/>';
}
else
{

echo '
	<div class="form-group">
	  <label class="col-sm-2 control-label">用户状态</label>
	  <div class="col-sm-10"><select name="status" class="form-control"  default="1">
	  <option value="1">封禁</option>
	  <option value="0">激活</option>
	  </select></div>
	</div><br/>';
}

?>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
			  <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">返回用户列表</a></div>
            </div>
          </form>
        </div>
      </div>
<?php
}
}elseif($_GET['my']=='del'){
	$id=intval($_GET['id']);
	$sql="DELETE FROM user_list WHERE id='$id' limit 1";
	if($DB->query($sql)){
		showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);
	}
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);
}?>

    </div>
  </div>