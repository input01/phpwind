<?php
!function_exists('readover') && exit('Forbidden');
$_yes='是';
$_no='否';
$lang=array(
	'论坛核心设置'=>array(
		'settings'=>array(
			"<a target=main href='$admin_file?adminjob=settings&type=all'>所有设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=bbsset'>基本参数设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=seo'>搜索引擎优化设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=basicset'>论坛资料设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=coreset'>核心功能设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=setgd'>认证码设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=pathset'>动态目录设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=regset'>会员注册控制</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=windcode'>发帖代码设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=attachset'>发帖与附件设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=atcset'>帖子奖惩选项</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=indexset'>首页细节设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=viewset'>各页面细节设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=watermark'>图片水印设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=buysign'>签名购买设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=ajax'>AJAX 设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=wap'>WAP 设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=js'>JS 调用设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=creditset'>积分名称设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=mail'>发送邮件设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=safe'>论坛安全控制</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=ftp'>ftp设置</a><br>",
			"<a target=main href='$admin_file?adminjob=settings&type=other'>其它设置</a><br>",
		),
	),
	'网站统筹管理'=>array(
		'sethtm'=>"<a target=main href='$admin_file?adminjob=sethtm'>静态目录部署</a><br>",
		'updatecache'=>"<a target=main href='$admin_file?adminjob=updatecache'>缓存数据管理</a><br>",
		'postcache'=>"<a target=main href='$admin_file?adminjob=postcache'>动作表情管理</a><br>",
		'credit'=>"<a target=main href='$admin_file?adminjob=credit&action=newcredit'>添加</a>|<a target=main href='$admin_file?adminjob=credit'>管理自定义积分</a><br>",
		'customcredit'=>"<a target=main href='$admin_file?adminjob=customcredit'>用户自定义积分管理</a><br>",
	),
	'版块管理'=>array(
		'setforum'=>"<a target=main href='$admin_file?adminjob=setforum'><font color=blue>版块管理</font></a><br>",
		'uniteforum'=>"<a target=main href='$admin_file?adminjob=uniteforum'>版块合并</a><br>",
		'creathtm'=>"<a target=main href='$admin_file?adminjob=creathtm'>生成htm页面(<font color='blue'>论坛</font>)</a><br>",
	),
	'会员管理'=>array(
		'setuser'=>"<a target=main href='$admin_file?adminjob=setuser'><font color=blue>注册会员管理</font></a><br>",
		'ipsearch'=>"<a target=main href='$admin_file?adminjob=ipsearch'>会员 IP 检索</a><br>",
		'unituser'=>"<a target=main href='$admin_file?adminjob=unituser'>合并会员</a><br>",
		'checkreg'=>"<a target=main href='$admin_file?adminjob=usercheck&a_type=checkreg'>注册会员审核</a><br>",
		'checkemail'=>"<a target=main href='$admin_file?adminjob=usercheck&a_type=checkemail'>邮件激活审核</a><br>",
		'banuser'=>"<a target=main href='$admin_file?adminjob=banuser'>会员禁言管理</a><br>",
		'viewban'=>"<a target=main href='$admin_file?adminjob=viewban'>查看禁言会员</a><br>",
		'singleright'=>"<a target=main href='$admin_file?adminjob=singleright'>单个用户权限</a><br>",
		'customfield'=>"<a target=main href='$admin_file?adminjob=customfield&action=add'>添加</a> | <a target=main href='$admin_file?adminjob=customfield'>管理用户栏目</a>",
	),
	'用户组管理'=>array(
		'userstats'=>"<a target=main href='$admin_file?adminjob=userstats'>用户组成员统计</a><br>",
		'upgrade'=>"<a target=main href='$admin_file?adminjob=upgrade'>会员组提升方案</a><br>",
		'editgroup'=>"<a target=main href='$admin_file?adminjob=editgroup'>批量添加</a><br>",
		'level'=>"<a target=main href='$admin_file?adminjob=level'>用户组管理</a><br>",
		'uptime'=>"<a target=main href='$admin_file?adminjob=uptime'>管理组有效期设置</a><br>",
	),
	'帖子管理'=>array(
		'tpccheck'=>"<a target=main href='$admin_file?adminjob=tpccheck'>主题审核管理</a><br>",
		'postcheck'=>"<a target=main href='$admin_file?adminjob=postcheck'>回复审核管理</a><br>",
		'report'=>"<a target=main href='$admin_file?adminjob=report'>帖子报告管理</a><br>",
	),
	'附件管理'=>array(
		'attachment'=>"<a target=main href='$admin_file?adminjob=attachment'>附件管理</a><br>",
		'attachstats'=>"<a target=main href='$admin_file?adminjob=attachstats'>附件统计</a><br>",
		'attachrenew'=>"<a target=main href='$admin_file?adminjob=attachrenew'>附件修复</a><br>",
	),
	'插件风格'=>array(
		'hackcenter'=>" <a target=main href='$admin_file?adminjob=hackcenter'>插件中心</a><br>",
		'setstyles'=>"<a target=main href='$admin_file?adminjob=setstyles'>风格模版设置</a><br>",
	),
	'网上支付设置'=>array(
		'userpay'=>"<a target=main href='$admin_file?adminjob=userpay'>网上支付</a><br>",
		'orderlist'=>"<a target=main href='$admin_file?adminjob=orderlist'>订单管理</a><br>",
	),
	'论坛交易币'=>array(
		'currencyset'=>"<a target=main href='$admin_file?adminjob=currencyset'>交易币设置</a><br>",
		'currency'=>"<a target=main href='$admin_file?adminjob=currency'>交易币管理</a><br>",
		'toollog'=>"<a target=main href='$admin_file?adminjob=toollog'>交易币日志</a><br>",
	),
	'信息管理'=>array(
		'announcement'=>"<a target=main href='$admin_file?adminjob=announcement&action=add' >发布</a> <a>|</a> <a target=main href='$admin_file?adminjob=announcement'>管理</a> <a>公告</a><br>",
		'mailuser'=>"<a target=main href='$admin_file?adminjob=sendmsg&a_type=mailuser'>Email 群发</a><br>",
		'send_msg'=>"<a target=main href='$admin_file?adminjob=sendmsg&a_type=send_msg'>短消息群发</a><br>",
		'giveuser'=>"<a target=main href='$admin_file?adminjob=sendmsg&a_type=giveuser'>节日礼物赠送功能</a><br>",
	),
	'辅助管理'=>array(
		'ipban'=>"<a target=main href='$admin_file?adminjob=ipban'>IP 禁止</a><br>",
		'setbwd'=>"<a target=main href='$admin_file?adminjob=setbwd'>不良词语过滤</a><br>",
		'setads'=>"<a target=main href='$admin_file?adminjob=setads'>论坛宣传设置</a><br>",
		'ipstates'=>"<a target=main href='$admin_file?adminjob=ipstates'>IP统计设置</a><br>",
		'share'=>"<a target=main href='$admin_file?adminjob=share&action=add'>添加</a> | <a target=main href='$admin_file?adminjob=share'>管理友情链接</a><br>",
		'viewtody'=>"<a target=main href='job.php?action=viewtody'>查看今日到访会员</a><br>",
		'chmod'=>"<a target=main href='$admin_file?adminjob=chmod'>文件属性检查</a><br>",
		'help'=>"<a target=main href='$admin_file?adminjob=help'>自定义帮助文档</a><br>",
	),
	'批量删除'=>array(
		'article'=>"<a target=main href='$admin_file?adminjob=superdel&a_type=article'>删除帖子</a><br>",
		'member'=>"<a target=main href='$admin_file?adminjob=superdel&a_type=member'>删除用户</a><br>",
		'message'=>"<a target=main href='$admin_file?adminjob=superdel&a_type=message'>删除短消息</a><br>",
		'recycle'=>"<a target=main href='$admin_file?adminjob=recycle'>回收站管理</a><br>",
	),
	'计划任务'=>array(
		'plantodo'=>"<a target=main href='$admin_file?adminjob=plantodo'>计划任务管理</a><br>",
		'addplan'=>"<a target=main href='$admin_file?adminjob=addplan'>添加新的计划任务</a><br>",
	),
	'数据库管理'=>array(
		'bakout'=>"<a target=main href='$admin_file?adminjob=bakup&a_type=bakout'>数据备份</a><br>",
		'bakin'=>"<a target=main href='$admin_file?adminjob=bakup&a_type=bakin'>数据恢复</a><br>",
		'repair'=>"<a target=main href='$admin_file?adminjob=repair'>数据库修复</a><br>",
		'ptable'=>"<a target=main href='$admin_file?adminjob=ptable'>数据库分卷</a><br>",
	),
	'管理日志'=>array(
		'adminlog'=>"<a target=main href='$admin_file?adminjob=record&a_type=adminlog'>后台管理日志</a><br>",
		'forumlog'=>"<a target=main href='$admin_file?adminjob=forumlog'>前台管理日志</a><br>",
	)
);
?>