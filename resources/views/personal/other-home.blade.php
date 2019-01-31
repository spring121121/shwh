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
    <style>
      .content_demand{
          width: 100%;
          height: auto;
          padding: 5px;
      }
      .activeContent{
          margin-top: 45px;
      }
      .activeTitle{
          display: flex;
          flex-direction: row;
          justify-content: space-between;
          width: 90%;
          margin: 10px auto;

      }
      .activeMidden{
          width: 100%;
          height: auto;
      }

      .activeNav{
          display: flex;
          flex-direction: row;
          width: 50%;
          height: 100%;
          justify-content: space-between;
          margin-top: 6px;
          text-align: center;
      }
      .activeNav>p{
          color: #fff;
          font-size: 15px;
          text-align: center;
          width: 100%;
      }
      .navTitle{
          width: 80%;
          height: 100%;
          display: flex;
          flex-direction: row;
          justify-content: space-between;
          margin: 0 auto;
      }
      .navTitle>p{
          width: 50%;
          text-align: center;
          font-size: 16px;
          font-weight: bold;
          line-height: 35px;
      }
      .goIndex{
          width: 20px;
          height: 20px;
      }
      .goIndex>img{
          width: 100%;
          height: 100%;
      }
      .activeTitle>p{
          font-size: 16px;
          font-weight: bold;
          color: #fff;
      }
      .activeTitle>span{
          width: 25px;
          height: 25px;
      }
      .activeTitle>span>img{
          width: 100%;
          height: 100%;
      }
      .activeGo>img{
          width: 100%;
          height: 200px;
      }
      .listTitle{
          font-size: 18px;
          font-weight: bold;
          margin: 10px 0 0 15px;
      }
      .listTime{
          display: flex;
          flex-direction: row;
          margin-top: 10px;
          margin-left: 15px;
      }
      .listTime>img{
          width: 20px;
          height: 20px;
      }
      .listTime>p{
          font-size: 12px;
          color: #a2a2a2;
          margin-left: 10px;
      }
      .addhight{
          width: 100%;
          height: 55px;
      }

    </style>
    <body>
        <div class="header other-header">
            <div class="header-left"><a class="common-a" onclick="history.back()"></a></div>
            <div class="other-box">
                <div class="other-icon-box" id="other-header">
                    <img src="/images/portrait.png" onerror="this.onerror='';this.src='/images/portrait.png'"  class="common-img">
                </div>
                <h3><span id="other-nick">昵称</span><i id="other-sex"></i></h3>
                <p ><span id="other-role">地区</span><span id="other-grade">等级</span></p>
            </div>
            {{--菜单栏展示--}}
            <ul class="flex-box other-switch">

            </ul>
        </div>

            <!--内容展示-->
            {{--<div class="activeMidden">--}}

            {{--</div>--}}

            <div class="content-box">
                <!--内容展示-->
                <div class="note-list-box other-content">
                    <ul>
                    </ul>
                </div>

            </div>

        <div class="caseud" page="1" total="10">
            <a href="javascript:void(0);">加载更多</a>
        </div>
         <div class="addhight"></div>
        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
       //滚动加载列表
            var limit =10;

            $(window).scroll(function () {
                if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
                    var page = parseInt($(".caseud").attr('page'))
                    var total = parseInt($(".caseud").attr('total'))
                    var pages = Math.ceil(total / limit);
                    if (page <=pages) {
                        // getDemand(page, limit)
                    }

                }
            });

            //*************//
            var address_url = window.location.search;
             other_id = address_url.substr(4);
            console.log(other_id)
            $.ajax({
                url : "/getOtherUserInfo/" + other_id,	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据

                    console.log(data)
                    console.log("定位身份数据")
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
                            changeLi2();
                        }else if (data.data.role == 1){
                            $("#other-role").html("普通用户");

                            changeLi2();
                        }else if (data.data.role == 2){
                            $("#other-role").html("博物馆");
                            changeLi2();
                        }else if (data.data.role == 3){
                            $("#other-role").html("设计师");
                            changeLi();
                        }else if (data.data.role == 4){
                            $("#other-role").html("文创机构");
                            changeLi2();
                        }else if (data.data.role == 5){
                            $("#other-role").html("工厂");
                            changeLi2();
                        }
                    }else {
                        layer.msg("哎呀！出错了");
                    }
                    if (data.data.is_focus == 1){
                        $(".btn-follow").html('<span>已关注</span>')
                    }else {
                        $(".btn-follow").html('<div class="icon-box"><img src="/images/jiahao-fff.png" class="common-img"></div><span>关注</span>')
                    }
                }
            });
             other_cont("/getOtherNoteList/",".other-content ul",other_id);
            // other_cont("/getOtherCollectNote/",".other-content ul",other_id);
            // other_cont("/getOtherLikeNote/",".other-content ul",other_id);

        });
        function other_cont(url,cont_box,other_id) {

            $.ajax({
                url : url + other_id,	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    console.log("这个~~")
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
                        layer.msg("哎呀！出错了");
                    }
                }
            });
        }
        // 根据身份展示功能
        function changeLi() {
            var gongList="";
            noteListUrl ="/getOtherLikeNote/";
            noteListContent =".other-content ul";
             gongList+='<li class="click-change" onclick="other_cont(\'/getOtherNoteList/\',\'.other-content ul\','+other_id+')">探宝笔记</li>'
            // gongList+='<li class="click-change" onclick="other_cont('+'noteListUrl'+','+'noteListContent'+','+other_id+')">探宝笔记</li>'
            gongList+=' <li onclick="other_cont(\'/getOtherLikeNote/\',\'.other-content ul\','+other_id+')">点赞痕迹</li>'
            gongList+='<li onclick="taWorks()">作品展示</li>'
            gongList+='<li onclick="getDemand()">个人需求</li>'
            $(".other-switch").html(gongList)
        }
        function changeLi2() {
            var gongList="";
            gongList+='<li class="click-change" onclick="other_cont(\'/getOtherNoteList/\',\'.other-content ul\','+other_id+')">探宝笔记</li>'
            gongList+=' <li onclick="other_cont(\'/getOtherLikeNote/\',\'.other-content ul\','+other_id+')">点赞痕迹</li>'
            gongList+='<li onclick="getDemand()">个人需求</li>'
            $(".other-switch").html(gongList)
        }

        //他的个人需求
        function  getDemand(page, limit) {
             console.log(other_id)
            $.ajax({
                url : '/getDemandListByUid/'+other_id,	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {
                    "page":page,
                    "limit":limit
                },
                success : function(data){
                    console.log(data)
                    console.log("个人需求数据")
                    var middenList = "";
                    data.data.forEach(function (i) {
                        middenList += ' <div class="activeContent">'
                        middenList += '<div class="activeGo">'
                        middenList += '<img src="' + i.demand_url + '" alt="" onclick="toDetail('+i.id+')">'
                        middenList += ' <p class="listTitle">' + i.title + '</p>'
                        middenList += '<div class="listTime">'
                        middenList += '<img src="'+i.photo+'" alt="" onclick="toOtherHome('+i.uid+')">'
                        middenList += '<p>' + i.start_time + '-' + i.end_time + '</p>'
                        middenList += '</div>'
                        middenList += '</div>'
                        middenList += '</div>'
                    })
                    $(".other-content ul").html(middenList)

                }
            });
        }
         //他人作品展示
        function taWorks(page, limit) {
            $.ajax({
                url : '/getOtherCreationList',	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {
                    "uid":other_id,
                    "page":page,
                    "limit":limit
                },
                success : function(data){
                     console.log(data);
                    var migList = "";
                    data.data.forEach(function (i) {
                        migList += ' <div class="activeContent">'
                        migList += '<div class="activeGo">'
                        migList += '<img src="' + i.creation_urls + '" alt="" onclick="toDetail('+i.id+')">'
                        migList += ' <p class="listTitle">' + i.introduction + '</p>'
                        migList += '<div class="listTime">'
                        migList += '<img src="'+i.photo+'" alt="" onclick="toOtherHome('+i.uid+')">'
                        migList += '<p> '+i.updated_at+'</p>'
                        migList += '</div>'
                        migList += '</div>'
                        migList += '</div>'
                    })
                     console.log("他人作品数据")
                    $(".other-content ul").html(migList)

                }
            });
        }
    </script>
</html>