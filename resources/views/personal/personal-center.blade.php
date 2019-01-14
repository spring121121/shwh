<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>个人中心-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <!--头像和昵称的模块-->
        <div class="personal-header">
            <div class="personal-title">
                <div class="portrait-box">
                    <img class="common-img" id = "photo" src="" alt="头像" onerror="this.src='/images/portrait.png'">
                </div>
                <div class="edit-personal">
                    <a class="btn-edit" href="/wap/message_center"></a>
                    <h3 id="nickname">输入你的昵称</h3>
                    <a class="edit-your-data" href="/wap/personal_data"><span>编辑你的资料 <i></i></span></a>
                </div>
                <ul class="address-grade">
                    <li>
                        <div class="personal-icon-box"><img id="sex-img" src="/images/man-icon-white.png" class="common-img"></div>
                        <span id="sex">男</span>
                    </li>
                    <em></em>
                    <li>
                        <div class="personal-icon-box"><img class="common-img" src="../images/grade.png" /></div>
                        <span id="grade"></span>
                    </li>
                </ul><em></em>
                {{--<div class="change-address">--}}
                    {{--<div class="personal-icon-box"><img class="common-img" src="../images/location.png" /></div>--}}
                    {{--<span>天津市 西青</span>--}}
                {{--</div>--}}
            </div>
        </div>
        <!--个人中心内容模块-->
        <div class="personal-cont">
            <ul>
                <li>
                    <a href="/wap/my_note">
                        <div class="icon-img"><img class="common-img" src="../images/note.png" alt="笔记"></div>
                        <p>笔记</p>
                    </a>
                </li>
                <li>
                    <a href="/wap/collection">
                        <div class="icon-img"><img class="common-img" src="../images/collection.png" alt="收藏"></div>
                        <p>收藏</p>
                    </a>
                </li>
                <li id="personal-store">
                    <a href="javascript:void(0)">
                        <div class="icon-img"><img class="common-img" src="../images/store.png" alt="店铺"></div>
                        <p>店铺</p>
                    </a>
                </li>
                <li>
                    <a href="/wap/follow_interest">
                        <div class="icon-img"><img class="common-img" src="../images/follow.png" alt="关注"></div>
                        <p>关注</p>
                    </a>
                </li>
            </ul>
            <div class="list-box">
                {{--<div class="list-cont">--}}
                    {{--<a href="/wap/coupon">--}}
                        {{--<span>我的优惠券</span>--}}
                        {{--<i></i>--}}
                    {{--</a>--}}
                {{--</div>--}}
                <div class="list-cont">
                    <a href="/wap/my_order">
                        <span>我的订单</span>
                        <i></i>
                    </a>
                </div>
                <div class="list-cont">
                    <a href="/wap/my_address">
                        <span>我的收货地址</span>
                        <i></i>
                    </a>
                </div>
            </div>
            <div class="list-box">
                <div class="list-cont">
                    <a href="/wap/feedback">
                        <span>意见反馈</span>
                        <i></i>
                    </a>
                </div>
            </div>
            <div class="btn-exit-login">
                <button class="btn-delete">退出登录</button>
            </div>
            {{--<div class="choice-address">--}}
                {{--<p id="address-tip"><span></span><span></span><span></span></p>--}}
                {{--<ul id="province"></ul>--}}
                {{--<ul id="city"></ul>--}}
                {{--<ul id="area"></ul>--}}
                {{--<div class="btn-finish">--}}
                    {{--<div class="finish-return" id="return-finish">取消</div>--}}
                    {{--<div class="finish-return" id="finish-sure">确定</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="mask-box">
            <div class="weChat del-order">
                <span>确定退出登录吗？</span>
                <div class="btn-mask">
                    <button class="btn-del-false">取消</button>
                    <button id="btn-logout-true">确定</button>
                </div>
            </div>
        </div>

    
        <!--引入footer-->
        @extends('layout.footer')
    {{--<div class="get-cookie" id="{{$store_status}}">{{$store_id}}</div>--}}
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var store_id,store_status;
            $.get('/getMyUserInfo',{},function(data){
                console.log(data)
                if (data.status){
                    store_id = data.data.store_id;
                    store_status = data.data.store_status;
                    $("#photo").attr("src",data.data.photo)
                    if (data.data.nickname == ''){
                        $("#nickname").html("请修改您的昵称")
                    } else {
                        $("#nickname").html(data.data.nickname)
                    }
                    if(data.data.sex==0){
                        $("#sex").html('女')
                        $("#sex-img").attr("src","/images/woman-icon-white.png")
                    }else{
                        $("#sex-img").attr("src","/images/man-icon-white.png")
                        $("#sex").html('男')
                    }
                    $("#grade").html(data.data.grade);
                }else {
                    alert("哎呀！出错了")
                }
            });


            // 点击店铺时判断进入
            $("#personal-store").click(function () {
                console.log(store_id,store_status)
                if (store_id == 0){
                    window.location.href = "/wap/store_status?id="+store_status;
                } else {
                    if (store_status < 3){
                        if (store_status == 1) {
                            window.location.href = "/wap/store";
                        }else {
                            window.location.href = "/wap/store_status?id="+store_status;
                        }
                    }
                }
            });

            //退出登录
            $("#btn-logout-true").click(function () {
                $.get('/logout',{},function(data){
                    window.location.reload();
                });
            });
            // $(".change-address").click(function () {//点击获取省
            //     $(".choice-address").css("display","block");
            //     $.ajax({
            //         url : "/getAllProvinces",	//请求url
            //         type : "get",	//请求类型  post|get
            //         dataType : "json",  //返回数据的 类型 text|json|html--
            //         data: {},
            //         success : function(data){//回调函数 和 后台返回的 数据
            //             var noteHtml = '';
            //             if (data.status){
            //                 $.each(data.data, function (k, v) {
            //                     noteHtml += '<li id="'+v.provinceid+'">'+v.province+'</li>';
            //                 });
            //                 $("#province").html(noteHtml);
            //             }else {
            //                 alert("哎呀！出错了")
            //             }
            //         }
            //     });
            // });
            // $("#province").on("click","li",function () {
            //     $("#city li").remove();
            //     $("#area li").remove();
            //     $("#address-tip").find("span").eq(0).html($(this).text());
            //     $("#address-tip").find("span").eq(0).siblings().html("");
            //     var proviceid = $(this).attr("id");
            //     $.ajax({
            //         url : "/getCitiesByProvince/" + proviceid,	//请求url
            //         type : "get",	//请求类型  post|get
            //         dataType : "json",  //返回数据的 类型 text|json|html--
            //         data: {},
            //         success : function(data){//回调函数 和 后台返回的 数据
            //             var noteHtml = '';
            //             if (data.status){
            //                 $.each(data.data, function (k, v) {
            //                     noteHtml += '<li id="'+v.cityid+'">'+v.city+'</li>';
            //                 });
            //                 $("#city").html(noteHtml);
            //             }else {
            //                 alert("哎呀！出错了")
            //             }
            //         }
            //     });
            // });
            // $("#city").on("click","li",function () {
            //     $("#area li").remove();
            //     $("#address-tip").find("span").eq(1).html($(this).text());
            //     var cityid = $(this).attr("id");
            //     $.ajax({
            //         url : "/getAreasByCityId/" + cityid,	//请求url
            //         type : "get",	//请求类型  post|get
            //         dataType : "json",  //返回数据的 类型 text|json|html--
            //         data: {},
            //         success : function(data){//回调函数 和 后台返回的 数据
            //             var noteHtml = '';
            //             if (data.status){
            //                 $.each(data.data, function (k, v) {
            //                     noteHtml += '<li>'+v.area+'</li>';
            //                 });
            //                 $("#area").html(noteHtml);
            //             }else {
            //                 alert("哎呀！出错了")
            //             }
            //         }
            //     });
            // });
            // $("#area").on("click","li",function () {
            //     $("#address-tip").find("span").eq(2).html($(this).text());
            // });
            // $("#finish-sure").click(function () {
            //     var text1 = $("#address-tip").find("span").eq(0).html();
            //     var text2 = $("#address-tip").find("span").eq(1).html();
            //     var text3 = $("#address-tip").find("span").eq(2).html();
            //     if (text1==text2){
            //         $(".change-address span").html("<span>"+text2+"</span><span>"+text3+"</span>");
            //     }else {
            //         $(".change-address span").html("<span>"+text1+"</span><span>"+text2+"</span><span>"+text3+"</span>");
            //     }
            //     $(".choice-address").css("display","none");
            //     $("#address-tip").find("span").html("");
            //     $("#province li").remove();
            //     $("#city li").remove();
            //     $("#area li").remove();
            // });
            // $("#return-finish").click(function () {
            //     $(".choice-address").css("display","none");
            //     $("#address-tip").find("span").html("");
            //     $("#province li").remove();
            //     $("#city li").remove();
            //     $("#area li").remove();
            // });
        });
    </script>
</html>