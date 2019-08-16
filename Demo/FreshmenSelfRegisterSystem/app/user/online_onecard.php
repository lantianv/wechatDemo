<html>
    <head>
        <title>在线申请一卡通</title>
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
	    <div class="weui-cells__title"><h3 style="color:black;text-align:center;margin:10px 10px;">在线申请一卡通</h3></div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入姓名"/>
                </div>
            </div>
			<div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入身份证号"/>
                </div>
            </div>
            
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>预交金额</p>
                </div>
                <div class="weui-cell__ft">500元</div>
            </div>
			<div class="weui-cells weui-cells_form">
              <div class="weui-cell weui-cell_warn">
                <div class="weui-cell__hd"><label for="" class="weui-label">卡号</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" pattern="[0-9]*" value="weui input error" placeholder="请输入卡号"/>
                </div>
                <div class="weui-cell__ft">
                    <i class="weui-icon-warn"></i>
                </div>
               </div>
            </div>
            
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入密码"/>
                </div>
            </div>
			
			<div class="weui-cells weui-cells_form">
               <div class="weui-cell weui-cell_switch">
                <div class="weui-cell__bd">已缴费</div>
                <div class="weui-cell__ft">
                    <input class="weui-switch" type="checkbox"/>
               </div>
            </div>
            
        </div>
			
        </div>
        <div class="weui-btn-area">
             <a class="weui-btn weui-btn_primary" href="http://charlie.applinzi.com/FreshmenSelfRegisterSystem/app/home.php" id="showTooltips">确定</a>
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