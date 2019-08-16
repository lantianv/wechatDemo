<?php
//缓存用户地理位置信息
function setLocation($openid,$locationX,$locationY) {
	$mmc = memcache_init();
	if ($mmc == true) {
		$location = array("locationX"=>$locationX,"locationY"=>$locationY);
		memcache_set($mmc,$openid,json_encode($location),60);
		return "您的位置已缓存。\n现在可发送”附近“加目标的命令，如”附近酒店“、”附近银行“等。";
	}
	else {
		return "服务器未启用缓存，请先开启缓存功能。";
	}
}

//从缓存中获取用户地理位置信息
function getLocation($openid) {
	$mmc = memcache_init();
	if ($mmc == true) {
		$location = memcache_get($mmc,$openid);
		if (!empty($location)) {
			return json_decode($location,true);
		}
		else {
			return "请先发送位置给我！\n点击底部的‘+’号，再选择‘位置’，等地图显示出来以后，点击‘发送’";
		}
	}
	else {
		return "服务器未启用缓存，请先开启缓存功能。";
	}
}
?>