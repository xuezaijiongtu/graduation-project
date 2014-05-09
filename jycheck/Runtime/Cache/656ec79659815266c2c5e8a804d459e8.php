<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>后台管理</TITLE>
<META content=IE=8 http-equiv=X-UA-Compatible>
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=stylesheet type=text/css href="__PUBLIC__/css/base.css"><LINK rel=stylesheet 
type=text/css href="__PUBLIC__/css/admin_box.css">
<LINK rel=stylesheet type=text/css href="__PUBLIC__/css/style.css">
<link href="__PUBLIC__/js/skins/ZCMS/asyncbox.css" type="text/css" rel="stylesheet" />
<script src="__PUBLIC__/js/highcharts-all.js"></script>
<script src="__PUBLIC__/js/exporting.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/AsyncBox.v1.4.5.js"></script>
<SCRIPT type=text/javascript>
$(function(){
    $('.showuncome').click(function(){
        var uncomeuid = $(this).attr('id');
        var infoShow  = $(this).attr('name');
        $.ajax({
          url: "__APP__/UnComeStudent/getUnComeStudentLessonInfo",
          type: "POST",
          data: {uncomeuid:uncomeuid},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            asyncbox.open({
                html:'<div style="width:600px;height:300px;font-size:16px;">'+data+'</div>',
                title:infoShow,
                });
            }
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
<H2>缺勤学生列表</H2></DIV>
<FORM method=post action="" target=_self>
<DIV class=list_b>
<TABLE width="100%">
  <TBODY>
  <TR>
    <TH class=w30>学号</TH>
    <TH class=w80>姓名</TH>
    <TH class=w40>性别</TH>
    <TH class=w50>学院</TH>
    <TH class=w40>专业</TH>
    <TH class=w40>班别</TH>
    <TH class=w40>年级</TH>
    <TH class=w40>类型</TH>
    <TH class=w40>逃课次数</TH>
    <TH class=w40>操作</TH></TR>
  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><TR>
    <TD><?php echo ($vo["uid"]); ?></TD>
    <TD><?php echo ($vo["name"]); ?></TD>
    <TD><?php echo ($vo["sex"]); ?></TD>
    <TD><?php echo ($vo["xueyuan"]); ?></TD>
    <TD><?php echo ($vo["zhuanye"]); ?></TD>
    <TD><?php echo ($vo["class"]); ?></TD>
    <TD><?php echo ($vo["grade"]); ?></TD>
    <TD><?php echo ($vo["type"]); ?></TD>
    <TD><?php echo ($vo["0"]); ?></TD>
    <TD><A href="###" target=_self class="showuncome" id="<?php echo ($vo["uid"]); ?>" name="<?php echo ($vo["name"]); ?>详细缺勤信息">缺勤信息</A></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
  <div id="pages"><?php echo ($page); ?></div>
</FORM></DIV>
</BODY></HTML>