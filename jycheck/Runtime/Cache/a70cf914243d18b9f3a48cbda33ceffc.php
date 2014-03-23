<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>后台管理</TITLE>
<META content=IE=8 http-equiv=X-UA-Compatible>
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=stylesheet type=text/css href="__PUBLIC__/css/base.css"><LINK rel=stylesheet 
type=text/css href="__PUBLIC__/css/admin_box.css">
<LINK rel=stylesheet type=text/css href="__PUBLIC__/css/style.css">
<link href="__PUBLIC__/js/skins/ZCMS/asyncbox.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="__PUBLIC__/js/highcharts.js"></script>
<script src="__PUBLIC__/js/exporting.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/AsyncBox.v1.4.5.js"></script>
<SCRIPT type=text/javascript>
$(function(){
  $(".school").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).text(); 
    $.ajax({
          url: "__APP__/DataMessage/SchoolGrade",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var mydata = [];
            var sum = 0;
            for(var i in data){
                mydata.push([i, parseInt(data[i])]);
                sum += parseInt(data[i]);
            }
            var msg = '总人数: <font color=red>'+sum+'</font>人     ';
            for(var i in data){
                msg += i+': <font color=red>'+parseInt(data[i])+'</font>人     ';
            }
            asyncbox.open({
                    html:'<div>'+msg+'</div><div id="container'+schoolId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+"用户分布情况",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container'+schoolId,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: schoolName+"用户分布情况"
            },
            tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage}%</b>',
              percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: '占总用户人数',
                data: mydata
            }]
          });
          }
    });
  });


  $(".monthAddRate").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/DataMessage/MonthAddRate",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                xline.push(i);
                yline.push(parseInt(data[i])); 
            }
            asyncbox.open({
                    html:'<div id="containerRate'+schoolId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+" 月增长率分布图",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerRate'+schoolId,
                type: 'line'
            },
            title: {
                text: schoolName+' 月增长率分布图'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: xline
            },
            yAxis: {
                title: {
                    text: '人数增长率(单位:%)'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' 人';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: schoolName,
                data: yline
            }]
        });
          }
    });
  });


  $(".monthAddNum").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).attr('id');
    $.ajax({
          url: "__APP__/DataMessage/MonthAddNum",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                xline.push(data[i]['month']);
                yline.push(parseInt(data[i]['AddNum'])); 
            }
            asyncbox.open({
                    html:'<div id="containerNum'+schoolId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+" 月增长量分布图",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerNum'+schoolId,
                type: 'line'
            },
            title: {
                text: schoolName+' 月增长量分布图'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: xline
            },
            yAxis: {
                title: {
                    text: '人数增量(单位:人)'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' 人';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: schoolName,
                data: yline
            }]
        });
          }
    });
  });


  $(".schoolMonth").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).attr('id');  
    $.ajax({
          url: "__APP__/DataMessage/SchoolMonthNum",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var mydata = [];
            var num    = [];
            for(var i in data){
                mydata.push(i);
                num.push(parseInt(data[i]));
            }
            asyncbox.open({
                    html:'<div id="containerMonth'+schoolId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+"用户分布情况",
                });
                var chart;
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'containerMonth'+schoolId,
                        type: 'bar'
                    },
                    title: {
                        text: '用户分布情况'
                    },
                    xAxis: {
                        categories: mydata
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: schoolName+'用户人数分布情况'
                        }
                    },
                    legend: {
                        backgroundColor: '#FFFFFF',
                        reversed: true
                    },
                    tooltip: {
                        formatter: function() {
                            return ''+
                                this.series.name +': '+ this.y +'';
                        }
                    },
                    plotOptions: {
                        series: {
                            stacking: 'normal'
                        }
                    },
                        series: [{
                        name: schoolName,
                        data: num
                    }]
                });
          }
    });
  });

    $(".dayAddRate").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).attr('id');
    $.ajax({
          url: "__APP__/DataMessage/DayAddRate",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                xline.push(i);
                yline.push(parseFloat(data[i])); 
            }
            asyncbox.open({
                    html:'<div id="containerdayrate'+schoolId+'" style="min-width: 1100px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+" 日增长率分布图",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerdayrate'+schoolId,
                type: 'line'
            },
            title: {
                text: schoolName+' 日增长率分布图'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: xline
            },
            yAxis: {
                title: {
                    text: '增长率(单位:%)'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' 人';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: schoolName,
                data: yline
            }]
        });
          }
    });
  });

  $(".eightWeek").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/DataMessage/EightWeekData",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                xline.push("前"+(7-parseInt(i))+"周");
                yline.push(parseInt(data[i])); 
            }
            asyncbox.open({
                    html:'<div id="containerEightWeek'+schoolId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+"近8周用户增量",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerEightWeek'+schoolId,
                type: 'line'
            },
            title: {
                text: schoolName+'近8周用户增量'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: xline
            },
            yAxis: {
                title: {
                    text: '人数增量(单位:人)'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' 人';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: schoolName,
                data: yline
            }]
        });
          }
    });
  });

  $(".WeekRate").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/DataMessage/WeekDataRate",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                xline.push("前"+(7-parseInt(i))+"周");
                yline.push(parseFloat(data[i])); 
            }
            asyncbox.open({
                    html:'<div id="containerWeekRate'+schoolId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+"近8周用户增长率",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerWeekRate'+schoolId,
                type: 'line'
            },
            title: {
                text: schoolName+'近8周用户增长率'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: xline
            },
            yAxis: {
                title: {
                    text: '人数增量(单位:%)'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' 人';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: schoolName,
                data: yline
            }]
        });
          }
    });
  });


    $(".dayAddNum").click(function(){
    var schoolId   = $(this).attr('name');
    var schoolName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/DataMessage/WeekData",
          type: "POST",
          data: {schoolId:schoolId},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                xline.push(i);
                yline.push(parseInt(data[i])); 
            }
            asyncbox.open({
                    html:'<div id="containerdayAddNum'+schoolId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:schoolName+"近30天用户增量",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerdayAddNum'+schoolId,
                type: 'line'
            },
            title: {
                text: schoolName+'近30天用户增量'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: xline
            },
            yAxis: {
                title: {
                    text: '人数增量(单位:人)'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' 人';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: schoolName,
                data: yline
            }]
        });
          }
    });
  });
});
</SCRIPT>
</HEAD>
<BODY>
<DIV id=contain>
<DIV class=admin_title>
<H2>高校数据</H2><A 
class=right href="javascript:history.back(-1)">返回上一页</A> </DIV>
<DIV class=admin_menu><A 
href="http://localhost/apps/admins.php/article/add">更新数据</A><A 
class=right
href="__APP__/DataMessage/DoSort?sort=studentDayNumAdd">日增长人数排序</A><A class=right 
 href="__APP__/DataMessage/DoSort?sort=WeekData">周增长人数排序</A>
<A class=right 
 href="__APP__/DataMessage/DoSort?sort=studentMonthNumAdd">月增长人数排序</A><A 
class=right href="__APP__/DataMessage/DoSort?sort=EffStudentNum">有效用户排序</A> <A 
class=right href="__APP__/DataMessage/DoSort?sort=studentNum">总人数排序</A> </DIV>
<FORM id=search method='post' action="__APP__/DataMessage/Search">
<DIV id=search_div>&nbsp;&nbsp;省份: <SELECT id=s_cid class=searchauto name=province> 
  <OPTION selected value="">选择省份(可选)</OPTION><?php if(is_array($province)): foreach($province as $key=>$vo): ?><OPTION value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></OPTION><?php endforeach; endif; ?></SELECT>&nbsp;&nbsp;排序方式: <SELECT id=s_cid class=searchauto name=order> 
  <OPTION selected value="studentNum">总人数(默认)</OPTION><OPTION value="EffStudentNum">有效用户</OPTION><OPTION value="studentMonthNumAdd">月增长人数</OPTION><OPTION value="WeekData">周增长人数</OPTION><OPTION value="studentDayNumAdd">日增长人数</OPTION></SELECT>&nbsp;&nbsp;高校关键字: <INPUT 
id=s_keyword class="input w150" name=keyword type=text> <INPUT class=button value="搜 索" type=submit> </DIV></FORM>
<FORM method=post action="" target=_self>
<DIV class=list_b>
<TABLE width="100%">
  <TBODY>
  <TR>
    <TH class=w20><INPUT onclick=checkAll(this) type=checkbox></TH>
    <TH class=w20>排名</TH>
    <TH class=w100>高校名称</TH>
    <TH class=w50>所属省份</TH>
    <TH class=w50>用户总数</TH>
    <TH class=w50>有效用户</TH>
    <TH class=w40>日增长量</TH>
    <TH class=w40>日增长率</TH>
    <TH class=w40>周增长量</TH>
    <TH class=w40>周增长率</TH>
    <TH class=w40>月增长量</TH>
    <TH class=w40>月增长率</TH></TR>
  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><TR>
    <TD><INPUT id=id[] name=id[] value=<?php echo ($vo->schoolId); ?> type=checkbox></TD>
    <TD><?php echo ($key+1); ?></TD>
    <TD><a href="###" class="school" name="<?php echo ($vo->schoolId); ?>"><?php echo ($vo->schoolName); ?></a></TD>
    <TD><?php echo ($vo->province); ?></TD>
    <TD><a href="###" class="schoolMonth" name="<?php echo ($vo->schoolId); ?>" id="<?php echo ($vo->schoolName); ?>"><?php echo ($vo->studentNum); ?></a></TD>
    <TD><?php echo ($vo->EffStudentNum); ?></TD>
    <TD><a href="###" class="dayAddNum" name="<?php echo ($vo->schoolId); ?>" id="<?php echo ($vo->schoolName); ?>"><?php echo ($vo->studentDayNumAdd); ?></a></TD>
    <TD><a href="###" class="dayAddRate" name="<?php echo ($vo->schoolId); ?>" id="<?php echo ($vo->schoolName); ?>"><?php echo ($vo->studentDayAddRate); ?></a></TD>
    <TD><a href="###" class="eightWeek" name="<?php echo ($vo->schoolId); ?>" id="<?php echo ($vo->schoolName); ?>"><?php echo ($vo->WeekData); ?></a></TD>
    <TD><a href="###" class="WeekRate" name="<?php echo ($vo->schoolId); ?>" id="<?php echo ($vo->schoolName); ?>"><?php echo ($vo->WeekDataRate); ?></a></TD>
    <TD><a href="###" class="monthAddNum" name="<?php echo ($vo->schoolId); ?>" id="<?php echo ($vo->schoolName); ?>"><?php echo ($vo->studentMonthNumAdd); ?></a></TD>
    <TD><a href="###" class="monthAddRate" name="<?php echo ($vo->schoolId); ?>" id="<?php echo ($vo->schoolName); ?>"><?php echo ($vo->studentMonthAddRate); ?></a></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
  <div id="pages"><?php echo ($page); ?></div>
</FORM></DIV>
</BODY></HTML>