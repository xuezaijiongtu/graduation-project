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
    $('#edit').click(function(){
      
        asyncbox.open({
            html:'<form action="__APP__/Student/edit" method="post" class="addan" name="addan"><table><tr><td>平台：</td><td><select name="platform" class="platform"><option value="" selected></option><option value="iso">iso</option><option value="android">android</option><option value="wp">WP</option><option value="h5">H5</option></select></td></tr><tr><td>版本号：</td><td><select name="version" class="version"><option value="" selected></option><option value="1.1">1.1</option><option value="1.2">1.2</option><option value="1.3">1.3</option><option value="1.4">1.4</option></select></td></tr><tr><td>公告内容：</td><td><textarea name="content" style="width:400px;"></textarea></td></tr></table></form>',
            title:'学生信息修改',
            btnsbar :$.btn.OKCANCEL,

            callback:function(action)
            {
                if(action == 'ok'){
                    asyncbox.tips('提交成功');
                    $('.addan').submit(function(){
                            var platform = $(this).find('.platform').val();
                            var version = $(this).find('.version').val();
                            alert('111111111');
                    });
                    
                        // $('.addan').submit();
                        // var platform = $(this).platform.val();
                        // var version = $(this).version.val();
                        // $.ajax(
                        //     data:{platform:platform,version:version},
                        //     url:"__APP__/Announcement/Add",
                        //     type:'post',
                        //     dataType:'json'
                        // );
                }else{
                    asyncbox.tips('取消发布');
                }
                    
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
<H2>学生数据</H2><A 
class=right href="javascript:history.back(-1)">返回上一页</A> </DIV>
<FORM id=search method='post' action="__APP__/Student/Search">
<DIV id=search_div>&nbsp;&nbsp;学院: <SELECT id=s_cid class=searchauto name=xueyuan> 
  <OPTION selected value="">选择学院(可选)</OPTION><?php if(is_array($xueyuan)): foreach($xueyuan as $key=>$vo): ?><OPTION value="<?php echo ($vo["xy_name"]); ?>"><?php echo ($vo["xy_name"]); ?></OPTION><?php endforeach; endif; ?></SELECT>&nbsp;&nbsp;学生姓名 | 学号: <INPUT 
id=s_keyword class="input w150" name=keyword type=text> <INPUT class=button value="搜 索" type=submit> </DIV></FORM>
<FORM method=post action="" target=_self>
<DIV class=list_b>
<TABLE width="100%">
  <TBODY>
  <TR>
    <TH class=w20>学号</TH>
    <TH class=w100>姓名</TH>
    <TH class=w50>性别</TH>
    <TH class=w40>学院</TH>
    <TH class=w40>专业</TH>
    <TH class=w40>班级</TH>
    <TH class=w40>年级</TH>
    <TH class=w40>学制</TH>
    <TH class=w40>类型</TH>
    <TH class=w40>手机号码</TH>
    <TH class=w40>邮箱地址</TH>
    <TH class=w80>管理操作</TH></TR>
  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><TR>
    <TD><?php echo ($vo["uid"]); ?></TD>
    <TD><?php echo ($vo["name"]); ?></TD>
    <TD><?php echo ($vo["sex"]); ?></TD>
    <TD><?php echo ($vo["xueyuan"]); ?></TD>
    <TD><?php echo ($vo["zhuanye"]); ?></TD>
    <TD><?php echo ($vo["class"]); ?></TD>
    <TD><?php echo ($vo["grade"]); ?></TD>
    <TD><?php echo ($vo["year"]); ?></TD>
    <TD><?php echo ($vo["type"]); ?></TD>
    <TD><?php echo ($vo["long_num"]); ?></TD>
    <TD><?php echo ($vo["email"]); ?></TD>
    <TD><A href="###" target=_self id="edit">修改</A> | <A onClick="return confirm('确定要删除吗？')" href="__APP__/Student/delete?uid=<?php echo ($vo["uid"]); ?>" target=_self>删除</A></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
  <div id="pages"><?php echo ($page); ?></div>
</FORM></DIV>
</BODY></HTML>