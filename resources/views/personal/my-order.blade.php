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
        <style>
            .content-box {
                padding-top:95px;
                overflow: hidden;
                margin-bottom: 55px;
                background: #f0f0f0;
            }
            .order-cont {
                margin: 10px 0;
            }
            .order-cont li {
                background-color: #fff;
            }
            .order{
                position:fixed;
                height:50px;
                background:#fff;
                border-bottom:1px solid #DEDEDE;
                margin-top: 44px;
                width:100%;
            }
            .order_status{
                line-height:50px;
                vertical-align: middle;
                text-align: left;
                font-size:14px;
                padding-left:1%;
                padding-right:3%;
            }
            .choice{
                margin-left:4%;
                padding-bottom:15px;
            }
            .choice:last-child{
                margin-right:0;
            }
            .sh {
                font-size: 14px;
                padding:15px 0;
                width:100%;
                height:20px;
            }
            .sh_img{
                display: inline-block;
                background-size: 100%;
                width: 20px;
                height: 20px;
                border-radius:50%;
                overflow: hidden;
                float:left;
            }
            .sh_s_name{
                width:auto;
                height:20px;
                float:left;
                margin-left:1%;
            }
            .order-right {
                height: 110px;
            }
            .order-left {
                height: 110px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <h3 class="top-title">我的订单</h3>
        </div>
        {{--分类展示--}}
        <div class="order">
            <div class="order_status">
                <span class="choice" id="-2">全部</span>
                <span class="choice" id="0">待支付</span>
                <span class="choice" id="1">已支付</span>
                <span class="choice" id="3">已发货</span>
                <span class="choice" id="4">已签收</span>
                <span class="choice" id="6">待评价</span>
            </div>
        </div>

        <div class="content-box">

        </div>
        <div class="mask-box">
            <div class="weChat del-order">
                <span>确定要删除此订单吗？</span>
                <div class="btn-mask">
                    <button id="order-return">取消</button>
                    <button>确定</button>
                </div>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
</html>
<script>
    $(function(){
        $('.choice').eq(0).css('border-bottom','2px solid #f49610');
        myOrder('/orderList','-2');
        function myOrder(url,type){
            var myOrder = '';
            $.ajax({
                url : url,	//请求url 商城分类
                type : "get",	//请求类型  post|get
                async: false,
                dataType : "json",  //返回数据的 类型 text|json|html--
                data:{type:type},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data);
                    $.each(data.data, function (k, v) {
                        var goods_name = v['goods_name'];
                        var goods_info = v['goods_info'];
                        if(goods_name.length>5){
                            goods_name = goods_name.substr(0,5)+'...';
                        }
                        if(goods_info.length>10){
                            goods_info = goods_info.substr(0,10)+'...';
                        }
                        var image = v['image_url'][0];
                        if(image == ''){
                            image = '/images/shop/default.jpg';
                        }
                        myOrder += '<ul class="order-cont">' +
                            '<li>';
                        myOrder += '<div class="sh" id="'+v['store_id']+'"><div class="sh_img"><img src="/images/index-icon.png" class="common-img"></div>';
                        myOrder += '<div class="sh_s_name">'+v['store_name']+'</div>';
                        myOrder += '<div class="sh_img"><img src="/images/right.png" class="common-img"></div></div>';

                        myOrder += '<div class="order-left" id="'+v['goods_id']+'">';
                        myOrder += '<div class="order-img-box"><img src="'+image+'" class="common-img"></div></div>';
                        myOrder += '<div class="order-right" id="'+v['goods_id']+'">';
                        myOrder += '<p class="order-p1"></p>';
                        myOrder += '<p class="order-p2">'+goods_name+'<span>￥'+v['unit_price']+'</span></p>';
                        myOrder += '<p class="order-p3">'+goods_info+'<span>*'+v['num']+'</span></p></div>';
                        myOrder += '<div class="order-bottom">';
                        myOrder += '<p><span>共'+v['num']+'件商品</span><span>合计：</span><span>￥'+v['total']+'</span></p><ul>';
                        myOrder += '<li>评价</li>';
                        myOrder += '<li>查看物流</li>';
                        myOrder += '<li class="btn-del-order">删除订单</li>';
                        myOrder += '</ul></div></li></ul>';
                    });
                    $('.content-box').html(myOrder);
                }
            });
        }
        $('.choice').on('click',function(){
            var type = $(this).attr('id');
            $('.choice').css('border-bottom','0 solid #fff');
            $(this).css('border-bottom','2px solid #f49610');
            myOrder('/orderList',type);
        });
        // 点击进入店铺
        $(".sh").click(function () {
            var store_id = $(this).attr('id');
            // window.location.href = "/wap/order_details";
        });
        // 点击订单列表跳转到订单详情
        $(".order-right,.order-left").click(function () {
            var goods_id = $(this).attr('id');
            window.location.href = "/wap/order_details?goods_id="+goods_id;
        });
        // 点击删除订单事件
        $(".btn-del-order").click(function (event) {
            event.stopPropagation();
            $(".mask-box").css("display", "block");
        });
        $("#order-return").click(function () {
            $(".mask-box").css("display", "none");
        });
    });
</script>