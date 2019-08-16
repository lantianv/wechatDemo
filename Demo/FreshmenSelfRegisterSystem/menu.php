<?php
$appid = "wxe25acb409023022b";
$appsecret = "9aeadcac2a95f7b5955126bf602a353c";
//非oauth2的方式获取全局的access_token
$access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$access_token_json = https_request($access_token_url,null);
$access_token_array = json_decode($access_token_json,true);
$access_token = $access_token_array['access_token'];
$jsonmenu = '{
	"button": [
	    {
			"name": "自助报道",
		    "sub_button": [
		         {
					 "type": "view",
					 "name": "个人信息采集",
					 "url": "http://charlie.applinzi.com/FreshmenSelfRegisterSystem/index_getPersonalInformation.php"
				 },
				 {
					 "type": "view",
					 "name": "在线缴费",
					 "url": "http://charlie.applinzi.com/FreshmenSelfRegisterSystem/index_getPersonalInformation.php"
				 },
				 {
					 "type": "view",
					 "name": "在线办理一卡通",
					 "url": "http://charlie.applinzi.com/FreshmenSelfRegisterSystem/index_getPersonalInformation.php"
				 },
				 {
					 "type": "view",
					 "name": "在线申请宿舍",
					 "url": "http://charlie.applinzi.com/FreshmenSelfRegisterSystem/index_getPersonalInformation.php"
				 },
				 {
					 "type": "view",
					 "name": "报道接站",
					 "url": "http://charlie.applinzi.com/FreshmenSelfRegisterSystem/index_getPersonalInformation.php"
				 }
		    ]
	    },
		{
			"name": "迎新管理",
		    "sub_button": [
		         {
					 "type": "click",
					 "name": "报道规则",
					 "key": "rule"
				 },
				 {
					 "type": "click",
					 "name": "交通指引",
					 "key": "traffic"
				 },
				 {
					 "type": "click",
					 "name": "志愿者信息",
					 "key": "volunteer"
				 },
				 {
					 "type": "click",
					 "name": "系部咨询位置",
					 "key": "location"
				 }
		    ]
	    }
	]
}';

$url = "https://api.weixin.qq.com/cgi-btn/menu/create?access_token=$access_token";
$result = https_request($url,$data=$jsonmenu);
var_dump($result);

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
    curl_close($curl);
	return $output;
}
?>