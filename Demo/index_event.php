<?php
/*
    CopyRight 2019 All Rights Reserved
*/

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
                default:
                    $resultStr = "";
                    break;
            }        
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }
    
    //接收文本消息
    private function receiveText($object)
    {
        $funcFiag = 0;
        $content = "你发送的是文本，内容为：".$object->Content;
		$resultStr = $this->transmitText($object,$content,$funcFlag);
        return $resultStr;
    }

   //处理接受事件
	private function receiveEvent($object) {
		$contentStr = "";
		switch ($object->Event) {
			case "subscribe":
			    $contentStr = "欢迎关注蓝图之约!";
                if (isset($object->EventKey)) {
                    $contentStr = "关注二维码场景".$object->EventKey;
                }
                break;
            case "SCAN":
                $contentStr = "扫描".$object->EventKey;
                break;
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
			default:
			  break;
		}
		if (is_array($contentStr)) {
			$resultStr = $this->transmitNews($object,$contentStr);
		}else {
			$resultStr = $this->transmitText($object,$contentStr);
		}
		return $resultStr;
	}
    
    //回复文本消息
    private function transmitText($object, $content, $funcFlag=0)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>%d</FuncFlag>
</xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $funcFlag);
        return $resultStr;
    } 
            
    private function transmitNews($object, $arr_item, $funcFlag=0)
    {
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
<ArticleCount>%s</ArticleCount>
<Articles>$item_str</Articles>
<FuncFlag>%d</FuncFlag>
</xml>";
        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
        return $resultStr;		
    } 
                
}

?>