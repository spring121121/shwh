<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞文化</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/active.css">
</head>
<body>
<div class="container">
    <header>
        <div class="activeTitle">
            <div class="goIndex" onclick="toIndex()"><img src="/images/fanhui.png" alt=""></div>
            <div class="activeNav">
                <p class="addcolor" onclick="getSginList()">全部需求</p>
                <p onclick="getWorkList()">我的需求</p>
            </div>
            <span onclick="changeHead()"><img src="/images/serch.png" alt=""></span>
        </div>
    </header>
    <div class="activeMidden">

        暂无数据

    </div>
    <div class="addhight"></div>

    <!--引入footer-->
    @extends('layout.footer')
</div>


</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>
    $(function () {
        getWorkList();
        $(".activeNav>p").click(function () {
            $(this).addClass("addcolor").siblings().removeClass("addcolor")
        })

    })

    // 我的需求列表
    function getWorkList() {
        var searchContent = $("#searchContent").val();
        $.ajax({
            type: "get",
            url: "/getDemandList",
            data: {
                "searchContent": searchContent,
            },
            async: true,
            success: function (data) {
                console.log(data)
                var middenList = "";
                data.data.forEach(function (i) {
                    middenList += ' <div class="activeContent">'
                    middenList += '<div class="activeGo">'
                    middenList += '<img src="' + i.demand_url + '" alt="" onclick="toDetail()">'
                    middenList += ' <p class="listTitle">' + i.title + '</p>'
                    middenList += '<div class="listTime">'
                    middenList += '<img src="'+i.photo+'" alt="">'
                    middenList += '<p>' + i.start_time + '-' + i.end_time + '</p>'
                    middenList += '</div>'
                    middenList += '</div>'
                    middenList += '</div>'
                })
                $(".activeMidden").html(middenList)
            }
        });
    }



    function toIndex() {
        window.location.href = "/wap/index";
    }

    function toDetail() {
        window.location.href = "/wap/activeDetail";
    }

    // 头部切换
    function changeHead() {
        var titleList = ""
        titleList += '<div class="styleSou">',
            titleList += ' <div class="souinp">',
            titleList += '<img src="/images/serch.png" alt="" onclick="getSginList()">',
            titleList += ' <input type="text" value="666" id="searchContent" placeholder="请输入作品,店铺">',
            titleList += '</div>',
            titleList += '<p onclick="changeHead2()">取消</p>',
            titleList += '</div>'
        console.log(titleList)
        $("header").html(titleList)
    }

    function changeHead2() {
        var headList = ""
        headList += '<div class="activeTitle">'
        headList += '<div class="goIndex" onclick="toIndex()"><img src="/images/fanhui.png" alt=""></div>'

        headList += '<div class="activeNav">'
        headList += '<p class="addcolor" onclick="getSginList()">全部需求</p>'

        headList += '<p onclick="getWorkList()">我的需求</p>'
        headList += ' </div>'
        headList += ' <span onclick="changeHead()"><img src="/images/serch.png" alt=""></span>'
        headList += ' </div>'
        headList += ''

        $("header").html(headList)

    }
</script>
</html>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
