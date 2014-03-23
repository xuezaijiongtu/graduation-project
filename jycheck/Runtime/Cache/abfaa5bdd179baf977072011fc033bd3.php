<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>后台管理</TITLE>
<META content=IE=8 http-equiv=X-UA-Compatible>
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=stylesheet type=text/css href="__PUBLIC__/css/base.css"><LINK rel=stylesheet 
type=text/css href="__PUBLIC__/css/admin_box.css">
<LINK rel=stylesheet type=text/css href="__PUBLIC__/css/style.css">
<link href="__PUBLIC__/js/skins/ZCMS/asyncbox.css" type="text/css" rel="stylesheet" />
<SCRIPT type=text/javascript src="__PUBLIC__/js/jquery.js"></SCRIPT>
<script type="text/javascript" src="__PUBLIC__/js/AsyncBox.v1.4.5.js"></script>
<SCRIPT type=text/javascript>
  $(function(){
    $('.edit').click(function(){
        var tech_id = $(this).attr('id');
        $.ajax({
          url: "__APP__/Teacher/getTeachInfo",
          type: "POST",
          data: {tech_id:tech_id},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            asyncbox.open({
                html:'<form action="__APP__/Teacher/edit" method="post" class="addan" name="addan"><table><tr><td>姓名：</td><td><input name="tech_name" type="text" style="width:108px;height:18px;" value="'+data[0].tech_name+'"></td></tr><tr><td>状态：</td><td><select name="tech_status" class="version"><option value="1">正常</option><option value="0">暂停使用</option></select></td></tr><tr><td></td><td><input type="submit" value="修 改" style="margin-left:20px;width:80px;"><input type="hidden" name="tech_id" value="'+data[0].tech_id+'"></tr></table></form>',
                title:'课程信息修改',
                });
            }
        });
      
    });

    //添加教师用户
    $('#addTeacher').click(function(){
        asyncbox.open({
            html:'<form action="__APP__/Teacher/addTeacher" method="post" class="addan" name="addan"><table><tr><td>姓名：</td><td><input name="tech_name" type="text"></td></tr><tr><td>密码：</td><td><input name="password" type="password"></td></tr><tr><td></td><td><input type="submit" value="添加" style="margin-left:26px;"><input type="reset" value="重置" style="margin-left:10px;"></td></tr></table></form>',
            title:'教师用户添加'
            });
      
    });
  });
</SCRIPT>
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
<H2>课程信息</H2>
<A 
class=right href="javascript:history.back(-1)">返回上一页</A> </DIV>
<DIV class=admin_menu><A 
href="###" id="addTeacher">添加课程</A></DIV>
<FORM id=search method='post' action="__APP__/Teacher/Search">
<DIV id=search_div>&nbsp;&nbsp;课程名称<INPUT 
id=s_keyword class="input w150" name=keyword type=text> <INPUT class=button value="搜 索" type=submit> </DIV></FORM>
<FORM method=post action="" target=_self>
<DIV class=list_b>
<TABLE width="100%">
  <TBODY>
  <TR>
    <TH class=w50>课程ID</TH>
    <TH class=w50>课程名称</TH>
    <TH class=w50>科任老师</TH>
    <TH class=w50>课程学分</TH>
    <TH class=w50>上课地点</TH>
    <TH class=w50>所属学院</TH>
    <TH class=w80>管理操作</TH></TR>
  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><TR>
    <TD><?php echo ($vo["lesson_id"]); ?></TD>
    <TD><?php echo ($vo["lesson_name"]); ?></TD>
    <TD><?php echo ($vo["lesson_teacher"]); ?></TD>
    <TD><?php echo ($vo["lesson_xuefen"]); ?>分</TD>
    <TD><?php echo ($vo["lesson_address"]); ?></TD>
    <TD><?php echo ($vo["xy_name"]); ?></TD>
    <TD><A href="###" target=_self class="edit" id="<?php echo ($vo["tech_id"]); ?>">修改</A> | <A onClick="return confirm('确定要删除吗？')" href="__APP__/Teacher/delete?uid=<?php echo ($vo["tech_id"]); ?>" target=_self>删除</A></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
  <div id="pages"><?php echo ($page); ?></div>
</FORM></DIV>
</BODY></HTML>