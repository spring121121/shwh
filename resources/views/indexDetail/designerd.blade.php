<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞-设计师</title>
    <link rel="stylesheet" href="/styles/designerd.css">
    <link rel="stylesheet" type="text/css" href="/font/iconfont2.css"/>
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
    <link rel="stylesheet" href="/styles/common.css">
</head>
<body>
<div id="home">
    <header>
        <ul>
            <li>
                <!--<a href="../index.html">
                </a>-->
                <span onclick="history.back()" class="iconfont icon-ffanhui-"></span>
            </li>
            <li>设计师</li>
            <li>
                <span class="iconfont icon-sousuo" onclick="getCreationList(1,10)"></span>
                <input type="text" value="" id="searchContent">
            </li>
        </ul>
    </header>
    <div class="bigContainer">
        <div id="museum_shop">
            <ul class="designList" id="designList">

            </ul>
        </div>
    </div>
    <div class="caseud" page="1" total="">
        <a href="javascript:void(0);">加载更多</a>
    </div>
    <div class="addhight"></div>

</div>
@extends('layout.footer')
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>

    $(function () {
        var limit = 10;
        getCreationList(1, limit);
        $(window).scroll(function () {
            if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
                var page = parseInt($(".caseud").attr('page'))
                var total = parseInt($(".caseud").attr('total'))
                var pages = Math.ceil(total / limit);
                if (page <= pages) {
                    getNote(page, limit)
                } else {
                    $(".caseud a").html("没有更多了。。。")
                }

            }
        });
    })


    function getCreationList(page, limit) {
        var searchContent = $("#searchContent").val()
        $.get("/getCreationList", {'searchContent': searchContent, 'page': page, 'limit': limit}, function (data) {
            var html = '';
            if (data.code == 200) {
                data.data.forEach(function (v) {
                    var creation_urls_arr = [];
                    html += '<li class="listContent">'
                    html += '<div class="listPeople">'
                    html += '<div class="peopleImg" onclick="toOtherHome(' + v.uid + ')">'
                    html += '<img  src="' + v.photo + '"/>'
                    html += '</div>'
                    html += '<div class="peopleText" id="div-focus">'
                    html += '<p class="peopleName">' + v.nickname + '</p>'
                    html += '<p class="peopleDetail">设计师•粉丝:<span>' + v.num + '</span></p>'
                    html += '</div>'
                    if (v.is_focus) {
                        html += '<div class="peopleBtn" onclick="cancelFocus(' + v.uid + ')" id="focus-' + v.uid + '">取关</div>'
                    } else {
                        html += '<div class="peopleBtn" onclick="addFocus(' + v.uid + ')" id="focus-' + v.uid + '">关注</div>'
                    }

                    html += '</div>'
                    html += '<div class="workShow">'
                    creation_urls_arr = v.creation_urls.split(';')
                    $.each(creation_urls_arr, function (i, v) {
                        html += '<img src="' + v + '"/>'
                    })
                    html += '</div>'
                    html += '</li>'

                })
                $(".caseud").attr('page', parseInt(page) + 1)
                $(".caseud").attr('total', parseInt(data.total))
                $("#designList").html(html)
            } else {
                alert(data.message);
            }
        })
    }

    //添加关注
    function addFocus(uid) {
        $.post("/focus", {'uid': uid}, function (data) {
            if (data.status) {
                alert("关注成功");
                $("#focus-" + uid).html("取关")
                $("#focus-" + uid).attr('onclick',"cancelFocus("+uid+")")

            } else {
                alert("哎呀！出错了")
            }
        })
    }

    //取消关注
    function cancelFocus(uid) {
        $.post("/cancelFocus", {'uid': uid}, function (data) {
            if (data.status) {
                alert("取关成功");
                $("#focus-" + uid).html("关注")
                $("#focus-" + uid).attr('onclick',"addFocus("+uid+")")

            } else {
                alert("哎呀！出错了")
            }
        })
    }
</script>
</html>


