<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞文化</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/base.css">
    <link rel="stylesheet" href="/styles/style.css">
    {{--<script type="text/javascript" src="/js/iconfont.js"></script>--}}
    {{--<link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>--}}
    <style>
        .icon {
            width: 1em;
            height: 1em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
        }

        .waterfall {
            /* Firefox */
            /*-moz-column-count:4; */
            /* Safari 和 Chrome */
            /*-webkit-column-count:4; */
            column-count: 2;
            -moz-column-gap: 1em;
            -webkit-column-gap: 1em;
            column-gap: 1em;
            display: block;
        }
    </style>
</head>
<body>
<div id="home">
    <!--头部-->
    <!--<header>        
    </header>-->
    <!--中间部分-->

    <section >

        <div class="searchContainer">
            <div id="search">
                <button onclick="contentList();"></button>
                <div class="search_style1">

                    <input type="text" placeholder="搜索你的内容与关键字" id="searchContent">
                    {{--<span class="iconfont icon-sousuo" onclick="contentList();">22222</span>--}}
                </div>
            </div>
        </div>
        <div id="bander" onclick="toActive()">
            <div class="swiper-container swiper-add">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" style="overflow: hidden"><img src="/images/banner1.jpg" alt=""></div>
                    <div class="swiper-slide" style="overflow: hidden"><img src="/images/banner2.jpg" alt=""></div>
                    <div class="swiper-slide" style="overflow: hidden"><img src="/images/004.jpg" alt=""></div>
                </div>

                <div class="swiper-pagination"></div>

            </div>
        </div>
        <div id="list">
            <ul>
                <li>
                    <a href="/wap/museumOne?roleId=2">
                        <img src="/images/bwg.jpg" alt="">
                    </a>
                    <span>博物馆</span>
                </li>
                <li>
                    <a href="/wap/museumOne?roleId=4">
                        <img src="/images/wcjg.jpg" alt="">
                    </a>
                    <span>文创机构</span>
                </li>
                <li>
                    <a href="/wap/design">
                        <img src="/images/sjs.jpg" alt="">
                    </a>
                    <span>设计师</span>
                </li>
                <li>
                    <a href="/wap/museumOne?roleId=5">
                        <img src="/images/gc.jpg" alt="">
                    </a>
                    <span>工厂</span>
                </li>
            </ul>
        </div>
        <!--文创故事-->

        <div class="culture">
            <p>文创故事</p>
            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt;  loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/images/viode.mp4">
                你的浏览器不支持HTML5视频。
            </video>

        </div>
        <div class="culture">
            <p>宗教</p>

            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt;  loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/video/ren.mp4">
                你的浏览器不支持HTML5视频。
            </video>
        </div>

        {{--推荐博物馆--}}
        <div class="groomNuseum">
            <div class="groomHead">
                <p>推荐博物馆</p>
                <a href="/wap/museumOne?roleId=2">查看更多</a>
            </div>
            <div class="groomContent clearfix" id="museum">

            </div>
        </div>

        <div class="culture">
            <p>生活故事</p>
            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt;  loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/video/tong.mp4">
                你的浏览器不支持HTML5视频。
            </video>
        </div>
        <div class="culture">
            <p>地标建筑</p>

            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt;  loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/video/jianzhu.mp4">
                你的浏览器不支持HTML5视频。
            </video>
        </div>


        <div class="groomHead">
            <p>优秀设计师</p>
            <a href="/wap/design">查看更多</a>
        </div>
        <div class="swiper-container swiper-addList">
            <div class="swiper-wrapper">
                <div class="swiper-slide addbox">
                    <div class="wrapDiv">
                        <img src="/images/people.jpg" alt="">
                        <div class="wrapTitle">
                            <p>一程贰清</p>
                            <p>设计·天津</p>
                        </div>

                    </div>
                    <div class="wrapImg">
                        <img src="/images/haibao2.jpg" alt="">
                        <img src="/images/haibao3.jpg" alt="">
                    </div>
                </div>
                <div class="swiper-slide addbox">
                    <div class="wrapDiv">
                        <img src="/images/people.jpg" alt="">
                        <div class="wrapTitle">
                            <p>一程贰清</p>
                            <p>设计·天津</p>
                        </div>

                    </div>
                    <div class="wrapImg">
                        <img src="/images/haibao2.jpg" alt="">
                        <img src="/images/haibao3.jpg" alt="">
                    </div>
                </div>
                <div class="swiper-slide addbox">
                    <div class="wrapDiv">
                        <img src="/images/people.jpg" alt="">
                        <div class="wrapTitle">
                            <p>一程贰清</p>
                            <p>设计·天津</p>
                        </div>
                    </div>
                    <div class="wrapImg">
                        <img src="/images/haibao2.jpg" alt="">
                        <img src="/images/haibao3.jpg" alt="">
                    </div>
                </div>
            </div>

        </div>

        <div class="culture">
            <p>风车</p>

            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt;  loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/video/fen.mp4">
                你的浏览器不支持HTML5视频。
            </video>
        </div>
        <div class="culture">
            <p>生活故事</p>

            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt;  loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/video/phone.mp4">
                你的浏览器不支持HTML5视频。
            </video>
        </div>

        {{--文创机构推荐--}}
        <div class="groomNuseum">
            <div class="groomHead">
                <p>五星文创机构</p>
                <a href="/wap/museumOne?roleId=4">查看更多</a>
            </div>
            <div class="groomContent clearfix" id="wenchuan">
            </div>
        </div>

        <div class="culture">
            <p>工厂故事</p>
            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt;  loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/video/huo.mp4">
                你的浏览器不支持HTML5视频。
            </video>
        </div>
        <div class="culture">
            <p>动物世界</p>

            <video id="video" poster="/images/banner1.jpg" style="object-fit:cover"&gt; loop controls="controls" width="100%" height="100%" x5-playsinline="" playsinline="" webkit-playsinline="" poster="" preload="auto">
                <source src="/video/bird.mp4">
                你的浏览器不支持HTML5视频。
            </video>
        </div>

        {{--工厂推荐--}}
        <div class="groomNuseum">
            <div class="groomHead">
                <p>优质工厂</p>
                <a href="/wap/museumOne?roleId=5">查看更多</a>
            </div>
            <div class="groomContent clearfix" id="factory">
            </div>
        </div>

    </section>

</div>
<!--引入footer-->
@extends('layout.footer')
</body>


</html>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
<script>

    $(function () {
        getTuijian(2,"museum")
        getTuijian(4,"wenchuan")
        getTuijian(5,"factory")
    });

    function contentList() {
        var link = "/getHotNote";
        var searchContent = $("#searchContent").val();
        var rightHtml = "", leftHtml = "";
        if (searchContent != '') {
            link = "/searchNote/" + searchContent;
        }
        $.get(link, {}, function (data) {
            //console.log(data)
            if (data.status) {
                $.each(data.data, function (k, v) {
                    if (v.id % 2 == 0) {
                        rightHtml = flex_index(rightHtml, v);
                    } else {
                        leftHtml = flex_index(leftHtml, v);
                    }
                });
                $(".exhibition_left>ul").html(leftHtml);
                $(".exhibition_right>ul").html(rightHtml);
            } else {
                layer.msg(data.message);
            }
        });
    }

    function flex_index(obj, v) {
        obj += '<li id="' + v.id + '"><div>';
        obj += '<a href="/wap/noteDetail/' + v.id + '">';
        obj += '<img src="' + v.image_one_url + '">';
        obj += '</a></div>';
        obj += '<div class="exhibition_left_describe">';
        obj += '<p class="indexTitle">' + v.title + '</p>';
        obj += '<p>' + v.content + '</p><h3><span>';
        obj += '<em  id=dianzan-' + v.id + ' class="iconfont icon-dianzan" onclick="addLikes(' + v.id + ')"></em>';
        obj += '</span><i>点赞(<i id="likeNum-' + v.id + '">' + v.likeNum + ' </i>)</i>';
        obj += '<span onclick="addForward(' + v.uid + ',' + v.id + ')">';
        obj += '<svg class="icon" aria-hidden="true">';
        obj += '<use xlink:href="#icon-zhuanfa"></use>';
        obj += '</svg> ';
        obj += '</span>';
        obj += '<i>转发(<i id="forward-' + v.id + '">' + v.forwardNum + '</i>)</i>';
        obj += '</h3></div></li>';
        return obj;
    }

    function toActive() {
        window.location.href = "/wap/activeList";
    }
</script>
<script>
    function getTuijian(role_id, div_id) {
        $.get('/getStoreListBySearch', {'roleId': role_id, 'page': 1, 'limit': 4}, function (data) {
            var html = '';
            if (data.code == 200) {
                $.each(data.data,function (i,v) {
                    html += '<div class="groomList ">'
                    html += '<img src="'+v.logo_pic_url+'" alt="" onclick="storeDetail('+v.id+')">'
                    html += '<div class="groomInfo">'
                    html += '<img src="'+v.photo+'" alt="" onclick="toOtherHome('+v.uid+')">'
                    html += '<p>'+v.nickname+'</p>'
                    html += '</div>'
                    html += '</div>'
                })
                $("#"+div_id).html(html)
            }

        })
    }
    function storeDetail(store_id) {
        window.location.href="/wap/musename?store_id="+store_id
    }

</script>
