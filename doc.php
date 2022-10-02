<?php
include './includes/common.php';
header("Content-type:application/json;charset=utf-8");
?> <?php echo $conf["title"]; ?> API开发文档

发起短信轰炸接口

URL地址： /api.php?act=user
传入参数： key phone
传输方式：GET

Demo:
/api.php?act=user&key=用户密钥&phone=手机号码

其他参数：ip
备注：可传可不传，不传则自动获取

响应内容：
字段           字段值示例        说明
code             1           成功：1 失败-1
msg            执行成功          状态说明

————————————————————————————————————————————

查询轰炸日志接口
URL地址： /api.php?act=log
传入参数：key
传输方式：GET

Demo:
/api.php?act=log&key=用户密钥

其他参数：无
备注：无

响应内容：
字段           字段值示例        说明
code             1           成功：1 失败-1
msg            查询成功        状态说明
data     [{"phone":.....}]    成功则有
