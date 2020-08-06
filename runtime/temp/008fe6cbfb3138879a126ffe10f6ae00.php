<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/www/wwwroot/fast/www.fast.com/public/../application/index/view/site/login.html";i:1595303086;s:72:"/www/wwwroot/fast/www.fast.com/application/index/view/common/header.html";i:1595303034;}*/ ?>
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

<div class="agent-main">
        <div  class="login-banner"></div>
        <div class="login-form">
            <ul>
                <li class="agent-flex  agent-flex-vc">
                    <i><img src="/assets/frontend/images/login-per.png" class="agent-img"></i>
                    <div class="login-form-input">
                        <input  type="text" id="username"  placeholder="请输入用户账号">
                    </div>
                </li>
                <li class="agent-flex  agent-flex-vc">
                    <i><img src="/assets/frontend/images/login-lock.png" class="agent-img"></i>
                    <div class="login-form-input">
                       <input  type="password" id="password"  placeholder="请输入密码">
                    </div>
                </li>
                <li class="agent-flex  agent-flex-vc agent-flex-hc">
                    <input type="text" id="captcha"  placeholder="请输入验证码" />

                    <span class="input-group-addon" style="padding:0;border:none;cursor:pointer;">
                        <img src="<?php echo Url('site/captcha'); ?>" width="100" height="30" onclick="this.src = '<?php echo Url('site/captcha'); ?>'" />
                    </span>
                </li>
            </ul>
            <div class="login-btn">
                <a href="javascript:;" id="login" class="agent-btn1">登  录</a>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(function(){
        $("#login").click(function(){

            // alert(1);
            var username=$("#username").val();
            var password=$("#password").val();
            var captcha=$("#captcha").val();
            
            if(username=="")
            {
                layer.msg("请输入账号");
                return false;
            }
            if(password=="")
            {
                layer.msg("请输入密码");
                return false;
            }
            if(captcha=="")
            {
                layer.msg("请输入验证码");
                return false;
            }
            
            $.get("<?php echo Url('site/login'); ?>",{"username":username,"password":password,"captcha":captcha},function(r){
                if(r.success)
                {
                   layer.msg('正在跳转');
                   setTimeout(function(){
                        window.location.href="<?php echo Url('user/index'); ?>";
                   },2000);
                }else{
                    
                    layer.msg(r.message);
                    return false;
                }
            })
        })

    })
</script>