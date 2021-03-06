<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>关注-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a class="common-a" href="/wap/personal"></a></div>
            <div class="header-right bg-add"><a class="common-a" href="javascript:void(0);"></a></div>
            <ul class="follow-title flex-box"><li>关注的人</li><li>我的粉丝</li></ul>
        </div>
        <div class="content-box">
            <!--关注的人-->
            <div class="my-concern gz-common">
                <ul class="tjgz-box" id="recommend-gz-list">
                    <li class="first-title">
                        <button id="btn-change">换一批</button>
                        <span>推荐关注</span>
                    </li>
                </ul>
                <ul class="tjgz-box" id="my-gz-list">
                    <li class="first-title">
                        <span>我的关注</span>
                    </li>
                </ul>
            </div>
            <!--我的粉丝-->
            <div class="my-fans gz-common">
                <ul class="tjgz-box fans-box" id="my-three-fans">
                    <li class="first-title">
                        <span>近三天粉丝</span>
                    </li>
                </ul>
                <ul class="tjgz-box fans-box" id="my-fans-list">
                    <li class="first-title">
                        <span>我的粉丝</span>
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
            var num = 0,num_a;
            //近三天粉丝列表
            myFansList("/beforeFansList","#my-three-fans");
            //我的粉丝列表
            myFansList("/myFansList","#my-fans-list");
            //我的关注列表
            myFansList("/myFocusList","#my-gz-list",1);
            //推荐关注列表
            recommend_list(num);
            $("#btn-change").click(function () {
                num++;
                num_a = recommend_list(num);
                if (num_a){
                    num = -1;
                }
            });
        });


        function recommend_list(num) {
            var num_init;
            $.ajax({
                url: '/recommendList',
                async: false,//同步方式发送请求，true为异步发送
                type: "get",
                data: {offset:num},
                success: function (data) {
                    console.log(data);
                    var noteHtml = '';
                    if (data.status) {
                        $.each(data.data, function (k, v) {
                            var fans_count = getFansCount(v.id);
                            noteHtml += '<li class="'+v.id+'">';
                            noteHtml += '<div class="gz-img-box"><img onerror="this.src=\'/images/portrait.png\'" src="'+ v.photo +'" class="common-img"></div>';
                            noteHtml += '<div class="gz-right">';
                            noteHtml += '<button id="'+v.id+'" onclick="addFocus('+v.id+')">关注</button>';
                            noteHtml += '<h3>' + v.nickname + '</h3>';
                            noteHtml += '<span>'+v.grade_name+'</span>';
                            noteHtml += '<p>有'+fans_count+'人关注了';
                                        if (v.sex == 1){
                                            noteHtml += '他</p>';
                                        }else if (v.sex == 0 ){
                                            noteHtml += '她</p>';
                                        }
                            noteHtml += '</div></li>';
                        });
                        $("#recommend-gz-list .first-title").siblings("li").remove();
                        $("#recommend-gz-list").append(noteHtml);

                    }
                    if (data.data.length < 3){
                        // console.log(data.data.length)
                        // $("#recommend-gz-list").append("<p class='my-fans-tip'>没有更多了</p>");
                        num_init = true;
                    }
                }
            });
            return num_init;
        }
        function myFansList(url,obj,focus) {
            $.get(url, {}, function (data) {
                console.log(data)
                var noteHtml = '';
                if (data.status) {
                    $.each(data.data, function (k, v) {
                        var fans_count = getFansCount(v.id);
                        noteHtml += '<li class="'+v.id+'">';
                        noteHtml += '<div class="gz-img-box"><img onerror="this.src=\'/images/portrait.png\'" src="'+ v.photo +'" class="common-img"></div>';
                        noteHtml += '<div class="gz-right">';
                                    if(focus == 1||v.is_focus == 1){
                                        noteHtml += '<button id="'+v.id+'" onclick="cancelFocus('+v.id+')">取关</button>';
                                    }else {
                                        noteHtml += '<button id="'+v.id+'" onclick="addFocus('+v.id+')">关注</button>';
                                    }
                        noteHtml += '<h3>' + v.nickname + '</h3>';
                        noteHtml += '<span>'+v.grade_name+'</span>';
                        noteHtml += '<p>有'+fans_count+'人关注了';
                                    if (v.sex == 1){
                                        noteHtml += '他</p>';
                                    }else if (v.sex == 0 ){
                                        noteHtml += '她</p>';
                                    }
                        noteHtml += '</div></li>';
                    });
                    $(obj).append(noteHtml);
                }
            });
        }

        function getFansCount(id){//获取粉丝数量
            var fans_count = 0;
            $.ajax({
                url: '/myFans',
                async: false,//同步方式发送请求，true为异步发送
                type: "get",
                data: {uid:id},
                success: function (data) {
                    fans_count = data.data.count;
                }
            });
            return fans_count;
        }
        //取消关注
        function cancelFocus(uid) {
            $.post("/cancelFocus",{'uid':uid},function(data){
                if (data.status){
                    layer.msg('已取消关注', {
                        time: 3000 //不自动关闭
                    },function () {
                        window.location.reload();
                    });
                    $("#"+uid).bind('click',function(){
                        addFocus(uid);
                    });
                    $("#"+uid).html("关注")

                }else {
                    layer.msg(data.message)
                }
            })
        }

        //添加关注
        function addFocus(uid) {
            $.post("/focus",{'uid':uid},function(data){
                if (data.status){
                    layer.msg('关注成功', {
                        time: 3000 //不自动关闭
                    },function () {
                        window.location.reload();
                    });
                    $("#"+uid).bind('click',function(){
                        cancelFocus(uid);
                    });
                    $("#"+uid).html("取关")
                }else {
                    layer.msg(data.message)
                }
            })
        }
    </script>
</html>