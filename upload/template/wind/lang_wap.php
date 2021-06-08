<?php
!function_exists('readover') && exit('Forbidden');
$lang = array (

'wap_closed'	=> '系统没有开启 WAP功能',
'undefined_action'	=> "非法操作,请返回",
'not_login'			=> "您还没有登录或注册，暂时不能使用此功能!!",
'wap_quit'			=> "状态：您已经顺利退出网站",
'forum_right'	=> '该版块为认证版块：您没有权限查看该版块的文章',
'post_nofid'	=> '没有选择分类',
'post_success'	=> '文章发表成功。',
'post_ban'		=> '您已经被管理员禁言，不能发表文章',
'post_right'	=> '您没有权限在该版块发表主题',
'reply_right'	=> '您没有权限在该版块发表回复',
'post_group'	=> '您所属的用户组没有发表主题的权限',
'reply_group'	=> '您所属的用户组没有发表回复的权限',
'wap_login'		=> '登录成功',
'login_have'	=> "您已经为会员身份,请不要重复登录!",
'post_openpost'	=> "由于工作力度与时间原因, 站点开放评论时间为 $db_poststart:00 点到 $db_postend:00 点 !",
'post_check'	=> "您还没通过管理员验证,需要通过管理员验证才能发言！",
'post_newrg_limit'	=> "新注册用户$db_postallowtime 小时内不能发帖！",
'post_gp_limit'	=> "用户组权限：你所属的用户组每日最多能发 $_G[postlimit] 篇帖子.",
'post_limit'	=> "灌水预防机制已经打开，在{$gp_postpertime}秒内不能发贴",
'illegal_tid'	=> "帖子ID非法",
'reply_ifcheck'	=> "该贴未通过管理员验证，不可回复",
'reply_lockatc'	=> "该贴已被锁定，不可回复",
'read_locked'	=> "此帖被管理员关闭，暂时不能浏览",
'login_jihuo'	=> "你的帐号没有激活，请先到您注册的邮箱里激活帐号!",
'login_pwd_error'	=> "密码错误,您还可以尝试 $L_T 次",
'login_forbid'		=> "已经连续 6 次密码输入错误,您将在 10 分钟内无法正常登录,还剩余 $L_T 秒",
'user_not_exists'	=> "用户{$errorname}不存在",
'msg_refuse'	=> "您发送的消息被用户拒绝",
'no_msg'	=> '短消息不存在',
'msg_success'	=> '短消息发送成功。',
'msg_delete'	=> '短消息删除成功。',

);
?>