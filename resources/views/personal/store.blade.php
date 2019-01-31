<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>店铺-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header store-header">
            <div>
                <div class="header-left"><a class="common-a" href="/wap/personal"></a></div>
                <div class="header-right renzheng"><a class="common-a" href="/wap/upper_shelf">商品上架</a></div>
                <h3 class="top-title">店铺首页</h3>
            </div>
            <div class="store-message-box">
                <div class="icon-box" id="store-index-logo"><img src="/images/portrait.png" onerror="this.src='/images/portrait.png'" class="common-img"></div>
                <div class="store-name">
                    <div class="setting"><a class="common-a" href="/wap/store_setting"></a></div>
                    <h2 id="store-index-name">店铺名称<span>已认证</span></h2>
                    <span id="store-grade"><i><img src="/images/grade.png" class="common-img"></i>等级</span>
                    <span id="store-fans"><i><img src="/images/fans-num.png" class="common-img"></i>粉丝人数</span>
                </div>
                <div class="store-brief">
                    <span>简介</span>
                    <p id="store-index-brief">店铺的简介</p>
                </div>
            </div>
            <ul class="flex-box store-switch">
                <li id="my-shop">商品</li>
                <li>待发货</li>
                <li>已发货</li>
            </ul>
        </div>
        <div class="content-box">

            <!--商品展示-->
            <div class="flex-box store-content" id="ysj-shop">
                <ul class="flex-left">
                    {{--<li>--}}
                        {{--<div class="flex-img-box">--}}
                            {{--<img src="/images/collection-img6.jpg" class="common-img">--}}
                            {{--<span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>96人</span>--}}
                        {{--</div>--}}
                        {{--<h3>藏品的名称</h3>--}}
                        {{--<p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>--}}
                        {{--<div class="btn-flex-box">--}}
                            {{--<span class="zf-icon"><i></i>转发</span>--}}
                            {{--<span class="zan-icon"><i></i>赞</span>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                </ul>
                <ul  class="flex-right">
                    {{--<li>--}}
                        {{--<div class="flex-img-box">--}}
                            {{--<img src="/images/collection-img3.jpg" class="common-img">--}}
                            {{--<span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>96人</span>--}}
                        {{--</div>--}}
                        {{--<h3>藏品的名称</h3>--}}
                        {{--<p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>--}}
                        {{--<div class="btn-flex-box">--}}
                            {{--<span class="zf-icon"><i></i>转发</span>--}}
                            {{--<span class="zan-icon"><i></i>赞</span>--}}
                        {{--</div>--}}
                    {{--</li>--}}

                </ul>
            </div>

            <!--待发货商品列表-->
            <div class="note-list-box store-content" id="dfh-shop">
                <ul>
                    <li>
                        <div class="order-left">
                            <p><i><img src="/images/factory.png" class="common-img"></i>商品的源头<i></i></p>
                            <div class="order-img-box"><img src="/images/collection-img4.jpg" class="common-img"></div>
                        </div>
                        <div class="order-right">
                            <p class="order-p1">交易成功</p>
                            <p class="order-p2">商品的名称及内容<span>￥9.20</span></p>
                            <p class="order-p3">商品的具体内容<span>*1</span></p>
                        </div>
                        <div class="order-bottom">
                            <p><span>共一件商品</span><span>合计：</span><span>￥9.20</span></p>
                            <ul>
                                <li>发货</li>
                                <li>选择物流</li>
                                <li>联系客户</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>


            <!--已发货商品列表-->
            <div class="note-list-box store-content" id="yfh-shop">
                <ul>
                    <li>
                        <div class="order-left">
                            <p><i><img src="/images/factory.png" class="common-img"></i>商品的源头<i></i></p>
                            <div class="order-img-box"><img src="/images/collection-img4.jpg" class="common-img"></div>
                        </div>
                        <div class="order-right">
                            <p class="order-p1">交易成功</p>
                            <p class="order-p2">商品的名称及内容<span>￥9.20</span></p>
                            <p class="order-p3">商品的具体内容<span>*1</span></p>
                        </div>
                        <div class="order-bottom">
                            <p><span>共一件商品</span><span>合计：</span><span>￥9.20</span></p>
                            <ul>
                                <li>查看物流</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var store_id,user_id;
            $.ajax({
                url : "/myStoreDetail",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                async: false,
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    //alert(JSON.stringify(data));
                    //console.log(data)
                    if (data.status){
                        store_id = data.data[0].id;
                        user_id = data.data[0].uid;
                        $("#store-index-logo").find("img").attr("src",data.data[0].logo_pic_url);
                        $("#store-index-name").html(data.data[0].name+'<span>已认证</span>');
                        $("#store-index-brief").html(data.data[0].introduction);
                    }else {
                        layer.msg(data.message);
                    }
                }
            });

            $.ajax({
                url : "/myFans",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                async: false,
                data: {uid:user_id},
                success : function(data){//回调函数 和 后台返回的 数据
                    //alert(JSON.stringify(data));
                    //console.log(data)
                    if (data.status){
                        $("#store-fans").html('<i><img src="/images/fans-num.png" class="common-img"></i>有'+data.data.count+'人关注了店主');
                    }else {
                        layer.msg(data.message);
                    }
                }
            });

            $.ajax({
                url : "/storeGoodsList",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {id:store_id},
                success : function(data){//回调函数 和 后台返回的 数据
                    //alert(JSON.stringify(data));
                    //console.log(data);
                    var rightHtml = "",leftHtml = "";
                    if (data.status){
                        $.each(data.data, function (k, v) {
                            if(v.id%2 == 0){
                                rightHtml = flex_index(rightHtml,v);
                            }else {
                                leftHtml = flex_index(leftHtml,v);
                            }
                        });
                        $(".flex-left").html(leftHtml);
                        $(".flex-right").html(rightHtml);
                    }else {
                        layer.msg(data.message);
                    }
                }
            });
            function flex_index(obj,v) {
                obj += '<li id="'+v.id+'"><div class="flex-img-box">';
                obj += '<img src="' + v['image_url'][0]+ '" class="common-img">';
                obj += '<span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>96人</span>';
                obj += '</div>';
                obj += '<h3>'+v.goods_name+'</h3>';
                obj += '<p>'+v.goods_info+'</p>';
                obj += '<div class="btn-flex-box">';
                obj += '<span class="zf-icon">价格：￥'+v.price+'</span>';
                obj += '<span class="zan-icon">库存：'+v.stock+'</span>';
                obj += '</div></li>';
                return obj;
            }
        });
    </script>
</html>