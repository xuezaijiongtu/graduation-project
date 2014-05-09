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
        var lessonid = $(this).attr('id');
        $.ajax({
          url: "__APP__/Lesson/getLessonInfo",
          type: "POST",
          data: {lessonid:lessonid},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            asyncbox.open({
                html:'<form action="__APP__/Lesson/editLesson" method="post" class="addan" name="addan"><table><tr><td>课程名称：</td><td><input name="lesson_name" type="text" style="width:108px;height:18px;" value="'+data[0].lesson_name+'"></td></tr><tr><td>课程老师：</td><td><input name="lesson_teacher" type="text" style="width:108px;height:18px;" value="'+data[0].lesson_teacher+'"></td></tr><tr><td>课程学分：</td><td><input name="lesson_xuefen" type="text" style="width:108px;height:18px;" value="'+data[0].lesson_xuefen+'"></td></tr><tr><td>课程地点：</td><td><input name="lesson_address" type="text" style="width:108px;height:18px;" value="'+data[0].lesson_address+'"></td></tr><tr><td>所属院校：</td><td><input name="xy_name" type="text" style="width:108px;height:18px;" value="'+data[0].xy_name+'"></td></tr><tr><td></td><td><input type="submit" name="submit" value="修 改" style="margin-left:20px;width:80px;"><input type="hidden" name="lesson_id" value="'+data[0].lesson_id+'"></tr></table></form>',
                title:'课程信息修改',
                });
            }
        });
      
    });

    //添加课程
    $('#addTeacher').click(function(){
        asyncbox.open({
            html:'<form action="__APP__/Lesson/addLesson" method="post" class="addan" name="addan"><table><tr><td>学院：</td><td><SELECT id=s_cid class=searchauto name=xueyuan style="width:138px;height:36px;"><OPTION selected value="">选择学院(可选)</OPTION><?php if(is_array($xueyuan)): foreach($xueyuan as $key=>$vo): ?><OPTION value="<?php echo ($vo["xy_name"]); ?>"><?php echo ($vo["xy_name"]); ?></OPTION><?php endforeach; endif; ?></SELECT></td></tr><tr><td>课程名称：</td><td><input name="lesson_name" type="text"></td></tr><tr><td>任课老师：</td><td><input name="teacher_name" type="text"></td></tr><tr><td>学分：</td><td><input name="xuefen" type="text"></td></tr><tr><td>上课地址：</td><td><input name="lesson_address" type="text"></td></tr><tr><td></td><td><input type="submit" name="submit" value="添加" style="margin-left:26px;"><input type="reset" value="重置" style="margin-left:10px;"></td></tr></table></form>',
            title:'课程信息添加'
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
<FORM id=search method='post' action="__APP__/Lesson/searchLesson">
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
    <TD><A href="###" target=_self class="edit" id="<?php echo ($vo["lesson_id"]); ?>">修改</A> | <A onClick="return confirm('确定要删除吗？')" href="__APP__/Lesson/deleteLesson?lesson_id=<?php echo ($vo["lesson_id"]); ?>" target=_self>删除</A></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
  <div id="pages"><?php echo ($page); ?></div>
</FORM></DIV>
</BODY></HTML>