<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>我的订单-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a class="common-a btn-title-text" href="/wap/my_order">返回</a></div>
            <h3 class="top-title">订单详情</h3>
        </div>
        <div class="content-box">
            <ul class="details-cont">
                <li>
                    <div class="ddxq-img-box"><img src="" class="common-img"></div>
                    <div class="ddxq-icon-box"></div>
                    <p>商品的源头</p>
                </li>
                <li>
                    <div class="ddxq-img-box"><img src="" class="common-img"></div>
                    <div class="ddxq-icon-box"></div>
                    <p>姓名 地址</p>
                </li>
                <li>
                    <div class="ddxq-img-box"><img src="" class="common-img"></div>
                    <div class="ddxq-icon-box"></div>
                    <p>物流信息</p>
                </li>
            </ul>
            <div class="order-details-cont">
                <div class="ddxq-shop-img"><img src="/images/collection-img6.jpg" class="common-img"></div>
                <div class="order-right ddxq-right">
                    <p class="order-p1">交易进行中</p>
                    <p class="order-p2">商品的名称及内容<span>￥9.20</span></p>
                    <p class="order-p3">商品的具体内容<span>*1</span></p>
                </div>
                <div class="order-bottom order-details-bottom">
                    <p><span>共一件商品</span><span>合计：</span><span>￥9.20</span></p>
                </div>
            </div>
            <div class="choice-pay">
                <span>选择支付方式</span>
                <div class="pay-box weChat-icon">
                    <i></i>微信支付<div class="ddxq-icon-box"></div><span>支付：<strong>9.20</strong></span>
                </div>
                <div class="pay-box alipay-icon">
                    <i></i>支付宝支付<div class="ddxq-icon-box"></div><span>支付：<strong>9.20</strong></span>
                </div>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
</html>