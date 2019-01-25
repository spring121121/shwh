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
            <div class="header-left"><a href="/wap/store_status"></a></div>
            <h3 id="store-title">店铺注册</h3>
        </div>
        <div class="content-box">
            <div class="store-register">
                <div class="store-cont">
                    <label for="store-name">店铺名称</label>
                    <div class="ipt-name-box"><input type="text" maxlength="16" id="store-name" placeholder="请输入"></div>
                </div>
                <div class="store-cont">
                    <label for="store-brief">店铺简介</label>
                    <div class="ipt-brief-box"><textarea maxlength="200" id="store-brief" rows="3" placeholder="请输入店铺简介"></textarea></div>
                </div>
                <div class="store-cont store-logo">
                    <label>店铺logo</label>
                    <div class="ipt-logo-box" id="store-logo-box"><input type="file" class="ipt-file" id="store-logo" name="source"></div>
                </div>
                <div class="store-cont">
                    <label for="store-id-name">真实姓名</label>
                    <div class="ipt-name-box"><input type="text" maxlength="16" id="store-id-name" placeholder="请填写店主的真实姓名"></div>
                </div>
                <div class="store-cont">
                    <label for="store-id-card">身份证号</label>
                    <div class="ipt-name-box"><input type="text" maxlength="18" id="store-id-card" placeholder="请填写店主的身份证号码"></div>
                </div>
                <div class="store-cont store-prove">
                    <label>身份证正反面</label>
                    <div class="ipt-logo-box prove-box" id="sfz-just-box"><input class="ipt-file" type="file" id="sfz-just" name="source"></div>
                    <div class="ipt-logo-box prove-box" id="sfz-back-box"><input class="ipt-file" type="file" id="sfz-back" name="source"></div>
                    <label id="store-prove-tip">资质证件照</label>
                    <div class="ipt-logo-box prove-box" id="store-prove-box"><input class="ipt-file" type="file" id="store-prove" name="source"></div>
                </div>
                <div class="btn-store-register"><a href="javascript:void(0);">提交信息</a></div>
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
            var store_status = getUrlParam('store_status');
            var role_id = getUrlParam('role_id');
            // alert(store_status);
            // alert(role_id);

            //上传图片
            $("#store-logo").on("change",function(){
                store_upload("store-logo");
            });
            $("#sfz-just").on("change",function(){
                store_upload("sfz-just");
            });
            $("#sfz-back").on("change",function(){
                store_upload("sfz-back");
            });
            $("#store-prove").on("change",function(){
                store_upload("store-prove");
            });

            //判断是不是被驳回的店铺申请
            if (store_status == 2){
                var role_id;
                $("#store-title").html("完善店铺信息");
                $.ajax({
                    url : "/myStoreDetail",	//请求url
                    type : "get",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {},
                    success : function(data){//回调函数 和 后台返回的 数据
                        alert(JSON.stringify(data))
                        if (data.status){
                            role_id = data.data[0].role;
                            $("#store-logo-box").append('<img class="common-img" src="'+data.data[0].logo_pic_url+'">');
                            $("#store-name").val(data.data[0].name);
                            $("#store-brief").val(data.data[0].introduction);
                            $("#store-id-name").val(data.data[0].real_name);
                            $("#store-id-card").val(data.data[0].id_card_num);
                            $("#sfz-just-box").append('<img class="common-img" src="'+data.data[0].id_card_front+'">');
                            $("#sfz-back-box").append('<img class="common-img" src="'+data.data[0].id_card_backend+'">');
                            if (data.data[0].prove_url != ""){
                                $("#store-prove-box").append('<img class="common-img" src="'+data.data[0].prove_url+'">');
                            }else {
                                $("#store-prove-tip").css("display","none");
                                $("#store-prove-box").css("display","none");
                            }
                        }else {
                            alert(data.message);
                        }
                    }
                });
                $(".btn-store-register").click(function () {
                    var store_name = $("#store-name").val(),
                        store_brief = $("#store-brief").val(),
                        store_logo = $("#store-logo-box").find("img").attr("src"),
                        store_id_name = $("#store-id-name").val(),
                        store_id_card = $("#store-id-card").val(),
                        store_id_just = $("#sfz-just-box").find("img").attr("src"),
                        store_id_back = $("#sfz-back-box").find("img").attr("src"), store_prove;
                    if (role_id == 3){
                        store_prove = "";
                    } else {
                        store_prove = $("#store-prove-box").find("img").attr("src")
                    }
                    if (store_name == ""){
                        alert("店铺名不能为空")
                    }else if (store_brief == ""){
                        alert("请简单介绍一下自己的店铺吧")
                    }else if ($("#store-logo-box").find("img").length == 0) {
                        alert("请上传店铺logo")
                    }else if (store_id_name == "") {
                        alert("请输入您的真实姓名")
                    }else if (store_id_card == "") {
                        alert("请输入您的身份证号")
                    }else if ($("#sfz-just-box").find("img").length == 0) {
                        alert("请上传您的身份证正面")
                    }else if ($("#sfz-back-box").find("img").length == 0) {
                        alert("请上传您的身份证反面")
                    }else if ($("#store-prove-box").find("img").length == 0){
                        alert("请上传营业执照")
                    }else {
                        $.ajax({
                            url : "/updateStore",	//请求url
                            type : "post",	//请求类型  post|get
                            dataType : "json",  //返回数据的 类型 text|json|html--
                            data: {
                                'store[name]':store_name,
                                'store[introduction]':store_brief,
                                'store[logo_pic_url]':store_logo,
                                'store[real_name]':store_id_name,
                                'store[id_card_num]':store_id_card,
                                'store[id_card_front]':store_id_just,
                                'store[id_card_backend]':store_id_back,
                                'store[prove_url]':store_prove
                            },
                            success : function(data){//回调函数 和 后台返回的 数据
                                console.log(data)
                                if (data.status){
                                    alert("店铺信息重新提交成功");
                                    window.location.href = "/wap/personal";
                                }else {
                                    alert(data.message);
                                }
                            }
                        });
                    }
                });
            }else {
                if (role_id == 3){
                    $("#store-prove-tip").css("display","none");
                    $("#store-prove-box").css("display","none");
                }
                $(".btn-store-register").click(function () {
                    var store_name = $("#store-name").val(),
                        store_brief = $("#store-brief").val(),
                        store_logo = $("#store-logo-box").find("img").attr("src"),
                        store_id_name = $("#store-id-name").val(),
                        store_id_card = $("#store-id-card").val(),
                        store_id_just = $("#sfz-just-box").find("img").attr("src"),
                        store_id_back = $("#sfz-back-box").find("img").attr("src"), store_prove;
                    if (role_id == 3){
                        store_prove = "";
                    } else {
                        store_prove = $("#store-prove-box").find("img").attr("src")
                    }
                    if (store_name == ""){
                        alert("店铺名不能为空")
                    }else if (store_brief == ""){
                        alert("请简单介绍一下自己的店铺吧")
                    }else if ($("#store-logo-box").find("img").length == 0) {
                        alert("请上传店铺logo")
                    }else if (store_id_name == "") {
                        alert("请输入您的真实姓名")
                    }else if (store_id_card == "") {
                        alert("请输入您的身份证号")
                    }else if ($("#sfz-just-box").find("img").length == 0) {
                        alert("请上传您的身份证正面")
                    }else if ($("#sfz-back-box").find("img").length == 0) {
                        alert("请上传您的身份证反面")
                    }else if ($("#store-prove-box").find("img").length == 0 && role_id != 3){
                        alert("请上传营业执照")
                    }else {
                        console.log(store_name,store_brief,store_logo,store_id_name,store_id_card,store_id_just,store_id_back,store_prove)
                        $.ajax({
                            url : "/addStore",	//请求url
                            type : "post",	//请求类型  post|get
                            dataType : "json",  //返回数据的 类型 text|json|html--
                            data: {
                                'store[name]':store_name,
                                'store[introduction]':store_brief,
                                'store[logo_pic_url]':store_logo,
                                'store[real_name]':store_id_name,
                                'store[id_card_num]':store_id_card,
                                'store[id_card_front]':store_id_just,
                                'store[id_card_backend]':store_id_back,
                                'store[role_id]':role_id,
                                'store[prove_url]':store_prove
                            },
                            success : function(data){//回调函数 和 后台返回的 数据
                                if (data.status){
                                    alert("信息提交成功，请静心等待3-5个工作日");
                                    window.location.href = "/wap/personal";
                                }else {
                                    alert(data.message);
                                }
                            }
                        });
                    }
                });
            }
        });


        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }

        function store_upload(id) {
            $.ajaxFileUpload({
                url: '/upload', //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: id, //文件上传域的ID
                dataType: 'json', //返回值类型 一般设置为json
                success: function (data){  //服务器成功响应处理函数
                    // console.log(data)
                    $("#" + id).parent().find("img").remove();
                    $("#" + id).parent().append('<img class="common-img" src="'+data.data.url+'">');
                },
                error: function (data, status, e){//服务器响应失败处理函数
                }
            });
        }
    </script>
</html>