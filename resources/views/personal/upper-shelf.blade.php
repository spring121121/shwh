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
            <div class="header-left"><a href="/wap/personal"></a></div>
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
                    <input type="text" id="shop-title" placeholder="商品标题">
                </div>
                <div class="ipt-shop-brief">
                    <textarea id="shop-brief" placeholder="请描述一下您的商品" rows="4"></textarea>
                </div>
            </div>
            <div class="shop-classify">
                <ul>
                    <li>
                        <label>分类</label>
                        <div class="shop-classify-right"><span id="classify-name">选择分类</span><i></i></div>
                    </li>
                    {{--<li>--}}
                        {{--<label>原价</label>--}}
                        {{--<div class="shop-classify-right">￥<span><input placeholder="95.00" type="number"></span><i></i></div>--}}
                    {{--</li>--}}
                    <li>
                        <label>零售价</label>
                        <div class="shop-classify-right">￥<span><input placeholder="95.00" type="number"></span><i></i></div>
                    </li>
                    <li>
                        <label>运费</label>
                        <div class="shop-classify-right">￥<span><input placeholder="95.00" type="number"></span><i></i></div>
                    </li>
                    <li>
                        <label>商品库存</label>
                        <div class="shop-classify-right"><span><input placeholder="3352" type="number"></span><i></i></div>
                    </li>
                </ul>
            </div>
            <div class="btn-upper-release">发布</div>
        </div>
        <div class="content-box upper-content upper-classify">
            <ul class="first-class">
                <li>手机</li>
                <li>图书</li>
                <li>数码</li>
                <li>服装鞋帽</li>
                <li>交通工具</li>
                <li>母婴用品</li>
                <li>手机</li>
                <li>图书</li>
                <li>数码</li>
                <li>服装鞋帽</li>
                <li>交通工具</li>
                <li>母婴用品</li>
            </ul>
            <ul class="second-class">
                <li>手机</li>
                <li>图书</li>
                <li>数码</li>
                <li>服装鞋帽</li>
                <li>交通工具</li>
                <li>母婴用品</li>
                <li>手机</li>
                <li>图书</li>
                <li>数码</li>
                <li>服装鞋帽</li>
                <li>交通工具</li>
                <li>母婴用品</li>
            </ul>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/uploadfile.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var photo_list = $("#shop-img-list li").length;
            if (photo_list == 1){
                $("#shop-img-list").css({"justify-content":"center","width":"auto"});
                $(".btn-add-photo").css({"background-color":"transparent"});
            }
            $("#add-photo").on("change",function(){
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
            });
            $('#shop-img-list').on("click",".del-photo-list",function () {
                $(this).parent().remove();
            });


            // 点击选择分类
            $(".shop-classify li:first-child").click(function () {
                $(".upper-classify").css("z-index","2");
                $("#upper-title").html("商品分类");
                
            });
            $(".first-class").on("click","li",function () {
               $(this).css({"color":"#FF5555","background-color":"#f8f8f8"});
               $(this).siblings().css({"color":"#000","background-color":"#fff"});
               $(".second-class").css({"display":"block"});
            });
            $(".second-class").on("click","li",function () {
                $("#classify-name").html($(this).html());
                $(".upper-classify").css({"z-index":"0"});
            });
        });
    </script>
</html>