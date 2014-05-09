<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>后台管理</TITLE>
<META content=IE=8 http-equiv=X-UA-Compatible>
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=stylesheet type=text/css href="__PUBLIC__/css/base.css"><LINK rel=stylesheet 
type=text/css href="__PUBLIC__/css/admin_box.css">
<LINK rel=stylesheet type=text/css href="__PUBLIC__/css/style.css">
<link href="__PUBLIC__/js/skins/ZCMS/asyncbox.css" type="text/css" rel="stylesheet" />
<SCRIPT type=text/javascript src="__PUBLIC__/js/jquery.js"></SCRIPT>
<style type="text/css">
    .addan{margin:10px 15px;}
    .addan select{width:120px;}
    .addan input{height:25px;}
    .addan table tbody tr td{padding:2px;}
</style>
</HEAD>
<BODY>
<DIV id=contain>
<DIV class=admin_title>
<H2>专业信息列表</H2>
<A 
class=right href="javascript:history.back(-1)">返回上一页</A> </DIV>
<FORM id=search method='post' action="__APP__/Zhuanye/Search">
<DIV id=search_div>&nbsp;&nbsp;专业名<INPUT 
id=s_keyword class="input w150" name=keyword type=text> <INPUT class=button value="搜 索" type=submit> </DIV></FORM>
<FORM method=post action="" target=_self>
<DIV class=list_b>
<TABLE width="100%">
  <TBODY>
  <TR>
    <TH class=w20>专业ID</TH>
    <TH class=w50>专业号</TH>
    <TH class=w50>专业名称</TH>
    <TH class=w50>所在校区</TH>
    <TH class=w80>专业创建年</TH>
    <TH class=w50>所属学院</TH>
    <TH class=w50>类型</TH></TR>
  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><TR>
    <TD><?php echo ($vo["z_id"]); ?></TD>
    <TD><?php echo ($vo["z_teachnum"]); ?></TD>
    <TD><?php echo ($vo["z_zhuanye"]); ?></TD>
    <TD><?php echo ($vo["z_xiaoqu"]); ?></TD>
    <TD><?php echo ($vo["z_year"]); ?></TD>
    <TD><?php echo ($vo["xueyuan"]); ?></TD>
    <TD><?php echo ($vo["z_type"]); ?></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
  <div id="pages"><?php echo ($page); ?></div>
</FORM></DIV>
</BODY></HTML>