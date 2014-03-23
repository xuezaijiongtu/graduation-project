<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>超级课程表管理系统</title>
<meta content="IE=8" http-equiv="X-UA-Compatible" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/style.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
<body>
<div id="contain">
<table width="100%">
  <tr>
    <td valign="top"><table class="list_b" width="100%">
      <tr>
    <th colspan="6">用户数据信息</th>
    </tr>
    <tr>
    <td class="w120">累计注册用户：</td>
  <td><?php echo ($data[0]['data_sumnum']); ?></td>
  <td class="w120">有效用户(有课表):</td>
  <td><?php echo ($data[0]['data_effnum']); ?></td>
    </tr>
    <tr>
    <td>今日活跃用户：</td>
  <td><?php echo ($data[0]['data_usenum']); ?></td>
  <td>当日增长用户数：</td>
  <td><?php echo ($data[0]['data_todayaddnum']); ?></td>
    </tr>
  <tr>
  <td>当前周增长用户数：</td>
  <td><?php echo ($week['weekNum']); ?></td>
  <td>当月增长用户数：</td>
  <td><?php echo ($month['monthNum']); ?></td>
  </tr>
</table>

<table class="list_b mt10" width="100%">
  <tr>
    <th colspan="6">活跃度</th>
    </tr>
    <tr>
    <td>当日活跃度:<span style="margin-left:20px;"><?php echo number_format((($data[0]['data_usenum'] / $data[0]['data_sumnum']) * 100), 4, '.', '')."%";?></span></td><td>当前周活跃度:<span style="margin-left:20px;"><?php echo number_format((($weekActive['weekActive'] / $data[0]['data_sumnum']) * 100), 4, '.', '')."%";?></span></td><td>当前月活跃度:<span style="margin-left:20px;"><?php echo number_format((($monthActive['monthActive'] / $data[0]['data_sumnum']) * 100), 4, '.', '')."%";?></td>
    </tr>
</table>

<table class="list_b mt10" width="100%">
  <tr>
    <th colspan="6">IOS平台</th>
    </tr>
    <tr>
    <td>当日增长:<span style="margin-left:20px;"><?php echo ($data[0]['data_ios']); ?></span></td><td>当前周增长:<span style="margin-left:20px;"><?php echo ($iosWeek['iosWeek']); ?></span></td></td><td>当前月增长:<span style="margin-left:20px;"><?php echo ($iosMonth['iosMonth']); ?></span></td></td>
    </tr>
</table>

<table class="list_b mt10" width="100%">
  <tr>
    <th colspan="6">安卓平台</th>
    </tr>
    <tr>
    <td>当日增长:<span style="margin-left:20px;"><?php echo ($data[0]['data_android']); ?></span></td><td>当前周增长:<span style="margin-left:20px;"><?php echo ($androidWeek['androidWeek']); ?></span></td><td>当前月增长:<span style="margin-left:20px;"><?php echo ($androidMonth['androidMonth']); ?></span></td>
    </tr>
</table>

</td>
    <td valign="top" class="w300 pl10">
    </td>
  </tr>
</table>
</div>
</body>
</html>