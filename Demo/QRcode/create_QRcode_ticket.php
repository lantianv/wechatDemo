<?php
$access_token="22__sLqluJK5C24MJ7SW5Lo3aDm7nlaP-hHNnm9pvdiiQV3pChLqLVs3qYxP-SYuC825NXJU92OL0YKnNqytXoCsqLj420VdEQmprbgwC5mmdVnCn0f4inq0DsblsyiO03Suo5pvT7f3g6Yk9lHAPKaAIAJYT";
//临时二维码
//$qrcode='{
//    "expire_seconds": 604800,
//    "action_name": "QR_SCENE", 
//    "action_info": {
//        "scene": {
//            "scene_id": 1640128342
//        }
//    }
//}';
//永久二维码
$qrcode='{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "chenlin"}}}';
$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
$result = https_request($url,$qrcode);
var_dump($result);
$jsoninfo = json_decode($result,true);
$ticket = $jsoninfo["ticket"];
var_dump($ticket);

function https_request($url,$data=null) {
	$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)) {
		curl_setopt($curl,CURLOPT_POST,1);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
	}
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
	var_dump($output);
    curl_close($curl);
	return $output;
}