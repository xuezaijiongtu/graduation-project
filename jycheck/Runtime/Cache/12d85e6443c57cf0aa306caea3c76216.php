<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>超级课程表管理系统</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=stylesheet type=text/css href="__PUBLIC__/css/admin_style.css">
<SCRIPT type=text/javascript src="__PUBLIC__/js/jquery.js"></SCRIPT>

<SCRIPT type="text/javascript "src="__PUBLIC__/js/jquery.layout.js"></SCRIPT>

<SCRIPT type=text/javascript>
var myLayout;
$(document).ready(function(){
	myLayout=$("body").layout({west__minSize:40,spacing_open:7,spacing_closed:7,east__initClosed:true,north__spacing_open:0,south__spacing_open:0,togglerLength_open:30,togglerLength_closed:60});
});
</SCRIPT>

<META name=GENERATOR content="MSHTML 9.00.8112.16448"></HEAD>
<BODY style="MARGIN: 0px" scroll=no>
<DIV class=ui-layout-north>
<DIV class=header>
<DIV class=logo>超级课程表管理系统</DIV>
<DIV class=right_menu><SPAN><A class=aa 
href="__APP__/AdminInfo/InfoShow" 
target=main>个人信息</A></SPAN> <SPAN><A class=bb 
href="http://www.myfriday.cn" 
target=_blank>网站主页</A></SPAN> <SPAN><A class=cc 
href="__APP__/Index/CacheClear" 
target=main>更新缓存</A></SPAN> <SPAN><A class=dd 
href="__APP__/Index/LoginOut" 
target=_parent>注销登录</A></SPAN> </DIV></DIV></DIV>
<DIV class=ui-layout-west>
<DIV id=menu>
  <DIV class="menubg_1 cursor">数据管理</DIV>
<UL class=none>
  <LI><A href="__APP__/DataMessage/SchoolInfoShow" 
  target=main>高校数据</A> 
  <LI><A 
  href="__APP__/ProvinceMessage/ProvinceInfoShow" 
  target=main>省份数据</A> </LI>
 <LI><A 
  href="__APP__/DataMessage/UserInfoShow" 
  target=main>用户数据</A></LI></UL>
  <DIV class="menubg_1 cursor">课程管理</DIV>
<UL class=none>
  <LI><A href="__APP__/SetApi/ApiMenuShow" 
  target=main>API菜单</A> 
  <LI><A 
  href="###" 
  target=main>移动端管理</A> </LI>
 <LI><A 
  href="###" 
  target=main>web端管理</A> </LI></UL>
  <DIV class="menubg_1 cursor">学生管理</DIV>
<UL class=none>
  <LI><A href="__APP__/SetApi/ApiMenuShow" 
  target=main>API菜单</A> 
  <LI><A 
  href="###" 
  target=main>移动端管理</A> </LI>
 <LI><A 
  href="###" 
  target=main>web端管理</A> </LI></UL>
  <DIV class="menubg_1 cursor">数据管理</DIV>
<UL class=none>
  <LI><A href="__APP__/SetApi/ApiMenuShow" 
  target=main>学校数据</A> 
  <LI><A 
  href="###" 
  target=main>移动端管理</A> </LI>
 <LI><A 
  href="###" 
  target=main>web端管理</A> </LI>
  <LI><A 
  href="__APP__/LineStat/LineList" 
  target=main>链接管理</A> </LI></UL>
  <DIV class="menubg_1 cursor">权限管理</DIV>
<UL class=none>
  <LI><A href="__APP__/SetApi/ApiMenuShow" 
  target=main>API菜单</A> 
  <LI><A 
  href="###" 
  target=main>移动端管理</A> </LI>
 <LI><A 
  href="###" 
  target=main>web端管理</A> </LI></UL>
  <DIV class="menubg_1 cursor">公告管理</DIV>
<UL class=none>
  <LI><A href="__APP__/Announcement/AnnouncementList" 
  target=main>公告列表</A> 
  <LI></UL>
  <DIV class="menubg_1 cursor">版本控制管理</DIV>
<UL class=none>
  <LI><A href="__APP__/SetApi/ApiMenuShow" 
  target=main>API菜单</A> 
  <LI><A 
  href="###" 
  target=main>移动端管理</A> </LI>
 <LI><A 
  href="###" 
  target=main>web端管理</A> </LI></UL>
  <DIV class="menubg_1 cursor">插件管理</DIV>
<UL class=none>
  <LI><A href="__APP__/SetApi/ApiMenuShow" 
  target=main>API菜单</A> 
  <LI><A 
  href="###" 
  target=main>移动端管理</A> </LI>
 <LI><A 
  href="###" 
  target=main>web端管理</A> </LI></UL>
<DIV class="menubg_1 cursor">系统信息</DIV>
<UL class=none>
  <LI><A href="add.html" 
  target=main>添加页面</A> 
  <LI><A href="list.html" target=main>列表页面</A> 
  <LI><A href="http://localhost/cpapp/index.php?r=demo/index/config" 
  target=main>配置页面</A> </LI></UL></DIV></DIV>
<DIV class=ui-layout-center><IFRAME style="OVERFLOW: visible" id=main 
height="100%" src="__APP__/Index/Welcome" frameBorder=0 width="100%" 
name=main scrolling=yes> </IFRAME></DIV>
<SCRIPT language=javascript> 
$(function(){
	$("#menu").find('DIV').first().attr('class','menubg_2');
	$("#menu").find('UL').first().show();
	$("#menu DIV").click(function(){
		$("#menu DIV").attr('class','menubg_1');
		$("#menu UL").hide();
		$(this).attr('class','menubg_2');
		$(this).next().show();
	});
});
</SCRIPT>
</BODY></HTML>