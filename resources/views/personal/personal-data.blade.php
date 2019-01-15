<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>个人资料-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <div class="header-right finnish-edit"></div>
            <h3 class="top-title">你的资料</h3>
        </div>
        <div class="content-box">
            <div class="ipt-cont edit-data">
                <form>
                    <div class="ipt-box">
                        <label>头像</label>
                        <div class="tx-icon-box">
                            <input type="file" class="up-img" id='source' name="source">
                            <img id="btn-my-header" src="/images/portrait.png" class="common-img">
                        </div>
                    </div>
                    <div class="ipt-box">
                        <label for="username">用户名</label>
                        <div class="ipt-cont-box"><input id="username" type="text" placeholder="用户名"></div>
                    </div>
                    <div class="ipt-box distance-top">
                        <label for="sex">性别</label>
                        <div class="ipt-cont-box">
                            <input id="1" name="sex" class="sex-choice" type="radio"><label class="sex-tip" for="1">男</label>
                            <input name="sex" class="sex-choice" id="0" type="radio"><label class="sex-tip" for="0">女</label>
                        </div>
                    </div>
                    <div class="ipt-box">
                        <label for="birthday">生日</label>
                        <div class="ipt-cont-box">
                            <input type="text" id="birthday" placeholder="2018-01-12" data-options="{'type':'YYYY-MM-DD','beginYear':1800,'endYear':2800,'location':'before'}">
                        </div>
                    </div>
                    {{--<div class="ipt-box">--}}
                        {{--<label for="region">地区</label>--}}
                        {{--<div class="ipt-cont-box"><input id="region" type="text" placeholder="天津市西青区"></div>--}}
                    {{--</div>--}}
                    <div class="ipt-box distance-top">
                        <label for="personal-phone">手机号码</label>
                        <div class="ipt-cont-box"><input id="personal-phone" disabled type="text" placeholder="15625252356"></div>
                    </div>
                    {{--<div class="ipt-box">--}}
                        {{--<label for="email">电子邮箱</label>--}}
                        {{--<div class="ipt-cont-box"><input id="email" type="text" placeholder="52535366526@qq.com"></div>--}}
                    {{--</div>--}}
                </form>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/uploadfile.js"></script>
    <script src="/js/jquery.date.js"></script>
    <script src="/js/common.js"></script>
    <script>
    $(function () {
        $.date('#birthday');
        $("#date-wrapper h3").css("background","#333");
        $("#d-confirm").css("background","#333");
        $.ajax({
            url : "/getMyUserInfo",	//请求url
            type : "get",	//请求类型  post|get
            dataType : "json",  //返回数据的 类型 text|json|html--
            data: {},
            success : function(data){//回调函数 和 后台返回的 数据

                if (data.status){
                    $("#btn-my-header").attr("src",data.data.photo);
                    $("#username").val(data.data.nickname);
                    if (data.data.sex == 0){
                        $("#0").attr("checked","checked");
                    }else {
                        $("#1").attr("checked","checked");
                    }
                    $("#birthday").val(data.data.birthday);
                    $("#personal-phone").val(data.data.mobile);
                }else {
                    alert("哎呀！出错了")
                }
            }
        });
        $("#source").on("change",function(){
            $.ajaxFileUpload({
                url: '/upload', //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: 'source', //文件上传域的ID
                dataType: 'json', //返回值类型 一般设置为json
                success: function (data){  //服务器成功响应处理函数
                    $('#btn-my-header').attr('src',data.data.url);
                },
                error: function (data, status, e){//服务器响应失败处理函数

                }
            });
        });
        $(".finnish-edit").on("click",function(){
            var img_url = $('#btn-my-header').attr('src'),
                user_name = $('#username').val(), sex,
                birthday = $('#birthday').val();
            console.log($(':radio:checked').attr("id"))
            if ($(':radio:checked').attr("id") == 1){
                sex = 1;
            }
            if ($(':radio:checked').attr("id") == 0){
                sex = 0;
            }
            console.log(img_url,user_name,birthday,sex);
            $.ajax({
                url : "/updateUserInfo",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {
                    photo:img_url,
                    nickname:user_name,
                    sex:sex,
                    birthday:birthday
                },
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    if (data.status){
                        alert("修改成功");
                        window.location.href = "/wap/personal";
                    }else {
                        alert("修改失败");
                    }
                }
            });
        });
    })
    </script>
</html>