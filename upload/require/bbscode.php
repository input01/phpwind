<?php
!function_exists('readover') && exit('Forbidden');
function convert($message,$allow,$type="post"){
	global $attachper,$code_num,$code_htm,$phpcode_htm,$foruminfo,$picpath,$imgpath,$stylepath,$attachname,$attachpath,$admincheck,$tpc_author,$tpc_buy,$db_cvtimes,$forumset;
	
	$code_num = 0;
	$code_htm = array();
	if(strpos($message,"[code]") !== false && strpos($message,"[/code]") !== false){
		$message=preg_replace("/\[code\](.+?)\[\/code\]/eis","phpcode('\\1')",$message,$db_cvtimes);
	}
	if(strpos($message,"[payto]") !== false && strpos($message,"[/payto]") !== false){
		require_once(R_P.'require/paytofunc.php');
		$message=preg_replace("/\[payto\](.+?)\[\/payto\]/eis","payto('\\1')",$message);
	}
	$message = preg_replace('/\[list=([aA1]?)\](.+?)\[\/list\]/is', "<ol type=\"\\1\" style=\"margin:0 0 0 25px\">\\2</ol>", $message);
	
	$searcharray = array('[u]','[/u]','[b]','[/b]','[i]','[/i]','[list]','[li]','[/li]','[/list]','[sub]',
		'[/sub]','[sup]','[/sup]','[strike]','[/strike]','[blockquote]','[/blockquote]','[hr]','[/backcolor]',
		'[/color]','[/font]','[/size]','[/align]'
	);
	$replacearray = array('<u>','</u>','<b>','</b>','<i>','</i>','<ul style="margin:0 0 0 15px">','<li>','</li>', 	'</ul>','<sub>','</sub>','<sup>','</sup>','<strike>','</strike>','<blockquote>','</blockquote>','<hr />',
		'</span>','</span>','</span>','</font>','</div>',
	);
	$message = str_replace($searcharray,$replacearray,$message);

	$message = str_replace("p_w_upload",$attachname,$message);//此处位置不可调换
	$message = str_replace("p_w_picpath",$picpath,$message);//此处位置不可调换

	$searcharray = array(
		"/\[font=([^\[\(]+?)\]/is",
		"/\[color=([#0-9a-z]{1,10})\]/is",
		"/\[backcolor=([#0-9a-z]{1,10})\]/is",
		"/\[email=([^\[]*)\]([^\[]*)\[\/email\]/is",
	    "/\[email\]([^\[]*)\[\/email\]/is",
		"/\[size=(\d+)\]/eis",
		"/\[align=(left|center|right|justify)\]/is",
		"/\[glow=(\d+)\,([0-9a-zA-Z]+?)\,(\d+)\](.+?)\[\/glow\]/is"
	);
	$replacearray = array(
		"<span style=\"font-family:\\1\">",
		"<span style=\"color:\\1\">",
		"<span style=\"background-color:\\1\">",
		"<a href=\"mailto:\\1\">\\2</a>",
		"<a href=\"mailto:\\1\">\\1</a>",
		"size('\\1','$allow[size]')",
		"<div align=\"\\1\">",
		"<div style=\"width:\\1px;filter:glow(color=\\2,strength=\\3);\">\\4</div>"
	);
	$message = preg_replace($searcharray,$replacearray,$message);

	if($allow['pic']){
		$message = preg_replace("/\[img\](.+?)\[\/img\]/eis","cvpic('\\1','','$allow[picwidth]','$allow[picheight]')",$message,$db_cvtimes);
    } else{
		$message = preg_replace("/\[img\](.+?)\[\/img\]/eis","nopic('\\1')",$message,$db_cvtimes);
	}

	if(strpos($message,'[/URL]')!==false || strpos($message,'[/url]')!==false){
		$searcharray = array(
			"/\[url=(https?|ftp|gopher|news|telnet|mms|rtsp)([^\[\s]+?)\](.+?)\[\/url\]/eis",			
			"/\[url\]www\.([^\[]+?)\[\/url\]/eis",
			"/\[url\](https?|ftp|gopher|news|telnet|mms|rtsp)([^\[]+?)\[\/url\]/eis"
		);
		$replacearray = array(
			"cvurl('\\1','\\2','\\3')",
			"cvurl('\\1')",
			"cvurl('\\1','\\2')",
		);
		$message = preg_replace($searcharray,$replacearray,$message);
	}

	$searcharray = array(
		"/\[fly\]([^\[]*)\[\/fly\]/is",
		"/\[move\]([^\[]*)\[\/move\]/is",
	);
	$replacearray = array(
		"<marquee width=90% behavior=alternate scrollamount=3>\\1</marquee>",
		"<marquee scrollamount=3>\\1</marquee>",
	);
	$message = preg_replace($searcharray,$replacearray,$message);

	if($type=="post"){
		if($foruminfo['allowhide'] && strpos($message,"[post]") !== false && strpos($message,"[/post]") !== false){
			$message=preg_replace("/\[post\](.+?)\[\/post\]/eis","post('\\1')",$message);
		}
		if($foruminfo['allowencode'] && strpos($message,"[hide") !== false && strpos($message,"[/hide]")!==false){
			$message=preg_replace("/\[hide=(.+?)\](.+?)\[\/hide\]/eis","hiden('\\1','\\2')",$message);
		}
		if($foruminfo['allowsell'] && strpos($message,"[sell") !== false && strpos($message,"[/sell]") !== false){
			$message=preg_replace("/\[sell=(.+?)\](.+?)\[\/sell\]/eis","sell('\\1','\\2')",$message);
		}
	}
	if(strpos($message,"[quote]") !== false && strpos($message,"[/quote]") !== false){
		$message=preg_replace("/\[quote\](.+?)\[\/quote\]/eis","qoute('\\1')",$message);
	}
	if(is_array($code_htm)){
		krsort($code_htm);
		foreach($code_htm as $codehtm){
			foreach($codehtm as $key=>$value){
				$message=str_replace("<\twind_code_$key\t>",$value,$message);
			}
		}
	}
	if($allow['flash']){
        $message = preg_replace("/(\[flash=)(\d+?)(\,)(\d+?)(\])(.+?)(\[\/flash\])/is","<OBJECT CLASSID=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" WIDTH=\\2 HEIGHT=\\4><PARAM NAME=MOVIE VALUE=\\6><PARAM NAME=PLAY VALUE=TRUE><PARAM NAME=LOOP VALUE=TRUE><PARAM NAME=QUALITY VALUE=HIGH><EMBED SRC=\\6 WIDTH=\\2 HEIGHT=\\4 PLAY=TRUE LOOP=TRUE QUALITY=HIGH></EMBED></OBJECT><br />[<a target=_blank href=\\6>Full Screen</a>] ",$message,$db_cvtimes);
	} else{
		$message = preg_replace("/(\[flash=)(\d+?)(\,)(\d+?)(\])(.+?)(\[\/flash\])/is","<img src='$imgpath/$stylepath/file/music.gif' align='absbottom'> <a target=_blank href=\\6>flash: \\6</a>",$message,$db_cvtimes);
	}
	if($type=="post"){
		$t = 0;
		while(strpos($message,"[table") !== false && strpos($message,"[/table]") !== false){
			$message = preg_replace('/\[table(=(\d{1,3}(%|px)?))?\](.*?)\[\/table\]/eis', "tablefun('\\2','\\3','\\4')",$message);
			if(++$t>4) break;
		}
		if($allow['mpeg']){
			$message = preg_replace(
				array(
					"/\[wmv=(0|1)\](.+?)\[\/wmv\]/eis",
					"/\[wmv(=([0-9]{1,3})\,([0-9]{1,3})\,(0|1))?\](.+?)\[\/wmv\]/eis",
					"/\[rm(=([0-9]{1,3})\,([0-9]{1,3})\,(0|1))?\](.+?)\[\/rm\]/eis"
				),
				array(
					"wmvplayer('\\2','314','53','\\1')",
					"wmvplayer('\\5','\\2','\\3','\\4')",
					"rmplayer('\\5','\\2','\\3','\\4')"
				),$message,$db_cvtimes
			);
		} else {
			$message = preg_replace(
				array(
					"/\[wmv=[01]{1}\](.+?)\[\/wmv\]/is",
					"/\[wmv(?:=[0-9]{1,3}\,[0-9]{1,3}\,[01]{1})?\](.+?)\[\/wmv\]/is",
					"/\[rm(?:=[0-9]{1,3}\,[0-9]{1,3}\,[01]{1})\](.+?)\[\/rm\]/is"
				),
				"<img src=\"$imgpath/$stylepath/file/music.gif\" align=\"absbottom\"> <a target=\"_blank\" href=\"\\1\">\\1</a>",$message,$db_cvtimes
			);
		}
		if($allow['iframe']){
			$message = preg_replace("/\[iframe\](.+?)\[\/iframe\]/is","<IFRAME SRC=\\1 FRAMEBORDER=0 ALLOWTRANSPARENCY=true SCROLLING=YES WIDTH=97% HEIGHT=340></IFRAME>",$message,$db_cvtimes);
		} else{
			$message = preg_replace("/\[iframe\](.+?)\[\/iframe\]/is","Iframe Close: <a target=_blank href='\\1'>\\1</a>",$message,$db_cvtimes);
		}
	}
	if(is_array($phpcode_htm)){
		foreach($phpcode_htm as $key=>$value){
			$message=str_replace("<\twind_phpcode_$key\t>",$value,$message);
		}
	}
	return $message;
}
function postcache($key,$type){
	if($type==1){
		global $face,$imgpath;
		return "<img src=\"$imgpath/post/smile/{$face[$key]}\" />";
	} elseif($type==2){
		global $act,$motion,$imgpath;
		return "<br />$act {$motion[$key][1]}<br /><img src=$imgpath/post/act/{$motion[$key][2]} /><br />";
	}
}
function copyctrl(){
	$lenth=10;
	mt_srand((double)microtime() * 1000000);
	for($i=0;$i<$lenth;$i++){
		$randval.=chr(mt_rand(0,126));
	}
	$randval=str_replace('<','&lt;',$randval);
	return "<span style=\"display:none\"> $randval </span>&nbsp;<br />";
}
function attachment($message){
	global $attachper,$db_cvtimes;

	$attachper && $message=preg_replace("/\[attachment=([0-9]+)\]/eis","upload('\\1')",$message,$db_cvtimes);
	return $message;
}
function upload($aid){
	global $attachments,$aids;

	if($attachments[$aid]){
		$aids[]=$aid;
		return $attachments[$aid];
	} else{
		return "[attachment=$aid]";
	}
}
function tablefun($width,$unit,$text){
	global $tdcolor,$td_htm,$td_num;
	if($width){
		$unit !='%' && $unit = 'px';
		$width = $unit == 'px' ? ($width < 600 ? (int)$width : 600).'px' : ($width < 98 ? (int)$width : 98).'%';
	} else{
		$width = '98%';
	}
	$text = preg_replace(
		array(
			'/(\[\/td\]\s*)?\[\/tr\]/is',
			'/\[(tr|\/td)\]\s*\[td(=(\d{1,2}),(\d{1,2})(,(\d{1,3}%?))?)?\]/eis',
			'/\[tr\]/is',
		),
		array('</td></tr>',"tdfun('\\1','\\3','\\4','\\6')",'<tr class="tr3"><td>'),
		str_replace('\\"','"',$text)
	);
	return "<table style=\"border:1px solid $tdcolor;width:$width\">$text</table>";
}
function tdfun($t,$col,$row,$width){
	return ($t == 'tr' ? '<tr class="tr3">' : '</td>').(($col && $row) ? "<td colspan=\"$col\" rowspan=\"$row\" width=\"$width\">" : "<td>");
}
function size($size,$allowsize){
	$allowsize && $size > $allowsize && $size = $allowsize;
	return "<font size=\"$size\">";
}
function cvurl($http,$url='',$name=''){
	global $code_num,$code_htm;
	$code_num++;
	if(!$url){
		$url="<a href=\"http://www.$http\" target=\"_blank\">www.$http</a>";
	} elseif(!$name){
		$url="<a href=\"$http$url\" target=\"_blank\">$http$url</a>";
	} else{
		$url="<a href=\"$http$url\" target=\"_blank\">".str_replace('\\"','"',$name)."</a>";
	}
	$code_htm[0][$code_num]=$url;
	return "<\twind_code_$code_num\t>";
}

function nopic($url){
	global $code_num,$code_htm,$imgpath,$stylepath;
	$code_num++;
	$code_htm[-1][$code_num]="<img src=\"$imgpath/$stylepath/file/img.gif\" align=\"absbottom\" border=\"0\"> <a target=\"_blank\" href=\"$url\">img: $url</a>";
	return "<\twind_code_$code_num\t>";
}

function cvpic($url,$type='',$picwidth='',$picheight=''){
	global $db_bbsurl,$picpath,$attachpath,$code_num,$code_htm;
	$code_num++;

	$lower_url=strtolower($url);
	if(substr($lower_url,0,4)!='http')$url="$db_bbsurl/$url";
	if(strpos($lower_url,'login')!==false && (strpos($lower_url,'action=quit')!==false || strpos($lower_url,'action-quit')!==false)){
		$url=preg_replace('/login/i','log in',$url);
	}
	if($picwidth || $picheight){
		$onload = "onload=\"";
		$picwidth  && $onload .= "if(this.width>'$picwidth')this.width='$picwidth';";
		$picheight && $onload .= "if(this.height>'$picheight')this.height='$picheight';";
		$onload .= "\"";
		$code="<img src=\"$url\" border=\"0\" onclick=\"if(this.width>=$picwidth) window.open('$url');\" $onload>";
	} else{
		$code="<img src=\"$url\" border=\"0\" onclick=\"if(this.width>screen.width-461) window.open('$url');\">";
	}
	$code_htm[-1][$code_num]=$code;

	if($type){
		return $code;
	} else{
		return "<\twind_code_$code_num\t>";
	}
}

function phpcode($code){
	global $phpcode_htm,$codeid;
	$code = str_replace(array("[attachment=",'\\"'),array("&#91;attachment=",'"'),$code);
	$codeid ++;
	$phpcode_htm[$codeid]="<h6 class=\"quote\"><a href=\"javascript:\"  onclick=\"CopyCode(document.getElementById('code$codeid'));\">Copy code</a></h6><blockquote id=\"code$codeid\">".preg_replace("/^(\<br \/\>)?(.*)/is","\\2",$code)."</blockquote>";

	return "<\twind_phpcode_$codeid\t>";
}

function qoute($code){
	global $code_num,$code_htm,$i_table;
	$code_num++;
	$code_htm[6][$code_num]="<h6 class=\"quote\">Quote:</h6><blockquote>".str_replace('\\"','"',$code)."</blockquote>";
	return "<\twind_code_$code_num\t>";
}

function post($code){
	global $SYSTEM,$postcode1,$postcode2,$attachper,$db,$tid,$fid,$winduid,$windid,$admincheck,$tpc_author;
	global $code_num,$code_htm,$lang,$tpc_ifview;
	require_once GetLang('bbscode');
	$code_num++;
	$attachper=0;

	if(!$tpc_ifview){
		if($admincheck==1 || $SYSTEM['viewhide'] || $tpc_author==$windid){
			$tpc_ifview=1;
		} else{
			$pw_posts = GetPtable($GLOBALS['ptable']);
			$rs = $db->get_one("SELECT count(*) AS count FROM $pw_posts WHERE tid='$tid' AND authorid='$winduid'");
			$tpc_ifview = $rs['count']>0 ? 1 : 2;
		}
	}
	if($tpc_ifview == 1){
		$attachper=1;
		$code_htm[3][$code_num]="<h6 class=\"quote\"><span class=\"s3 f12 fn\">$lang[bbcode_hide1]</span></h6><blockquote>".str_replace('\\"','"',$code)."</blockquote>";
	} else{
		$code_htm[3][$code_num]="<blockquote>$lang[bbcode_hide2]</blockquote>";
	}
	return "<\twind_code_$code_num\t>";
}

function hiden($rvrc,$code){
	global $hidecode1,$hidecode2,$hidecode3,$db,$groupid,$attachper,$userrvrc,$i_table;
	global $code_num,$code_htm,$lang;
	require_once GetLang('bbscode');
	$code_num++;
	$attachper=0;
	if($groupid!='guest'){
		global $admincheck,$userrvrc,$userpath,$windid,$tpc_author,$SYSTEM;
		$rvrc=intval(trim(stripslashes($rvrc)));
		if($windid!=$tpc_author && $userrvrc<$rvrc && $admincheck!=1 && !$SYSTEM['viewhide']){
			$code="<blockquote>{$lang[bbcode_encode1]}{$rvrc}</blockquote>";
		} else {
			$attachper=1;
			$code="<h6 class=\"quote\"><span class=\"s3 f12 fn\">{$lang[bbcode_encode2]}</span></h6><blockquote>".str_replace('\\"','"',$code)."</blockquote>";
		}
	} else{
		$code="<blockquote>".$lang['bbcode_encode3']."</blockquote>";
	}
	$code_htm[4][$code_num]=$code;
	return "<\twind_code_$code_num\t>";
}

function sell($moneycost,$code){
	global $SYSTEM,$admincheck,$attachper,$windid,$tpc_author,$tpc_buy,$tpc_pid,$fid,$tid,$i_table,$groupid,$code_num,$code_htm,$lang,$db_credits,$db_bbsurl;
	list($db_moneyname,,,,,)=explode("\t",$db_credits);
	require_once GetLang('bbscode');
	$code_num++;
	$sellcheck = $attachper=0;
	$moneycost = (int)$moneycost;
	if($moneycost < 0){
		$moneycost = 0;
	}elseif($moneycost > 1000){
		$moneycost = 1000;
	}elseif($moneycost && !ereg("^[0-9]{0,}$",$moneycost)){
		$moneycost = 0;
	}
	$userarray=explode(',',$tpc_buy);
	$count=0;
	foreach($userarray as $value){
		if($value){
			$count++;
			$buyers.="<option value=''>".$value."</option>";
		}
	}
	if($groupid!='guest' && ($SYSTEM['viewhide'] || $admincheck || $tpc_author==$windid || ($userarray && @in_array($windid,$userarray)))){
		$attachper=$sellcheck=1;
	}
	$bbcode_sell_info=str_replace(array('$moneycost','$db_moneyname','$count'),array($moneycost,$db_moneyname,$count),$lang['bbcode_sell_info']);
	if($sellcheck==1){
		$printcode="<h6 class=\"quote\"><span class=\"s3 f12 fn\">{$bbcode_sell_info}</span> <select name=\"buyers\"><option>{$lang[bbcode_sell_buy]}</option>$buyers</select></h6><blockquote>".str_replace('\\"','"',$code)."</blockquote>";
	} else{
		$printcode="<h6 class=\"quote\"><span class=\"s3\">{$bbcode_sell_info}</span> <select name=\"buyers\"><option value=''>{$lang[bbcode_sell_buy]}</option><option value=>-----------</option>$buyers</select> <input type=\"button\" value=\"{$lang[bbcode_sell_submit]}\" class=\"btn\" onclick=location.href=\"job.php?action=buytopic&tid=$tid&pid=$tpc_pid\" style=\"line-height:100%\"></h6><blockquote> {$lang[bbcode_sell_notice]}</blockquote>";
	}
	$code_htm[5][$code_num]=$printcode;
	return "<\twind_code_$code_num\t>";
}

function shield($code){
	global $lang,$attachper,$groupid;
	require_once GetLang('bbscode');
	$lang[$code] && $code = $lang[$code];
	$groupid != 3 && $attachper = 0;
	return "<span style=\"color:black;background-color:#ffff66\">$code</span>";
}

function showfacedesign($usericon){
	$user_a=explode('|',$usericon);
	if(strpos($usericon,'<')!==false || empty($user_a[0]) && empty($user_a[1])){
		return '<br /><br />';
	}
	global $imgpath,$attachpath,$attachdir,$db_ftpweb;
	if($user_a[1]){
		if(!ereg("^http",$user_a[1])){
			if($db_ftpweb && !file_exists($attachdir.'/upload/'.$user_a[1])){
				$user_a[1] = $db_ftpweb.'/upload/'.$user_a[1];
			} else{
				$user_a[1] = $attachpath.'/upload/'.$user_a[1];
			}
		}
		return "<img src=\"$user_a[1]\"".($user_a[2] ? " width=\"$user_a[2]\"" : '').($user_a[3] ? " height=\"$user_a[3]\"" : '')." border=\"0\" />";
	} else{
		return "<img src=\"$imgpath/face/$user_a[0]\" border=\"0\" />";
	}
}

function wmvplayer($wmvurl,$width='',$height='',$auto=''){
    return "<div><EMBED src=\"$wmvurl\" HEIGHT=\"".($height ? $height : 256)."\" WIDTH=\"".($width ? $width : 314)."\" AutoStart=\"$auto\" ShowStatusBar=\"1\"></EMBED></div>";
}

function rmplayer($rmurl,$width='',$height='',$auto=''){
	global $lang;
	require_once GetLang('bbscode');
	!$width && $width = 316;
	!$height && $height = 241;
	return "<object classid=clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA height=\"$height\" id=Player width=\"$width\" VIEWASTEXT><param name=\"_ExtentX\" value=\"12726\"><param name=\"_ExtentY\" value=\"8520\"><param name=\"AUTOSTART\" value=\"0\"><param name=\"SHUFFLE\" value=\"0\"><param name=\"PREFETCH\" value=\"0\"><param name=\"NOLABELS\" value=\"0\"><param name=\"CONTROLS\" value=\"ImageWindow\"><param name=\"CONSOLE\" value=\"_master\"><param name=\"LOOP\" value=\"0\"><param name=\"NUMLOOP\" value=\"0\"><param name=\"CENTER\" value=\"0\"><param name=\"MAINTAINASPECT\" value=\"$rmurl\"><param name=\"BACKGROUNDCOLOR\" value=\"#000000\"></object><br><object classid=clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA height=32 id=Player2 width=\"$width\" VIEWASTEXT><param name=\"_ExtentX\" value=\"18256\"><param name=\"_ExtentY\" value=\"794\"><param name=\"AUTOSTART\" value=\"$auto\"><param name=\"SHUFFLE\" value=\"0\"><param name=\"PREFETCH\" value=\"0\"><param name=\"NOLABELS\" value=\"0\"><param name=\"CONTROLS\" value=\"controlpanel\"><param name=\"CONSOLE\" value=\"_master\"><param name=\"LOOP\" value=\"0\"><param name=\"NUMLOOP\" value=\"0\"><param name=\"CENTER\" value=\"0\"><param name=\"MAINTAINASPECT\" value=\"0\"><param name=\"BACKGROUNDCOLOR\" value=\"#000000\"><param name=\"SRC\" value=\"$rmurl\"></object><br><script language=javascript>function FullScreen(){document.Player.SetFullScreen();}</script><input type='button' onclick='javascript:FullScreen()' value='$lang[full_screen]'>";
}
function showface($message){
	global $face,$motion,$act,$faces,$db_cvtimes,$tpc_author;
	include_once(D_P.'data/bbscache/postcache.php');
	$message = preg_replace("/\[s:(.+?)\]/eis","postcache('\\1','1')",$message,$db_cvtimes);
	$act = "<font color=red><b>[$tpc_author]</b></font>";
	$message = preg_replace("/\[p:(.+?)\]/eis","postcache('\\1','2')",$message,$db_cvtimes);
	return $message;
}
function wordsfb($message,$update='N'){
	global $wordsfb,$replace;
	include_once(D_P."data/bbscache/wordsfb.php");
	$replacedb = $wordsfb + $replace;
	$msg = $message;
	if($replacedb){
		foreach($replacedb as $key => $value){
			$msg = preg_replace("/$key/i",$value,$msg);
		}
	}
	if(is_numeric($update) && ($update>0 || $msg == $message)){
		global $db,$tpc_pid,$tid,$pw_tmsgs,$pw_posts,$db_wordsfb;
		$ifwordsfb = $msg == $message ? $db_wordsfb : 0;
		if(is_numeric($tpc_pid)){
			$db->update("UPDATE $pw_posts SET ifwordsfb='$ifwordsfb' WHERE pid='$tpc_pid'");
		} elseif($tpc_pid == 'tpc'){
			$db->update("UPDATE $pw_tmsgs SET ifwordsfb='$ifwordsfb' WHERE tid='$tid'");
		}
	}
	return $msg;
}
?>