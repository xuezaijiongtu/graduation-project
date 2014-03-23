<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD><TITLE>嘉应学院考勤系统</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=stylesheet type=text/css href="__PUBLIC__/css/admin_style.css">
<SCRIPT type=text/javascript src="__PUBLIC__/js/jquery.js"></SCRIPT>
</HEAD>
<BODY style="MARGIN: 0px" scroll=no>
<DIV class=login_title>嘉应学院考勤系统</DIV>
<DIV class=login_main>
<DIV class=login_box>
<DIV style="DISPLAY: none" id=tips class=login_do></DIV>
<DIV 
style="PADDING-BOTTOM: 15px; PADDING-LEFT: 20px; PADDING-RIGHT: 20px; PADDING-TOP: 15px">
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
  <TBODY>
  <TR>
    <TH>用户名：</TH>
    <TD><INPUT id=username class=login_input></TD></TR>
  <TR>
    <TH>密&nbsp;&nbsp;&nbsp;码：</TH>
    <TD><INPUT id=password class=login_input type=password></TD></TR>
  <TR>
    <TH>验证码：</TH>
    <TD>
      <DIV>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
        <TBODY>
        <TR>
          <TD width=120><INPUT id=checkcode class=login_yz></TD>
          <TD><IMG style="CURSOR: pointer" id=verifyImg 
            title=如果您无法识别验证码，请点图片更换 src="__APP__/Login/CheckCode/" width=100 
      height=32></TD></TR></TBODY></TABLE></DIV></TD></TR>
  <TR>
    <TH>&nbsp;</TH>
    <TD><A id=btn_submit class=button 
href="javascript:;">登录</A></TD></TR></TBODY></TABLE></DIV></DIV></DIV>
<DIV class=login_footer>
<P>版权归@学在囧途所有</P></DIV>
<SCRIPT type=text/javascript>
$(function(){
	if(self != top){
		parent.location.href = "__APP__/Login/Login";
	}
	
	//刷新验证码
	$("#verifyImg").click(function(){
		var url = $(this).attr('src');
		url = url + ((/\?/.test(url)) ? '&' : '?' ) + new Date().getTime();
		$(this).attr('src', url)
	});
	
	//登录处理
	function submitLogin(){
		var username = $.trim( $("#username").val() );
		var password = $.trim( $("#password").val() );
		var checkcode = $.trim( $("#checkcode").val() );
		$('#tips').show();
		if( "" == username){
			$('#tips').html('请输入用户名');		
			return false;
		}	
		if( "" == password){
			$('#tips').html('请输入密码');
			return false;
		}
		if( "" == checkcode){
			$('#tips').html('请输入验证码');
			return false;
		}		
		$('#tips').html('正在登录中……');
		
		$.post("__APP__/Login/CheckLogin",
				{'username':username, 'password':password, 'checkcode':checkcode},
				function(json){
					if(json.status ==1){
                        if(typeof(json.backUrl) != "undefined"){
                            window.location.href = json.backUrl;
                        }else{
                            window.location.href = "__APP__/Index/Index";
                        }
					}else{
						$('#tips').html(json.msg);
						$('#tips').show();
					}
				},
				'json'
		);
	}
	
	//点击登录
	$("#btn_submit").click(function(){
		return submitLogin();
	});
	
	//输完验证码或焦点在登录按钮上，按回车登录
	$("#checkcode, #btn_submit").keydown(function(e){
		if(e.keyCode==13){
			return submitLogin();
		}
	});
	
	//输入框聚焦，则隐藏错误tips
	$("#username, #password, #checkcode").focus(function(){
		$('#tips').hide("slow");
	});

});
</SCRIPT>
</BODY></HTML>