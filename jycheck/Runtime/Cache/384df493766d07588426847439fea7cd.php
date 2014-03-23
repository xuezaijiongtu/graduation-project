<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>API控制系统</TITLE>
<META content=IE=8 http-equiv=X-UA-Compatible>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="__PUBLIC__/css/base.css">
<LINK rel=stylesheet type=text/css href="__PUBLIC__/css/admin_box.css">
</HEAD>
<BODY>
<DIV id=con_one_2 class=form_box>
<form action="__APP__/AdminInfo/InfoAlter" method="post">    
<TABLE width="100%">
  
  <TBODY>
  <TR>
    <TH>用户名：</TH>
    <TD colSpan=3><INPUT class="input w180" style="height: 22px;" name=username value=<?php echo ($infos["name"]); ?>></TR>
    <TH>旧密码：</TH>
    <TD colSpan=3><INPUT id=clickcount type="password" class="input w180" style="height: 22px;" name=oldpwd
   > </TD></TR>
  <TR>
    <TH>新密码：</TH>
    <TD><INPUT class="input w180" style="height: 22px;" name=newpwd type="password"></TD></TR></TBODY></TABLE>
<DIV class=btn><INPUT name=id type=hidden> <INPUT name=do value=yes type=hidden> 
<INPUT class="button" name="dosubmit" value="保存" type="submit"> <INPUT class="button" name="reset" value="重置" type="reset" > 
</DIV></form></DIV></BODY></HTML>