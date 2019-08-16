<?php
//$redirect_url = "http://charlie.applinzi.com/OAuth2.0/oauth2_openid.php";
$code = $_GET['code'];
//var_dump($code);
$userinfo = getUserInfo($code);
function getUserInfo($code) {
	$appid = "wxe25acb409023022b";
	$appsecret = "9aeadcac2a95f7b5955126bf602a353c";
	//oauth2的方式获取openid
	$access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
	$access_token_json = https_request($access_token_url);
	$access_token_array = json_decode($access_token_json,true);
	$openid = $access_token_array['openid'];
	//非oauth2的方式获取全局的access_token
	$new_access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
	$new_access_token_json = https_request($new_access_token_url);
	$new_access_token_array = json_decode($new_access_token_json,true);
	$new_access_token = $new_access_token_array['access_token'];
	//全局access_token获取用户基本信息
	$userinfo_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$new_access_token&openid=$openid";
	$userinfo_json = https_request($userinfo_url);
	$userinfo_array = json_decode($userinfo_json,true);
	return $userinfo_array;
}

function https_request($url) {
	$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	if (curl_errno($curl)) {
		return 'ERROR'.curl_error($curl);
	}
    curl_close($curl);
	return $data;
}
?>
<html>
    <head>
        <title>微信号个人信息</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
		<link rel="stylesheet" href="../../style/weui.css"/>
        <script src='../js/jquery-1.9.0.js'></script>
    </head>
<body>
<div class="page">
    <div class="page__hd">
       <div class='logo' style="height:80px;background-image:url(../../images/logo.jpg);background-size:contain;background-repeat:no-repeat;border: 5px; solid blue">
       </div>
    </div>
    <div class="page__bd">
        <div class="weui-cells">
            
            <div class='weui-cell'>
                <div class="weui-cell__bd weui-cell_primary">  
                    <p>头像</p>
                </div>
                <div class="weui-cell_ft">  
                    <img src="<?php echo str_replace("/0","/26",$userinfo['headimgurl']);?>">
                </div>
            </div>
            <div class='weui-cell'>
                <div class="weui-cell__bd weui-cell_primary">  
                    <p>openID</p>
                </div>
                <div class="weui-cell_ft">  
                    <?php echo $userinfo['openid'];?>
                </div>
            </div>
            
            <div class='weui-cell'>
                <div class="weui-cell__bd weui-cell_primary">  
                    <p>昵称</p>
                </div>
                <div class="weui-cell_ft">  
                    <?php echo $userinfo['nickname'];?>
                </div>
            </div>
            <div class='weui-cell'>
                <div class="weui-cell__bd weui-cell_primary">  
                    <p>性别</p>
                </div>
                <div class="weui-cell_ft">  
                    <?php echo (($userinfo['sex'] == 0)?"未知":(($userinfo['sex']==1)?"男":"女"));?>
                </div>
            </div>
            <div class='weui-cell'>
                <div class="weui-cell__bd weui-cell_primary">  
                    <p>地区</p>
                </div>
                <div class="weui-cell_ft">  
                    <?php echo $userinfo['country'];?> <?php echo $userinfo['province'];?> <?php echo $userinfo['city'];?>
                </div>
            </div>
            <div class='weui-cell'>
                <div class="weui-cell__bd weui-cell_primary">  
                    <p>语言</p>
                </div>
                <div class="weui-cell_ft">  
                    <?php echo $userinfo['language'];?>
                </div>
            </div>
        
        </div>
    </div>
    <div class="weui-footer">
         <p class="weui-footer__text" style="margin-top:20px;">Copyright &copy; 2019 新生自助报到系统</p>
    </div>
</div>

<script type="text/javascript">
   
</script>
</body>
</html>