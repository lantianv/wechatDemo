<html>
    <head>
        <title>个人信息采集</title>
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
	    <div class="weui-cells__title"><h3 style="color:black;text-align:center;margin:10px 10px;">个人信息采集</h3></div>
        <div class="weui-cells weui-cells_form">
		    
			<div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入姓名"/>
                </div>
            </div>
			
            <div class="weui-cells">
              <div class="weui-cell weui-cell_select weui-cell_select-before">
                <div class="weui-cell__hd">
                    <select class="weui-select" name="select2">
                        <option value="1">+86</option>
                        <option value="2">+80</option>
                        <option value="3">+84</option>
                        <option value="4">+87</option>
                    </select>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入号码"/>
                </div>
              </div>
            </div>
            
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">QQ</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入QQ号"/>
                </div>
            </div>
			
			<div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">Email</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入Email"/>
                </div>
            </div>
            
            <div class="weui-cells weui-cells_radio">
                <div class="weui-cells__title">性别</div>
              <label class="weui-cell weui-check__label" for="x11">
                <div class="weui-cell__bd">
                    <p>男</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="radio1" id="x11"/>
                    <span class="weui-icon-checked"></span>
                </div>
              </label>
            <label class="weui-cell weui-check__label" for="x12">

                <div class="weui-cell__bd">
                    <p>女</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" name="radio1" class="weui-check" id="x12" checked="checked"/>
                    <span class="weui-icon-checked"></span>
                </div>
              </label>
            </div>
        
        </div>
        <div class="weui-btn-area">
             <a class="weui-btn weui-btn_primary" href="http://charlie.applinzi.com/FreshmenSelfRegisterSystem/app/home.php" id="showTooltips">提交</a>
        </div>
    </div>
    <div class="weui-footer">
         <p class="weui-footer__text" style="margin-top:80px;">Copyright &copy; 2019 新生自助报到系统</p>
    </div>
</div>

<script type="text/javascript">
   
</script>
</body>
</html>