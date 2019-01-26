<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>商品上架-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left" id="upper-return"></div>
            <h3 class="top-title" id="upper-title">商品上架</h3>
        </div>
        <div class="content-box upper-content">
            <div class="add-photo-box">
                <ul id="shop-img-list">
                    <li class="btn-add-photo">
                        <input type="file" id="add-photo" name="source">
                        <span>添加照片</span>
                    </li>
                    {{--<li>--}}
                        {{--<img src="/images/2.jpg" class="common-img">--}}
                    {{--</li>--}}
                </ul>
            </div>
            <div class="ipt-box">
                <div class="ipt-title">
                    <input type="text" id="shop-title" placeholder="商品名称">
                </div>
                <div class="ipt-shop-brief">
                    <textarea id="shop-brief" placeholder="请描述一下您的商品" rows="4"></textarea>
                </div>
            </div>
            <div class="shop-classify">
                <ul>
                    <li>
                        <label>分类</label>
                        <div class="shop-classify-right">
                            <div class="choice-classify" id="classify-name">选择分类</div>
                            <i></i>
                        </div>
                    </li>
                    {{--<li>--}}
                        {{--<label>原价</label>--}}
                        {{--<div class="shop-classify-right">￥<span><input placeholder="95.00" type="number"></span><i></i></div>--}}
                    {{--</li>--}}
                    <li>
                        <label>售价</label>
                        <div class="shop-classify-right">￥<span><input placeholder="95.00" id="shop-price" type="number"></span><i></i></div>
                    </li>
                    <li>
                        <label>运费</label>
                        <div class="shop-classify-right">￥<span><input placeholder="95.00" id="shop-freight" type="number"></span><i></i></div>
                    </li>
                    <li>
                        <label>商品库存</label>
                        <div class="shop-classify-right"><span><input placeholder="3352" id="shop-stock" type="number"></span><i></i></div>
                    </li>
                </ul>
            </div>
            <div class="btn-upper-release">确定上架</div>
        </div>
        <div class="content-box upper-content upper-classify">
            <ul class="first-class">
                {{--<li>手机</li>--}}
                {{--<li>图书</li>--}}
                {{--<li>数码</li>--}}
            </ul>
            <ul class="second-class"></ul>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/layer/layer.js"></script>
    <script src="/js/uploadfile.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/proving.js"></script>
    <script>
        $(function () {
            var photo_list = $("#shop-img-list li").length;
            if (photo_list == 1){
                $("#shop-img-list").css({"justify-content":"center","width":"auto"});
                $(".btn-add-photo").css({"background-color":"transparent"});
            }
            $("#add-photo").on("change",function(){
                var img_size = $("input[type=file]").get(0).files[0].size;
                console.log(img_size);
                //alert(img_size);
                if (img_size > 1000000){
                    alert("上传图片过大，请上传小于1M的图片")
                } else {
                    $.ajaxFileUpload({
                        url: '/upload', //用于文件上传的服务器端请求地址
                        secureuri: false, //是否需要安全协议，一般设置为false
                        fileElementId: 'add-photo', //文件上传域的ID
                        dataType: 'json', //返回值类型 一般设置为json
                        success: function (data){  //服务器成功响应处理函数
                            $('#shop-img-list').append('<li><div class="del-photo-list"></div><img src="'+data.data.url+'" class="common-img"></li>');
                            $("#shop-img-list").css({"justify-content":"unset","width":"max-content"});
                            $(".btn-add-photo").css({"background-color":"#eee"});
                        },
                        error: function (data, status, e){//服务器响应失败处理函数

                        }
                    });
                }
            });
            $('#shop-img-list').on("click",".del-photo-list",function () {
                $(this).parent().remove();
            });


            // 点击选择分类
            $(".shop-classify li:first-child").click(function () {
                var category = '';
                $.ajax({
                    url : "/categoryList/1",	//请求url 商城分类
                    type : "get",	//请求类型  post|get
                    async: false,
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data:{},
                    success : function(data){//回调函数 和 后台返回的 数据
                        $.each(data.data, function (k, v) {
                            category += '<li id="'+v.id+'">'+v.category_name+'</li>';
                        });
                        $('.first-class').html(category);
                    }
                });
                $(".upper-classify").css({"z-index":"2","opacity":"1"});
                $("#upper-title").html("商品分类");
            });

            // 点击一级分类列表加载二级分类
            $(".first-class").on("click","li",function () {
                var category = '',first_id = $(this).attr("id");
                $.ajax({
                    url : "/categoryList/1",	//请求url 商城分类
                    type : "get",	//请求类型  post|get
                    async: false,
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data:{pid:first_id},
                    success : function(data){//回调函数 和 后台返回的 数据
                        $.each(data.data, function (k, v) {
                            category += '<li id="'+v.id+'">'+v.category_name+'</li>';
                        });
                        $('.second-class').html(category);
                    }
                });
               $(this).css({"color":"#FF5555","background-color":"#f8f8f8"});
               $(this).siblings().css({"color":"#000","background-color":"#fff"});
               $(".second-class").css({"display":"block"});
            });

            // 点击二级分类时响应的事件
            $(".second-class").on("click","li",function () {
                $("#classify-name").html('<span id="'+$(this).attr("id")+'">'+$(this).html()+'</span>');
                $(".upper-classify").css({"z-index":"0","opacity":"0"});
            });

            // 点击确认上架按钮时响应的事件
            $(".btn-upper-release").click(function () {
                var array_list = $("#shop-img-list").find("img"),array_img=[],array_img_url = "";
                for (var i = 0;i<array_list.length; i++){
                    array_img.push($("#shop-img-list").find("img").eq(i).attr("src"));
                }
                array_img_url = array_img.join(",");
                var shop_title = $("#shop-title").val(),
                    shop_brief = $("#shop-brief").val(),
                    shop_classify = $("#classify-name").find("span").attr("id"),
                    shop_price = $("#shop-price").val(),
                    shop_freight = $("#shop-freight").val(),
                    shop_stock = $("#shop-stock").val(),free_shipping;
                if (shop_freight == 0){
                    free_shipping = 0;
                }else {
                    free_shipping = 1;
                }
                if (array_img_url == ""){
                    alert("请上传至少一张商品的照片")
                } else if (shop_title == "") {
                    alert("请输入商品名称")
                }else if (shop_brief == ""){
                    alert("请输入商品简介")
                }else if ($("#classify-name").find("span").length == 0){
                    alert("请选择商品分类")
                }else if (shop_price == ""){
                    alert("请输入商品售价")
                }else if (shop_freight == ""){
                    alert("请输入运费")
                }else if (shop_stock == ""){
                    alert("请输入商品的库存数量")
                }else if (shop_stock < 1){
                    alert("商品的库存数量至少为1")
                }else {
                    $.ajax({
                        url : "/addGoods",	//请求url 商城分类
                        type : "post",	//请求类型  post|get
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        data:{
                            "shop[category_id]":shop_classify,
                            "shop[goods_name]":shop_title,
                            "shop[goods_info]":shop_brief,
                            "shop[price]":shop_price,
                            "shop[image_url]":array_img_url,
                            "shop[stock]":shop_stock,
                            "shop[is_shipping]":free_shipping,
                            "shop[postage]":shop_freight,
                            "shop[is_agent]": 0
                        },
                        success : function(data){//回调函数 和 后台返回的 数据
                            if (data.status){
                                alert(data.message);
                                window.location.href = "/wap/store";
                            }else {
                                alert(data.message);
                            }
                        }
                    });
                }

            });
            
            // 点击返回按钮触发的事件
            $("#upper-return").click(function () {
                var z_index = $(".upper-classify").css("z-index");
                console.log(z_index);
                if (z_index == 2){
                    $("#upper-title").html("商品上架");
                    $(".upper-classify").css({"z-index":"0"});
                }else {
                    window.location.href = "/wap/store";
                }
            });
        });
    </script>
</html>