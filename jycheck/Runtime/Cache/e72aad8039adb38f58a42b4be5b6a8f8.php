<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        var record_id = $(this).attr('id');
        var infoShow  = $(this).attr('name');
        $.ajax({
          url: "__APP__/CheckData/getAllUncomeStudentName",
          type: "POST",
          data: {record_id:record_id},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            asyncbox.open({
                html:'<div style="width:380px;height:280px;font-size:16px;">'+data.studentName+'</div>',
                title:infoShow+'缺勤名单',
                });
            }
        });
    });

    $(".show").click(function(){
        var className   = $(this).attr('name');
        var showTitle   = className + "缺勤人数曲线图";
        $.ajax({
            url: "__APP__/CheckData/CheckClassData",
            type: "POST",
            data: {class_name:className},
            dataType: "json",
            error: function(){
                alert('异步查询表失败,请联系管理员');
            },
            success: function(data){
                var xline = [];
                var yline = [];
                for(var i in data){
                    xline.push(data[i].record_time);
                    yline.push(parseInt(data[i].record_uncome));
                }
                asyncbox.open({
                        html:'<div id="container" style="min-width: 1420px; height: 400px; margin: 0 auto"></div>',
                        title:showTitle
                    });
                 new Highcharts.Chart({
                    chart: {
                        renderTo:"container",
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: showTitle,
                        x: -20 //center
                    },
                    subtitle: {
                        text: '',
                        x: -20
                    },
                    xAxis: {
                        categories: xline
                    },
                    yAxis: {
                        title: {
                            text: '缺勤人数'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: '人'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [{
                        name: '缺勤人数',
                        data: yline
                    }]
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
<H2>班级考勤数据</H2><A 
class=right href="javascript:history.back(-1)">返回上一页</A> </DIV>
<FORM id=search method='post' action="__APP__/CheckData/Search">
<DIV id=search_div>&nbsp;&nbsp;学院: <SELECT id=s_cid class=searchauto name=xueyuan> 
  <OPTION selected value="">选择学院(可选)</OPTION><?php if(is_array($xueyuan)): foreach($xueyuan as $key=>$vo): ?><OPTION value="<?php echo ($vo["xy_name"]); ?>"><?php echo ($vo["xy_name"]); ?></OPTION><?php endforeach; endif; ?></SELECT>&nbsp;&nbsp;课程名字: <INPUT 
id=s_keyword class="input w150" name=keyword type=text> <INPUT class=button value="搜 索" type=submit> </DIV></FORM>
<FORM method=post action="" target=_self>
<DIV class=list_b>
<TABLE width="80%">
  <TBODY>
  <TR>
    <TH class=w50>班级</TH>
    <TH class=w80>管理操作</TH></TR>
  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><TR>
    <TD><?php echo ($vo["record_class"]); ?></TD>
    <TD><A href="###" class="show" name="<?php echo ($vo["record_class"]); ?>" target=_self>查看图表</A></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
  <div id="pages"><?php echo ($page); ?></div>
</FORM></DIV>
</BODY></HTML>