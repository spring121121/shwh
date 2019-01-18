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
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="/font/iconfont.css">
    <link rel="stylesheet" href="/font/iconfont2.css"/>
    <script type="text/javascript" src="/js/iconfont.js"></script>
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
    <style>
        .icon {
            width: 1em;
            height: 1em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
        }
        .waterfall{
            /* Firefox */
            /*-moz-column-count:4; */
            /* Safari 和 Chrome */
            /*-webkit-column-count:4; */
            column-count:2;
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
    <header>
        <div id="recommend">
            <div>首页</div>
            <div id="recommend" style="display:none">
                <ul>
                    <li><a href="#">

                        </a></li>
                </ul>
            </div>
        </div>
        <div id="search">
            <div class="search_style1">
                <input type="text" placeholder="搜索你的内容与关键字" id="searchContent">
                {{--<span class="iconfont icon-sousuo" onclick="contentList();">22222</span>--}}
            </div>
            <button  onclick="contentList();">搜索</button>
            <!-- <input type="text" placeholder="提示信息">
            <span></span> -->
        </div>
    </header>
    <!--中间部分-->
    <section>
        <div id="bander">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="/images/banner1.jpg" alt=""></div>
                    <div class="swiper-slide"><img src="/images/banner2.jpg" alt=""></div>
                    <div class="swiper-slide"><img src="/images/banner3.jpg" alt=""></div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
            </div>
        </div>
        <div id="list">
            <ul>
                <li>
                    <a href="/wap/museumed">
                        <img src="/images/bwg.png" alt="">
                    </a>
                    <span>博物馆</span>
                </li>
                <li>
                    <a href="/wap/mech">
                        <img src="/images/wcjg.png" alt="">
                    </a>
                    <span>文创机构</span>
                </li>
                <li>
                    <a href="/wap/design">
                        <img src="/images/sjs.png" alt="">
                    </a>
                    <span>设计师</span>
                </li>
                <li>
                    <a href="/wap/factory123">
                        <img src="/images/gc.png" alt="">
                    </a>
                    <span>工厂</span>
                </li>
            </ul>
        </div>
        <div id="exhibition">
            <div class="exhibition_left">
                <ul class="waterfall">
                    {{--<li>--}}
                        {{--<div>--}}
                            {{--<a href="#">--}}
                                {{--<img src="/images/a4.jpg" alt="">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="exhibition_left_describe">--}}
                            {{--<h1>商品名称</h1>--}}
                            {{--<p>内容描述：内容描述：内容描述：内容描述：内容描述：内容描述：</p>--}}
                            {{--<h3>--}}
                                {{--<span>--}}
                                {{--</span>--}}
                                {{--<i>点赞</i>--}}
                                {{--<span>--}}
                                {{--</span>--}}
                                {{--<i>转发</i>--}}
                            {{--</h3>--}}
                        {{--</div>--}}

                    {{--</li>--}}

                </ul>
            </div>

        </div>
    </section>
</div>
<!--引入footer-->
@extends('layout.footer')
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script>
    $(function () {
        contentList();
    })

    function contentList() {

        var link = "/getHotNote";
        var searchContent = $("#searchContent").val();
        var contentList = "";
        if (searchContent !='') {
            link = "/searchNote/" + searchContent;
        }

        $.get(link, {}, function (data) {
            $.each(data.data, function (i, v) {
                contentList += '<li >'
                contentList += '<div>'
                contentList += '<a href="/wap/noteDetail/' + v.id + '">'
                contentList += '<img src="' + v.image_one_url + '">'
                contentList += '</a>'
                contentList += '</div>'
                contentList += '<div class="exhibition_left_describe">'
                contentList += '<h1>' + v.title + '</h1>'
                contentList += '<p>' + v.content + '</p>'
                contentList += '<h3>'
                contentList += '<span>'
                contentList += '<em  class="iconfont icon-dianzan"></em>'
                contentList += '</span>'
                contentList += '<i>点赞(' + v.likeNum + ')</i>'
                contentList += '<span>'
                contentList += '<svg class="icon" aria-hidden="true">'
                contentList += '<use xlink:href="#icon-zhuanfa"></use>'
                contentList += '</svg>'
                contentList += '</span> '
                contentList += '<i>转发(' + v.forwardNum + ')</i>'
                contentList += '</h3>'
                contentList += '</div>'
                contentList += '</li>'
            })
            $(".exhibition_left>ul").html(contentList);
        })

    }


</script>
</html>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>