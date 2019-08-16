<?php
$appid = "wxe25acb409023022b";
$appsecret = "9aeadcac2a95f7b5955126bf602a353c";
$url = "https://api.weixin.qq.com/cgi-btn/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$info = json_decode($output, true);
var_dump($info);
?>