<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞-工厂</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/studyIndex.css">
    <link rel="stylesheet" href="/styles/base.css">
    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
    <style>
        p {
            /*border: 1px solid #ccc;*/
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .styleTitle{
            width: 50px;
        }
    </style>

</head>
<body>
<div class="container">
    <header>
        <ul>
            <li onclick="handleToindex()">
                <img src="/images/fanhui.png" alt="">
            </li>
            <li class="styleTitle">
                <p>精选</p>
                {{--<p>关注</p>--}}
            </li>
            <li>
                <span onclick="changeHead()"><img src="/images/serch.png" alt=""></span>
            </li>
        </ul>


    </header>
    <div class="noteList">
    </div>
    <div class="caseud" page="1" total="10">
        <a class="common-a" href="javascript:void(0);" >加载更多</a>
    </div>
    <div class="addhight"></div>
    <!--引入footer-->
    @extends('layout.footer')
</div>
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
<script src="/js/common.js"></script>
<script>
    $(function () {
        var limit =3;
        getNote(1, limit);
        $(".styleTitle>p").click(function () {
            $(this).addClass("addcolor").siblings().removeClass("addcolor")
        })

        $(".dzimg>img").click(function () {
            $(this).hide().siblings().show();
        })
        $(window).scroll(function () {
            if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
                var page = parseInt($(".caseud").attr('page'))
                var total = parseInt($(".caseud").attr('total'))
                var pages = Math.ceil(total / limit);
                if (page <=pages) {
                    getNote(page, limit)
                }else{
                    $(".caseud a").html("没有更多了。。。")
                }

            }
        });
    });

    function handleToindex() {
        window.location.href = "/wap/index";
    }

    // 头部切换
    function changeHead() {
        var titleList = ""
        titleList += '<div class="styleSou">',
            titleList += ' <div class="souinp">',
            titleList += '<img src="/images/serch.png" alt="">',
            titleList += ' <input type="text" placeholder="请输入关键词">',
            titleList += '</div>',
            titleList += '<p onclick="changeHead2()">取消</p>',
            titleList += '</div>'
        console.log(titleList)
        $("header").html(titleList)
    }

    function changeHead2() {
        var headList = ""
        headList += '<ul>'
        headList += ' <li onclick="handleToindex()">'
        headList += '<img src="/images/fanhui.png" alt="">'
        headList += '</li>'
        headList += '<li class="styleTitle">'
        headList += ' <p >精选</p>'
        // headList += ' <p class="addcolor">关注</p>'
        headList += ' </li>'
        headList += '<li>'
        headList += '<span onclick="changeHead()">'
        headList += '<img src="/images/serch.png" alt="">'
        headList += ' </span>'
        headList += '</li>'
        headList += '</ul>'
        $("header").html(headList)
    }



    // 笔记列表
    function getNote(page, limit) {
        $.ajax({
            type: "get",
            url: "/getHotNote",
            data: {
                'page': page,
                'limit': limit
            },
            async: true,
            success: function (data) {
                var liList = "";
                data.data.forEach(function (i) {
                    liList += '<div class="bander">';
                    liList += '<div class="swiper-container swiper-addone">';
                    liList += '<div class="swiper-wrapper" onclick="toNoteDetail('+i.id+')">';
                    liList += '<div class="swiper-slide dx-img-box"><img src="' + i.image_one_url + '" alt=""></div>';
                    // liList += '<div class="swiper-slide"><img src="' + i.image_three_url + '" alt=""></div>';
                    // liList += '<div class="swiper-slide"><img src="' + i.image_two_url + '" alt=""></div></div>';
                    liList += '</div></div>';
                    liList += '<p class="bannerTitle">' + i.content + '</p>';
                    liList += '<div class="studyPeople">';
                    liList += '<img src="'+i.photo+'" onclick="toOtherHome('+i.uid+')" alt="">';
                    liList += '<p class="bannerName">' + i.nickname + '</p>';
                    liList += '<div class="studyDz"><div class="dzimg">';
                    liList += '<em  id=dianzan-'+i.id+' class="iconfont icon-dianzan" onclick="addLikes('+i.id+')"></em>';
                    liList += '<img src="/images/dz-icon-red.png" alt="" class="redDz"></div>';
                    liList += '<p id="likeNum-'+i.id+'">'+i.likeNum+'</p>';
                    liList += '</div></div></div>';
                });
                $(".noteList").append(liList);

                $(".caseud").attr('page', parseInt(page) + 1)
                $(".caseud").attr('total', parseInt(data.total))

                var swiper = new Swiper('.swiper-addone', {
                    loop : true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    }
                });
            }
        });
    }
    function toNoteDetail(noteId) {
        window.location.href = "/wap/noteDetail/"+noteId;
    }
</script>
</html>