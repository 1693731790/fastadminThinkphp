<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"/www/wwwroot/fast/www.fast.com/public/../application/index/view/user/index.html";i:1595471767;s:72:"/www/wwwroot/fast/www.fast.com/application/index/view/common/header.html";i:1595303034;s:72:"/www/wwwroot/fast/www.fast.com/application/index/view/common/footer.html";i:1595250034;}*/ ?>
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

    <!--头部start-->
    <header class="agent-header agent-header-user">
        <div class="header-return">
            <a href="javascript:history.go(-1);"><i></i></a>
        </div>
        <div class="logo">购买记录</div>
        <div class="header-btn">
            <a  class="set-icon" href="setting.html" ></a>
        </div> 
    </header>
    <!--头部end-->
    <section class="agent-container agent-container-b">
        <div class="agent-user-banner">
            <div class="agent-user-banner-img">
                <img src="/assets/frontend/images/per-img.png">
            </div>
            <div class="agent-user-banner-name">
                <div>
                   <span>张默默<a href="person.html"><em></em></a></span>
                </div>
            </div>
            <div class="agent-user-banner-z">
                <em></em>个人已认证
            </div>
        </div>
        <div class="agent-user-money ">
            <em class="em01"><img class="agent-img" src="/assets/frontend/images/per-bao.png"></em>
            <span class="span01">余额：</span>
            <span class="span02"><?php echo $money; ?></span>
            <em class="em02"></em>
            <a href="recharge.html" class="agent-btn2">充值</a>
        </div>
        <div class="agent-title agent-title-arror">
            <a href="order.html">
                <i></i>
                <h2>我的订单</h2>
                <span>查看全部订单</span>
            </a>
        </div>
        <div class="agent-user-order agent-clearfix">
            <ul>
                <li>
                    <a href="orderPay.html">
                        <div class="div-img"><img  class="agent-img" src="/assets/frontend/images/per-icon01.png"></div>
                        <p>待付款</p>
                    </a>
                </li>
                <li>
                    <a href="goodSend.html">
                        <div class="div-img"><img  class="agent-img" src="/assets/frontend/images/per-icon02.png"></div>
                        <p>待发货</p>
                    </a>
                </li>
                <li>
                    <a href="goodsTake.html">
                        <div class="div-img"><img  class="agent-img" src="/assets/frontend/images/per-icon03.png"></div>
                        <p>待收货</p>
                    </a>
                </li>
                <li>
                    <a href="orderComplete.html">
                        <div class="div-img"><img  class="agent-img" src="/assets/frontend/images/per-icon04.png"></div>
                        <p>已完成</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="agent-title agent-title-w">
            <i></i>
            <h2>用户功能</h2>
        </div>
        <div class="agent-user-function">
            <a href="addressAdd.html">
                <i><img class="agent-img" src="/assets/frontend/images/per-icon11.png"></i>
                <h3>添加地址</h3>
            </a>
        </div>
        <div class="agent-user-function">
            <a href="goodsDetails.html">
                <i><img class="agent-img" src="/assets/frontend/images/per-icon12.png"></i>
                <h3>我要进货</h3>
            </a>
        </div>
        <div class="agent-user-function">
            <a href="invoiceApply.html">
                <i><img class="agent-img" src="/assets/frontend/images/per-icon13.png"></i>
                <h3>申请发票</h3>
            </a>
        </div>
        <div class="agent-user-function">
            <a href="information.html">
                <i><img class="agent-img" src="/assets/frontend/images/per-icon14.png"></i>
                <h3>系统消息</h3>
                <em class="remind"></em>
            </a>
        </div>
    </section>
    
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