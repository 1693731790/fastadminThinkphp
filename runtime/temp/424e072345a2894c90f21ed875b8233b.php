<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/www/wwwroot/fast/www.fast.com/public/../application/index/view/opay/qrcode_pay.html";i:1595423018;s:72:"/www/wwwroot/fast/www.fast.com/application/index/view/common/header.html";i:1595303034;s:72:"/www/wwwroot/fast/www.fast.com/application/index/view/common/footer.html";i:1595250034;}*/ ?>
    <!--头部start-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<link href="/assets/frontend/css/public.css" rel="stylesheet" type="text/css">
<link href="/assets/frontend/css/swiper.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/assets/frontend/js/jquery.js"></script>
<script type="text/javascript" src="/assets/frontend/js/layer/layer.js"></script>
</head>
<body >



 <!--header class="agent-header">
        <div class="logo">首页</div>
    </header-->
<img style="width:300px;height:300px;" src="<?php echo $code; ?>">
   

<nav class="nav">
    <ul>
        <li>
            <a class="active" href="index.html">
                <em class="em01"></em>
                <span>首页</span>
            </a>
        </li>
        <li>
            <a href="cardManagement.html">
                <em class="em02"></em>
                <span>卡号管理</span>
            </a>
        </li>
        <li>
            <a href="article.html">
                <em class="em03"></em>
                <span>商学院</span>
            </a>
        </li>
        <li>
            <a href="order.html">
                <em class="em04"></em>
                <span>订单管理</span>
            </a>
        </li>
        <li>
            <a  href="<?php echo Url('user/index'); ?>">
                <em class="em05"></em>
                <span>个人中心</span>
            </a>
        </li>
    </ul>
</nav>
</body>
</html>