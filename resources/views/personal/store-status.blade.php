<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>店铺-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common-body.css">
        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
        </div>
        <div class="store-status-tip">
            <div class="tip-content">
                <span id="tip-text">你好{{$nickname}}，您还没有店铺。<br />请您先申请开店</span>
                <a id="register-store" href="/wap/register_store">去注册</a>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')

        <div class="get-cookie">{{$store_status}}</div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            console.log($(".get-cookie").html())
            if ($(".get-cookie").html() == 0){
                $("#tip-text").html("你好{{$nickname}}，您的申请正在审核。<br />请您耐心等待")
                $("#register-store").remove();
            }else {
                $("#tip-text").html("你好{{$nickname}}，您的申请已被驳回。<br />请您确认信息真实性")
                $("#register-store").html("去完善信息");
            }
        });
    </script>
</html>