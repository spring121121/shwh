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
        <div class="header store-header other-store-header">
            <div>
                <div class="header-left"><a href="/wap/shop_detail"></a></div>
                <h3 class="other-store-title">店铺首页</h3>
            </div>
            <div class="store-message-box other-store-box">
                <div class="icon-box" id="store-index-logo"><img src="/images/portrait.png" onerror="this.src='/images/portrait.png'" class="common-img"></div>
                <div class="store-name">
                    <h2 id="store-index-name">店铺名称</h2>
                    <span id="store-grade"><i><img src="/images/grade.png" class="common-img"></i>等级</span>
                </div>
                <div class="store-brief">
                    <p id="store-index-brief">店铺的简介</p>
                </div>
            </div>
            <div class="other-shop-classify">
                <ul class="flex-box"></ul>
            </div>
        </div>
        <div class="content-box">

            <!--商品展示-->
            <div class="flex-box other-store-shop" id="ysj-shop">
                <ul class="flex-left">
                </ul>
                <ul  class="flex-right">
                </ul>
            </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var store_id = getUrlParam("store_id"),category = '';
            $.ajax({
                url : "/otherStoreDetail",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                async: false,
                data: {id:store_id},
                success : function(data){//回调函数 和 后台返回的 数据
                    //alert(JSON.stringify(data));
                    console.log(data)
                    if (data.status){
                        $("#store-index-logo").find("img").attr("src",data.data[0].logo_pic_url);
                        $("#store-index-name").html(data.data[0].name);
                        $(".other-store-title").html(data.data[0].name);
                        $("#store-index-brief").html(data.data[0].introduction);
                    }else {
                        alert(data.message);
                    }
                }
            });


            $.ajax({
                url : "/categoryList/1",	//请求url 商城分类
                type : "get",	//请求类型  post|get
                async: false,
                dataType : "json",  //返回数据的 类型 text|json|html--
                data:{},
                success : function(data){//回调函数 和 后台返回的 数据
                    category += '<li id="0">全部</li>';
                    $.each(data.data, function (k, v) {
                        category += '<li id="'+v['id']+'">'+v['category_name']+'</li>';
                    });
                    $('.other-shop-classify>ul').html(category);
                }
            });

            $('.other-shop-classify>ul>li').eq(0).css("border-bottom","1px solid #fff");
            $('.other-shop-classify>ul').on("click","li",function () {
                $(this).css("border-bottom","1px solid #fff");
                $(this).siblings().css("border-bottom","none");
                var id = $(this).attr('id');
                console.log(id)
            });
            $.ajax({
                url : "/storeGoodsList",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {id:store_id},
                success : function(data){//回调函数 和 后台返回的 数据
                    //alert(JSON.stringify(data));
                    console.log(data);
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
                        alert(data.message);
                    }
                }
            });
            function getUrlParam(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
                if (r != null) return unescape(r[2]); return null; //返回参数值
            }
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