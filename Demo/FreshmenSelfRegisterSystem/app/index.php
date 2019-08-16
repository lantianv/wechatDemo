<html>
    <head>
        <title>首页</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
        <script src='../js/jquery-1.9.0.js'></script>
		<link rel="stylesheet" href="../style/weui.css"/>
    </head>
<body>
<div class="page">
    <div class="page__bd" style="height: 100%;">
        <div class="weui-tab">
            <div class="weui-tab__panel">

            </div>
            <div class="weui-tabbar">
                <a href="http://charlie.applinzi.com/FreshmenSelfRegisterSystem/app/home.php" class="weui-tabbar__item weui-bar__item_on">
                    <span style="display: inline-block;position: relative;">
                        <img src="../images/index.png" alt="" class="weui-tabbar__icon">
                        <span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">8</span>
                    </span>
                    <p class="weui-tabbar__label">首页</p>
                </a>
                <a href="http://charlie.applinzi.com/FreshmenSelfRegisterSystem/app/home.php" class="weui-tabbar__item">
                    <img src="../images/me.png" alt="" class="weui-tabbar__icon">
                    <p class="weui-tabbar__label">我的</p>
                </a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.weui-tabbar__item').on('click', function () {
            $(this).addClass('weui-bar__item_on').siblings('.weui-bar__item_on').removeClass('weui-bar__item_on');
            $('.weui-tabbar__icon').src('../images/index_selected.png');
            
        });
        
    });
</script>
</body>
</html>