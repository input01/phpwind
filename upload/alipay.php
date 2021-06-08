<?php
require_once('global.php');

include_once(D_P.'data/bbscache/ol_config.php');
if(!$ol_onlinepay){
	Showmsg($ol_whycolse);
}
if(!$ol_payto){
	Showmsg('olpay_seterror');
}
$url='';
foreach($_GET as $key => $value){
	if($value){
		$url .= "$key=".urlencode($value)."&";
	}
}
//InitGP(array('out_trade_no','trade_status','buyer_email','notify_id'));
$veryfy_result1 = get_verify("http://pay.phpwind.com/pay/alipay_notify.php?$url");
$veryfy_result2 = get_verify("http://notify.alipay.com/trade/notify_query.do?notify_id=$notify_id&partner=2088001505801569");
if(!eregi("true$",$veryfy_result1) || !eregi("true$",$veryfy_result2)){
	refreshto('userpay.php','安全验证参数校验失败，无法完成充值！');
}

$rt = $db->get_one("SELECT c.*,m.username FROM pw_clientorder c LEFT JOIN pw_members m USING(uid) WHERE order_no='$out_trade_no'");
if(!$rt){
	refreshto('userpay.php','系统中没有您的充值订单，无法完成充值！');
}
if(intval($rt['number'])!=intval($_GET['total_fee']) || $_GET['seller_email']!=$ol_payto){
	refreshto('userpay.php','安全验证参数校验失败，无法完成充值！');
}
if($trade_status=='TRADE_FINISHED'){
	if($rt['state'] == 2){
		refreshto('userpay.php','该订单已经充值成功！');
	}
	!$db_rmbrate && $db_rmbrate=10;
	$currency = $rt['number'] * $db_rmbrate;
	$number   = $rt['number'];
	$db->update("UPDATE pw_memberdata SET currency=currency+'$currency' WHERE uid='$rt[uid]'");
	$db->update("UPDATE pw_clientorder SET payemail='$buyer_email',state=2,descrip='已完成订单' WHERE order_no='$out_trade_no'");

	require_once(R_P.'require/tool.php');
	$logdata=array(
		'type'		=>	'olpay',
		'nums'		=>	0,
		'money'		=>	0,
		'descrip'	=>	'olpay_descrip',
		'uid'		=>	$rt['uid'],
		'username'	=>	$rt['username'],
		'ip'		=>	$onlineip,
		'time'		=>	$timestamp,
		'number'	=>	$number,
		'currency'	=>	$currency,
	);
	writetoollog($logdata);
	require_once(R_P.'require/msg.php');
	$message=array(
		$rt['username'],
		'',
		'olpay_title',
		$timestamp,
		"olpay_content_2",
		'',
		'SYSTEM'
	);
	writenewmsg($message,1);
	$statdb=array(
		'type' =>'alipay',
		'seller_email' => $_GET['seller_email'],
		'buyer_email' => $_GET['buyer_email'],
		'trade_no' => $_GET['trade_no'],
		'total_fee' => $_GET['total_fee'],
		'siteurl' => $db_bbsurl,
	);
	$getdb='';
	foreach($statdb as $key=>$value){
		$getdb .= $key."=".urlencode($value)."&";
	}
	get_verify("http://www.phpwind.com/pay/stats.php?$getdb");
	refreshto('userpay.php','充值成功！');
}else{
	refreshto('userpay.php','支付失败，无法完成充值！');
}
function pw_msg($msg,$t=''){
	global $action,$msg_id;
	echo $msg;
	exit;
}
function get_verify($url,$time_out='60'){
	$urlarr= parse_url($url);
	$errno = $errstr = '';
	$urlarr['port'] = '80';
	$fp=@fsockopen('tcp://'.$urlarr['host'],$urlarr['port'],$errno,$errstr,$time_out);
	if(!$fp){
		die("ERROR: $errno - $errstr<br />\n");
	} else{
		fputs($fp, 'POST '.$urlarr['path']." HTTP/1.1\r\n");
		fputs($fp, 'Host: '.$urlarr['host']."\r\n");
		fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fp, 'Content-length: '.strlen($urlarr['query'])."\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $urlarr['query'] . "\r\n\r\n");
		while(!feof($fp)) {
			$info[]=@fgets($fp, 1024);
		}
		fclose($fp);
		$info = implode(',',$info);
		return $info;
	}
}
?>