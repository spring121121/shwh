<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>ta的主页-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header other-header">
            <div class="header-left"><a onclick="history.back()"></a></div>
            <div class="other-box">
                <div class="other-icon-box" id="other-header">
                    <img src="/images/portrait.png" onerror="this.onerror='';this.src='/images/portrait.png'"  class="common-img">
                </div>
                <h3><span id="other-nick">昵称</span><i id="other-sex"></i></h3>
                <p ><span id="other-role">地区</span><span id="other-grade">等级</span></p>
            </div>
            <ul class="flex-box other-switch">
                <li>探宝笔记</li>
                <li>点赞痕迹</li>
                <li>笔记收藏</li>
            </ul>
        </div>
        <div class="content-box">
            <!--探宝笔记-->
            <div class="note-list-box other-content other-note">
                <ul>

                </ul>
            </div>

            <!--笔记收藏-->
            <div class="note-list-box other-content other-shoucang">
                <ul>

                </ul>
            </div>


            <!--点赞痕迹-->
            <div class="note-list-box other-content other-dzhj">
                <ul>
                </ul>
            </div>
            <div class="other-home-bottom">
                <div class="btn-other btn-follow">
                    <div class="icon-box"><img src="/images/jiahao-fff.png" class="common-img"></div>
                    <span>关注</span>
                </div>
                <div class="btn-other btn-chat">
                    <div class="icon-box"><img src="/images/message.png" class="common-img"></div>
                    <span>私聊</span>
                </div>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var address_url = window.location.search;
            var other_id = address_url.substr(4);
            $.ajax({
                url : "/getOtherUserInfo/" + other_id,	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    if (data.status){
                        $("#other-nick").html(data.data.nickname);
                        $("#other-grade").html(data.data.grade);
                        $("#other-header").find("img").attr("src",data.data.photo);
                        if(data.data.sex==0){
                            $("#other-sex").css("background-image","url('../images/woman-icon-white.png')")
                        }else{
                            $("#other-sex").css("background-image","url('../images/man-icon-white.png')")
                        }
                        if (data.data.role == 0){
                            $("#other-role").html("管理员");
                        }else if (data.data.role == 1){
                            $("#other-role").html("普通用户");
                        }else if (data.data.role == 2){
                            $("#other-role").html("博物馆");
                        }else if (data.data.role == 3){
                            $("#other-role").html("设计师");
                        }else if (data.data.role == 4){
                            $("#other-role").html("文创机构");
                        }else if (data.data.role == 5){
                            $("#other-role").html("工厂");
                        }
                    }else {
                        alert("哎呀！出错了")
                    }
                    if (data.data.is_focus == 1){
                        $(".btn-follow").html('<span>已关注</span>')
                    }else {
                        $(".btn-follow").html('<div class="icon-box"><img src="/images/jiahao-fff.png" class="common-img"></div><span>关注</span>')
                    }
                }
            });
            other_cont("/getOtherNoteList/",".other-note ul",other_id);
            other_cont("/getOtherCollectNote/",".other-shoucang ul",other_id);
            other_cont("/getOtherLikeNote/",".other-dzhj ul",other_id);

        });
        function other_cont(url,cont_box,other_id) {
            $.ajax({
                url : url + other_id,	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    var noteHtml = '';
                    if (data.status){
                        if (data.status) {
                            $.each(data.data, function (k, v) {
                                noteHtml += '<li>';
                                noteHtml += '<div class="note-img"><img class="common-img" src="' + v.image_one_url + '"></div>';
                                noteHtml += '<div class="note-list-right">';
                                noteHtml += '<h3>' + v.title + '<span>' + v.created_at + '</span></h3>';
                                noteHtml += '<p>' + v.content + '</p>';
                                noteHtml += '<div class="btn-notes btn-zf"><i></i>转发(' + v.forwardNum + ')</div>';
                                noteHtml += '<div class="btn-notes btn-pl-list"><i></i>评论(' + v.commentNum + ')</div>';
                                noteHtml += '<div class="btn-notes btn-zan"><i></i>赞(' + v.likeNum + ')</div>';
                                noteHtml += '</div></li>';
                            });
                            $(cont_box).html(noteHtml)
                        }
                    }else {
                        alert("哎呀！出错了")
                    }
                }
            });
        }
    </script>
</html>