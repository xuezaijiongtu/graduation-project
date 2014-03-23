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
    var provinceId   = $(this).attr('name');
    var provinceName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/ProvinceMessage/Calculate",
          type: "POST",
          data: {provinceId:provinceId,type:"MonthRate"},
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
                    html:'<div id="containerRate'+provinceId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:provinceName+" 月增长率分布图",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerRate'+provinceId,
                type: 'line'
            },
            title: {
                text: provinceName+' 月增长率分布图'
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
                name: provinceName,
                data: yline
            }]
        });
          }
    });
  });


  $(".monthAddNum").click(function(){
    var provinceId   = $(this).attr('name');
    var provinceName = $(this).attr('id');
    $.ajax({
          url: "__APP__/ProvinceMessage/Calculate",
          type: "POST",
          data: {provinceId:provinceId,type:"MonthNum"},
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
                    html:'<div id="containerNum'+provinceId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:provinceName+" 月增长量分布图",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerNum'+provinceId,
                type: 'line'
            },
            title: {
                text: provinceName+' 月增长量分布图'
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
                name: provinceName,
                data: yline
            }]
        });
          }
    });
  });


  $(".schoolMonth").click(function(){
    var provinceId   = $(this).attr('name');
    var schoolName = $(this).attr('id');  
    $.ajax({
          url: "__APP__/ProvinceMessage/ProvinceMonthNum",
          type: "POST",
          data: {provinceId:provinceId},
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
    var provinceId   = $(this).attr('name');
    var provinceName = $(this).attr('id');
    $.ajax({
          url: "__APP__/ProvinceMessage/Calculate",
          type: "POST",
          data: {provinceId:provinceId,type:"DayRate"},
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
                    html:'<div id="containerdayrate'+provinceId+'" style="min-width: 1100px; height: 540px; margin: 0 auto"></div>',
                    title:provinceName+" 日增长率分布图",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerdayrate'+provinceId,
                type: 'line'
            },
            title: {
                text: provinceName+' 日增长率分布图'
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
                name: provinceName,
                data: yline
            }]
        });
          }
    });
  });

  $(".eightWeek").click(function(){
    var provinceId   = $(this).attr('name');
    var provinceName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/ProvinceMessage/Calculate",
          type: "POST",
          data: {provinceId:provinceId,type:"WeekNum"},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                //xline.push("前"+(7-parseInt(i))+"周");
                yline.push(parseInt(data[i])); 
            }
            for(i=0;i<=7;i++)
            {
                xline.push("前"+(7-parseInt(i))+"周");
            }
            asyncbox.open({
                    html:'<div id="containerEightWeek'+provinceId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:provinceName+"近8周用户增量",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerEightWeek'+provinceId,
                type: 'line'
            },
            title: {
                text: provinceName+'近8周用户增量'
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
                name: provinceName,
                data: yline
            }]
        });
          }
    });
  });

  $(".WeekRate").click(function(){
    var provinceId   = $(this).attr('name');
    var provinceName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/ProvinceMessage/Calculate",
          type: "POST",
          data: {provinceId:provinceId,type:"WeekRate"},
          dataType: "json",
          error: function(){
              alert('异步查询表失败,请联系管理员');
          },
          success: function(data){
            var xline = [];
            var yline = [];
            for(var i in data){
                yline.push(parseFloat(data[i])); 
            }
            for(i=0;i<=7;i++)
            {
                xline.push("前"+(7-parseInt(i))+"周");
            }
            asyncbox.open({
                    html:'<div id="containerWeekRate'+provinceId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:provinceName+"近8周用户增长率",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerWeekRate'+provinceId,
                type: 'line'
            },
            title: {
                text: provinceName+'近8周用户增长率'
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
                name: provinceName,
                data: yline
            }]
        });
          }
    });
  });


    $(".dayAddNum").click(function(){
    var provinceId   = $(this).attr('name');
    var provinceName = $(this).attr('id'); 
    $.ajax({
          url: "__APP__/ProvinceMessage/Calculate",
          type: "POST",
          data: {provinceId:provinceId,type:"DayNum"},
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
                    html:'<div id="containerdayAddNum'+provinceId+'" style="min-width: 900px; height: 540px; margin: 0 auto"></div>',
                    title:provinceName+"近30天用户增量",
                });
            var chart;
            chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerdayAddNum'+provinceId,
                type: 'line'
            },
            title: {
                text: provinceName+'近30天用户增量'
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
                name: provinceName,
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
<H2>省份数据</H2><A 
class=right href="javascript:history.back(-1)">返回上一页</A> </DIV>
<DIV class=admin_menu><A 
href="http://localhost/apps/admins.php/article/add">更新数据</A><A 
class=right
href="__APP__/ProvinceMessage/ProvinceInfoShow?type=TodayNum">日增长人数排序</A><A class=right 
 href="__APP__/ProvinceMessage/ProvinceInfoShow?type=ToWeekNum">周增长人数排序</A>
<A class=right 
 href="__APP__/ProvinceMessage/ProvinceInfoShow?type=ToMonthNum">月增长人数排序</A> <A 
class=right href="__APP__/ProvinceMessage/ProvinceInfoShow?type=ProvinceNum">总人数排序</A> </DIV>

<FORM method=post action="" target=_self>
<DIV class=list_b>
<TABLE width="100%">
  <TBODY>
  <TR>
    <TH class=w20>排名</TH>
    <TH class=w100>省份名称</TH>
    <TH class=w50>用户总数</TH>
    <TH class=w40>日增长量</TH>
    <TH class=w40>日增长率</TH>
    <TH class=w40>周增长量</TH>
    <TH class=w40>周增长率</TH>
    <TH class=w40>月增长量</TH>
    <TH class=w40>月增长率</TH></TR>
  <?php if(is_array($data)): foreach($data as $key=>$vo): ?><TR>
    <TD><?php echo ($key+1); ?></TD>
    <TD><a href="###" class="" name="<?php echo ($vo["provinceId"]); ?>"><?php echo ($vo["name"]); ?></a></TD>
    <TD><a href="###" class="" name="<?php echo ($vo["provinceId"]); ?>" id="<?php echo ($vo["name"]); ?>"><?php echo ($vo["ProvinceNum"]); ?></a></TD>
    <TD><a href="###" class="dayAddNum" name="<?php echo ($vo["provinceId"]); ?>" id="<?php echo ($vo["name"]); ?>"><?php echo ($vo["TodayNum"]); ?></a></TD>
    <TD><a href="###" class="dayAddRate" name="<?php echo ($vo["provinceId"]); ?>" id="<?php echo ($vo["name"]); ?>"><?php echo ($vo["TodayRate"]); ?></a></TD>
    <TD><a href="###" class="eightWeek" name="<?php echo ($vo["provinceId"]); ?>" id="<?php echo ($vo["name"]); ?>"><?php echo ($vo["ToWeekNum"]); ?></a></TD>
    <TD><a href="###" class="WeekRate" name="<?php echo ($vo["provinceId"]); ?>" id="<?php echo ($vo["name"]); ?>"><?php echo ($vo["ToWeekRate"]); ?></a></TD>
    <TD><a href="###" class="monthAddNum" name="<?php echo ($vo["provinceId"]); ?>" id="<?php echo ($vo["name"]); ?>"><?php echo ($vo["ToMonthNum"]); ?></a></TD>
    <TD><a href="###" class="monthAddRate" name="<?php echo ($vo["provinceId"]); ?>" id="<?php echo ($vo["name"]); ?>"><?php echo ($vo["ToMonthRate"]); ?></a></TD>
  </TR><?php endforeach; endif; ?>
  </TBODY></TABLE></DIV>
</FORM></DIV>
</BODY></HTML>