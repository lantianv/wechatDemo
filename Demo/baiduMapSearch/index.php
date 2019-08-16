<?php
define("TOKEN", "chenlinweixin");

$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}
class wechatCallbackapiTest
{
    //验证签名
    public function valid()
    {
        $echoStr = $_GET["echostr"];
		if ($this->checkSignature()) {
			echo $echoStr;
			exit;
		}
    }
	
	//签名校验实现
	private function checkSignature()
	{
		$signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
		
		$token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
		
		sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
		
        if($tmpStr == $signature){
			return true;
        }else {
			return false;
		}
	}
	
	//响应消息
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
             
            //消息类型分离
            switch ($RX_TYPE)
            {           
                case "text":            
                    $resultStr = $this->receiveText($postObj);
                    break;
                case "event":           
                    $resultStr = $this->receiveEvent($postObj);
                    break;
				case "location":
				    $resultStr = $this->receiveLocation($postObj);
                    break;
            }
            $this->logger("T".$resultStr);
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

   //处理接受事件
	private function receiveEvent($object) {
		$contentStr = "";
		switch ($object->Event) {
			case "subscribe":
			    $contentStr = "欢迎关注蓝图之约!";
			case "unsubscribe":
			    break;
            case "CLICK":
			    switch ($object->EventKey)
				{
					case "jgjyclass":
					  $contentStr[] = array("Title"=>"课堂简介",
					  "Description"=>"军哥在线教育培训",
					  "PicUrl"=>"http://img2.imgtn.bdimg.com/it/u=1451330793,2242997567&fm=26&gp=0.jpg",
					  "Url"=>"http://www.chuanke.com/s4098217.html");
					  break;
					case "jgtj":
					  $contentStr[] = array("Title"=>"军哥推荐",
					  "Description"=>"军哥在线教育培训",
					  "PicUrl"=>"http://img2.imgtn.bdimg.com/it/u=1451330793,2242997567&fm=26&gp=0.jpg",
					  "Url"=>"http://www.chuanke.com/s4098217.html");
					  break;
					default:
					  $contentStr[] = array("Title"=>"默认菜单回复",
					  "Description"=>"您正访问军哥在线教育培训网",
					  "PicUrl"=>"http://img2.imgtn.bdimg.com/it/u=1451330793,2242997567&fm=26&gp=0.jpg",
					  "Url"=>"http://www.chuanke.com/s4098217.html");
					  break;
				}
				break;
		}
		if (is_array($contentStr)) {
			$resultStr = $this->transmitNews($object,$contentStr);
		}else {
			$resultStr = $this->transmitText($object,$contentStr);
		}
		return $resultStr;
	}
	
	//接收文本消息
    private function receiveText($object) {
        $keyword = trim($object->Content);
		$category = substr($keyword,0,6);
		$entity = trim(substr($keyword,6,strlen($keyword)));
		switch($category)
		{
			case "附近":
			  include("location.php");
			  $location = getLocation($object->FromUserName);
			  if (is_array($location)) {
				  include("mapbaidu.php");
				  $content = catchEntitiesFromLocation($entity,$location['locationX'],$location['locationY'],"5000");
			  }else {
				  $content = $location;
			  }
			  break;
			default:
			  $content = $object->FromUserName;
			  break;
		}
		if (is_array($content)) {
			$result = $this->transmitNews($object,$content);
		}else {
			$result = $this->transmitText($object,$content);
		}
		return $result;
    }
	
	//接收位置消息
	private function receiveLocation($object) {
		include("location.php");
		$content = setLocation($object->FromUserName,(string)$object->Location_X,(string)$object->Location_Y);
		$result = $this->transmitText($object,$content);
		return $result;
	}
	
	//回复文本消息
    private function transmitText($object,$content)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $resultStr;
    } 
	
	private function transmitNews($object,$arr_item){
		if (!is_array($arr_item))
			return;
		$itemTpl="<item>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>
		";
		$item_str = "";
		foreach ($arr_item as $item) 
			$item_str = sprintf($itemTpl,$item['Title'],$item['Description'],$item['PicUrl'],$item['Url']);
		$newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>1</ArticleCount>
<Articles>$item_str</Articles>
</xml>";
        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
        return $resultStr;		
    }
	
	//debug函数
	private function logger($log_content) {
		if (isset($_SERVER['HTTP_BAE_ENV_APPID'])) {
			require_once "BaeLog.class.php";
			$logger = BaeLog::getInstance();
			$logger->logDebug($log_content);
		}else if (isset($_SERVER['HTTP_APPNAME'])) {
			sae_set_display_errors(false);
			sae_debug($log_content);
			sae_set_display_errors(true);
		}else if ($_SERVER['REMOTE_ADDR']!="127.0.0.1") {
			$max_size = 10000;
			$log_filename = "log.xml";
			if (file_exists($log_filename) and (abs(filesize($log_filename))> $max_size)) {
				unlink($log_filename);
			}
			file_put_contents($log_filename,date('H:i:s')."".$log_content."\r\n",FILE_APPEND);
		}
	}
}
?>