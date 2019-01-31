<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>店铺设置-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div>
                <div class="header-left"><a class="common-a" href="/wap/store"></a></div>
                <div class="header-right"><a class="common-a" href="javascript:void(0);" id="finish-set-store">完成</a></div>
                <h3 class="top-title">店铺信息修改</h3>
            </div>
        </div>
        <div class="content-box">
            <div class="ipt-cont edit-data">
                <form>
                    <div class="ipt-box">
                        <label>店铺logo</label>
                        <div class="tx-icon-box">
                            <input type="file" class="ipt-file" id="setting-store-logo" name="source">
                            <img src="" class="common-img">
                        </div>
                    </div>
                    <div class="ipt-box">
                        <label for="store-name">店铺名称</label>
                        <div class="ipt-cont-box"><input id="setting-store-name" type="text" placeholder="名称"></div>
                    </div>
                    <div class="ipt-box distance-top store-brief-box">
                        <label for="setting-store-brief">店铺简介</label>
                        <textarea id="setting-store-brief" maxlength="100" placeholder="输入1-100字的店铺简介" rows="4"></textarea>
                    </div>
                </form>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
        <div class="get-cookie">{{$store_id}}</div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/uploadfile.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            $.ajax({
                url : "/myStoreDetail",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    if (data.status){
                        $(".tx-icon-box").find("img").attr("src",data.data[0].logo_pic_url);
                        $("#setting-store-name").val(data.data[0].name);
                        $("#setting-store-brief").val(data.data[0].introduction);
                    }else {
                        layer.msg("哎呀！出错了");;
                    }
                }
            });
            $("#setting-store-logo").on("change",function(){
                var img_size = $("input[type=file]").get(0).files[0].size;
                if (img_size > 1000000){
                    layer.tips("上传图片过大，请上传小于1M的图片", '#setting-store-logo', {
                        tips: 4
                    });
                }else {
                    $.ajaxFileUpload({
                    url: '/upload', //用于文件上传的服务器端请求地址
                    secureuri: false, //是否需要安全协议，一般设置为false
                    fileElementId: "setting-store-logo", //文件上传域的ID
                    dataType: 'json', //返回值类型 一般设置为json
                    success: function (data){  //服务器成功响应处理函数
                        $(".tx-icon-box").find("img").attr("src",data.data.url);
                    },
                    error: function (data, status, e){//服务器响应失败处理函数

                    }
                });
                }
            });
            $("#finish-set-store").click(function () {
                var store_logo = $(".tx-icon-box").find("img").attr("src");
                var store_name = $("#setting-store-name").val();
                var store_brief = $("#setting-store-brief").val();
                console.log(store_logo,store_name,store_brief);
                if (store_logo ==""){
                    layer.tips("请上传您的logo图片", '#setting-store-logo', {
                        tips: 4
                    });
                }else if (store_name ==""){
                    layer.tips("店铺名称不能为空", '#setting-store-name', {
                        tips: 3
                    });
                }else if (store_brief ==""){
                    layer.tips("请介绍一下您的店铺", '#setting-store-brief', {
                        tips: 3
                    });
                }else {
                    $.ajax({
                        url : "/updateStore",	//请求url
                        type : "post",	//请求类型  post|get
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        data: {
                            'store[name]':store_name,
                            'store[introduction]':store_brief,
                            'store[logo_pic_url]':store_logo
                        },
                        success : function(data){//回调函数 和 后台返回的 数据
                            if (data.status){
                                layer.msg('店铺信息修改成功', {
                                    time: 3000 //不自动关闭
                                }, function(){
                                    window.location.href = "/wap/store";
                                });
                            }else {
                                layer.msg(data.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
</html>