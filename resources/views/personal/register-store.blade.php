<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>店铺注册-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common-body.css">
        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <h3>店铺注册</h3>
        </div>
        <div class="content-box">
            <div class="store-register">
                <div class="store-cont">
                    <label for="store-name">店铺名称：</label>
                    <div class="ipt-name-box"><input type="text" id="store-name" placeholder="请输入店铺名称"></div>
                </div>
                <div class="store-cont">
                    <label for="store-brief">店铺简介：</label>
                    <div class="ipt-brief-box"><textarea id="store-brief" rows="3" placeholder="请输入店铺简介"></textarea></div>
                </div>
                <div class="store-cont store-logo">
                    <label>店铺logo：</label>
                    <div class="ipt-logo-box" id="store-logo-box"><input type="file" class="ipt-file" id="store-logo" name="source"></div>
                </div>
                <div class="store-cont store-logo store-prove">
                    <label>店铺资格证件：</label>
                    <div class="ipt-logo-box prove-box" id="store-prove-box"><input class="ipt-file" type="file" id="store-prove" name="source"></div>
                </div>
                <div class="btn-store-register"><a href="javascript:void(0);">提交信息</a></div>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/uploadfile.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            $("#store-logo").on("change",function(){
                store_upload("store-logo");
            });
            $("#store-prove").on("change",function(){
                store_upload("store-prove");
            });
            $(".btn-store-register").click(function () {
                var store_name = $("#store-name").val(),
                    store_brief = $("#store-brief").val(),
                    store_logo = $("#store-logo-box").find("img").attr("src"),
                    store_prove = $("#store-prove-box").find("img").attr("src");
                console.log(store_name,store_brief,store_logo,store_prove)
                if (store_name == ""){
                    alert("店铺名不能为空")
                }else if (store_brief == ""){
                    alert("请简单介绍一下自己的店铺吧")
                }else if (store_logo == undefined) {
                    alert("请上传店铺logo")
                }else if (store_prove == undefined){
                    alert("请上传营业执照")
                }else {
                    $.ajax({
                        url : "/addStore",	//请求url
                        type : "post",	//请求类型  post|get
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        data: {
                            'store[name]':store_name,
                            'store[introduction]':store_brief,
                            'store[logo_pic_url]':store_logo,
                            'store[prove_url]':store_prove
                        },
                        success : function(data){//回调函数 和 后台返回的 数据
                            console.log(data)
                            if (data.status){
                                alert("信息提交成功，请静心等待3-5个工作日");
                                window.location.href = "/wap/personal";
                            }else {
                                alert("提交失败，请重试");
                            }
                        }
                    });
                }
            });
        });
        function store_upload(id) {
            $.ajaxFileUpload({
                url: '/upload', //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: id, //文件上传域的ID
                dataType: 'json', //返回值类型 一般设置为json
                success: function (data){  //服务器成功响应处理函数
                    // $('#btn-my-header').attr('src',data.data.url);
                    console.log(data)
                    $("#" + id).parent().find("img").remove();
                    $("#" + id).parent().append('<img class="common-img" src="'+data.data.url+'">');
                },
                error: function (data, status, e){//服务器响应失败处理函数

                }
            });
        }
    </script>
</html>