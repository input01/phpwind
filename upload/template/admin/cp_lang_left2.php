<?php
!function_exists('readover') && exit('Forbidden');
$_yes='是';
$_no='否';
$_diy='常用选项';

$nav_head=array(
	'manager'=>'创始人',
	'forums'=>'版块',
	'member'=>'用户',
	'read'=>'帖子',
	'config'=>'核心设置',
	'wholemanager'=>'论坛管理',
	'hackstyle'=>'风格插件',
	'others'=>'其他设置',
	'system'=>'系统工具',
	'extend'=>'扩展功能',
);
$nav_manager=array(
	'name'=>'创始人选项',
	'option'=>array(
		'rightset'=>array('后台权限设置',"$admin_file?adminjob=rightset"),
		'manager'=>array('修改论坛创始人',"$admin_file?adminjob=manager"),
		'code'=>array('论坛营销计划',"$admin_file?adminjob=code"),
		'diyoption'=>array('常用选项定制',"$admin_file?adminjob=diyoption"),
	),
);
$nav_left=array(
	'config'=>array(
		'settings'=>array(
			'name'=>'核心设置',
			'option'=>array(
				'settings'=>array(
					'all'=>array('所有设置',"$admin_file?adminjob=settings&type=all"),
					'bbsset'=>array('基本参数',"$admin_file?adminjob=settings&type=bbsset"),
					'seo'=>array('搜索引擎优化',"$admin_file?adminjob=settings&type=seo"),
					'basicset'=>array('论坛资料',"$admin_file?adminjob=settings&type=basicset"),
					'coreset'=>array('核心功能',"$admin_file?adminjob=settings&type=coreset"),
					'setgd'=>array('认证码',"$admin_file?adminjob=settings&type=setgd"),
					'pathset'=>array('动态目录',"$admin_file?adminjob=settings&type=pathset"),
					'regset'=>array('注册控制',"$admin_file?adminjob=settings&type=regset"),
					'windcode'=>array('发帖代码',"$admin_file?adminjob=settings&type=windcode"),
					'attachset'=>array('发帖与附件',"$admin_file?adminjob=settings&type=attachset"),
					'atcset'=>array('帖子奖惩选项',"$admin_file?adminjob=settings&type=atcset"),
					'indexset'=>array('首页细节',"$admin_file?adminjob=settings&type=indexset"),
					'viewset'=>array('各页面细节',"$admin_file?adminjob=settings&type=viewset"),
					'watermark'=>array('图片水印',"$admin_file?adminjob=settings&type=watermark"),
					'buysign'=>array('签名购买',"$admin_file?adminjob=settings&type=buysign"),
					'ajax'=>array('AJAX 设置',"$admin_file?adminjob=settings&type=ajax"),
					'wap'=>array('WAP 设置',"$admin_file?adminjob=settings&type=wap"),
					'js'=>array('JS 调用',"$admin_file?adminjob=settings&type=js"),
					'creditset'=>array('积分名称',"$admin_file?adminjob=settings&type=creditset"),
					'mail'=>array('邮件设置',"$admin_file?adminjob=settings&type=mail"),
					'safe'=>array('论坛安全控制',"$admin_file?adminjob=settings&type=safe"),
					'ftp'=>array('ftp设置',"$admin_file?adminjob=settings&type=ftp"),
					'other'=>array('其它设置',"$admin_file?adminjob=settings&type=other"),
				),
			),
		),
	),
	'forums'=>array(
		'forummaneger'=>array(
			'name'=>'版块管理',
			'option'=>array(
				'setforum'=>array('版块管理',"$admin_file?adminjob=setforum"),
				'uniteforum'=>array('版块合并',"$admin_file?adminjob=uniteforum"),
				'creathtm'=>array('生成htm',"$admin_file?adminjob=creathtm"),
			),
		),
	),
	'read'=>array(
		'artmanager'=>array(
			'name'=>'帖子管理',
			'option'=>array(
				'tpccheck'=>array('审核主题',"$admin_file?adminjob=tpccheck"),
				'postcheck'=>array('审核回复',"$admin_file?adminjob=postcheck"),
				'report'=>array('报告管理',"$admin_file?adminjob=report"),
			),
		),
		'attmanager'=>array(
			'name'=>'附件管理',
			'option'=>array(
				'attachment'=>array('附件管理',"$admin_file?adminjob=attachment"),
				'attachstats'=>array('附件统计',"$admin_file?adminjob=attachstats"),
				'attachrenew'=>array('附件修复',"$admin_file?adminjob=attachrenew"),
			),
		),
	),
	'member'=>array(
		'members'=>array(
			'name'=>'会员管理',
			'option'=>array(
				'setuser'=>array('会员管理',"$admin_file?adminjob=setuser"),
				'unituser'=>array('合并会员',"$admin_file?adminjob=unituser"),
				'checkreg'=>array('注册审核',"$admin_file?adminjob=usercheck&a_type=checkreg"),
				'checkemail'=>array('邮件审核',"$admin_file?adminjob=usercheck&a_type=checkemail"),
				'banuser'=>array('会员禁言',"$admin_file?adminjob=banuser"),
				'viewban'=>array('查看禁言会员',"$admin_file?adminjob=viewban"),
				'singleright'=>array('单个用户权限',"$admin_file?adminjob=singleright"),
				'customcredit'=>array('自定义积分',"$admin_file?adminjob=customcredit"),
			),
		),
		'groups'=>array(
			'name'=>'用户组管理',
			'option'=>array(
				'level'=>array('用户组权限',"$admin_file?adminjob=level"),
				'userstats'=>array('成员统计',"$admin_file?adminjob=userstats"),
				'upgrade'=>array('会员组提升方案',"$admin_file?adminjob=upgrade"),
				'editgroup'=>array('批量添加',"$admin_file?adminjob=editgroup"),
				'uptime'=>array('有效期设置',"$admin_file?adminjob=uptime"),
			),
		),
	),
	'wholemanager'=>array(
		'wholemanager'=>array(
			'name'=>'统筹管理',
			'option'=>array(
				'sethtm'=>array('静态目录部署',"$admin_file?adminjob=sethtm"),
				'postcache'=>array('动作表情',"$admin_file?adminjob=postcache"),
				'ipsearch'=>array('IP 检索',"$admin_file?adminjob=ipsearch"),
				'customfield'=>array('用户栏目',"$admin_file?adminjob=customfield"),
				'updatecache'=>array('缓存管理',"$admin_file?adminjob=updatecache"),
				'credit'=>array('自定义积分',"$admin_file?adminjob=credit"),
			),
		),
		'log'=>array(
			'name'=>'管理日志',
			'option'=>array(
				'adminlog'=>array('后台管理日志',"$admin_file?adminjob=record&a_type=adminlog"),
				'forumlog'=>array('前台管理日志',"$admin_file?adminjob=forumlog"),
			),
		),
	),
	'hackstyle'=>array(
		'hackstyle'=>array(
			'name'=>'插件风格',
			'option'=>array(
				'hackcenter'=>array('插件中心',"$admin_file?adminjob=hackcenter"),
				'setstyles'=>array('风格模版',"$admin_file?adminjob=setstyles"),
			),
		),
	),
	'others'=>array(
		'info'=>array(
			'name'=>'信息管理',
			'option'=>array(
				'announcement'=>array('公告管理',"$admin_file?adminjob=announcement"),
				'mailuser'=>array('Email 群发',"$admin_file?adminjob=sendmsg&a_type=mailuser"),
				'send_msg'=>array('短消息群发',"$admin_file?adminjob=sendmsg&a_type=send_msg"),
				'giveuser'=>array('节日礼品赠送',"$admin_file?adminjob=sendmsg&a_type=giveuser"),
			),
		),
		'assistant'=>array(
			'name'=>'辅助管理',
			'option'=>array(
				'ipban'=>array('IP 禁止',"$admin_file?adminjob=ipban"),
				'setbwd'=>array('不良词语过滤',"$admin_file?adminjob=setbwd"),
				'setads'=>array('宣传设置',"$admin_file?adminjob=setads"),
				'ipstates'=>array('IP统计',"$admin_file?adminjob=ipstates"),
				'share'=>array('友情链接',"$admin_file?adminjob=share"),
				'viewtody'=>array('今日到访会员',"job.php?action=viewtody"),
				'chmod'=>array('文件属性',"$admin_file?adminjob=chmod"),
				'help'=>array('自定义帮助文档',"$admin_file?adminjob=help"),
			),
		),
	),
	'system'=>array(
		'supdel'=>array(
			'name'=>'批量删除',
			'option'=>array(
				'article'=>array('删除帖子',"$admin_file?adminjob=superdel&a_type=article"),
				'member'=>array('删除用户',"$admin_file?adminjob=superdel&a_type=member"),
				'message'=>array('删除短消息',"$admin_file?adminjob=superdel&a_type=message"),
				'recycle'=>array('回收站',"$admin_file?adminjob=recycle"),
			),
		),
		'task'=>array(
			'name'=>'计划任务',
			'option'=>array(
				'plantodo'=>array('计划任务管理',"$admin_file?adminjob=plantodo"),
				'addplan'=>array('添加新任务',"$admin_file?adminjob=addplan"),
			),
		),
		'database'=>array(
			'name'=>'数据库',
			'option'=>array(
				'bakout'=>array('数据备份',"$admin_file?adminjob=bakup&a_type=bakout"),
				'bakin'=>array('数据恢复',"$admin_file?adminjob=bakup&a_type=bakin"),
				'repair'=>array('数据修复',"$admin_file?adminjob=repair"),
				'ptable'=>array('数据库分卷',"$admin_file?adminjob=ptable"),
			),
		),
	),
	'extend'=>array(
		'onlinepay'=>array(
			'name'=>'网上支付设置',
			'option'=>array(
				'userpay'=>array('网上支付',"$admin_file?adminjob=userpay"),
				'orderlist'=>array('订单管理',"$admin_file?adminjob=orderlist"),
			),
		),
		'curren'=>array(
			'name'=>'论坛交易币',
			'option'=>array(
				'currencyset'=>array('交易币设置',"$admin_file?adminjob=currencyset"),
				'currency'=>array('交易币管理',"$admin_file?adminjob=currency"),
				'toollog'=>array('交易币日志',"$admin_file?adminjob=toollog"),
			),
		),
	),
);
?>