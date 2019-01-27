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
    <!--<header>        
    </header>-->
    <!--中间部分-->
    <section>
        <div class="searchContainer">	     
        <div id="search">
            <button  onclick="contentList();"></button>
            <div class="search_style1">
            	 
                <input type="text" placeholder="搜索你的内容与关键字" id="searchContent">
                {{--<span class="iconfont icon-sousuo" onclick="contentList();">22222</span>--}}
            </div>
        </div>
       </div>
        <div id="bander" onclick="toActive()">
            <div class="swiper-container swiper-add">
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
                    <a href="/wap/museumOne?roleId=2">
                        <img src="/images/bwg.jpg" alt="">
                    </a>
                    <span >博物馆</span>
                </li>
                <li>
                    <a href="/wap/museumOne?roleId=4">
                        <img src="/images/wcjg.jpg" alt="">
                    </a>
                    <span >文创机构</span>
                </li>
                <li>
                    <a href="/wap/design">
                        <img src="/images/sjs.jpg" alt="">
                    </a>
                    <span >设计师</span>
                </li>
                <li>
                    <a href="/wap/museumOne?roleId=5">
                        <img src="/images/gc.jpg" alt="">
                    </a>
                    <span >工厂</span>
                </li>
            </ul>
        </div>
        <!--文创故事-->
        <div class="culture">
        	<p>文创故事</p>
                <video src="/images/viode.mp4" controls="controls" width="100%" height="100%" >
                    your browser does not support the video tag
                </video>
            </div>
        <div class="culture">
            <p>文创故事</p>
            <video src="/images/viode.mp4" controls="controls" width="100%" height="100%" >
                your browser does not support the video tag
            </video>
        </div>
        <div class="culture">
            <p>文创故事</p>
            <video src="/images/viode.mp4" controls="controls" width="100%" height="100%" >
                your browser does not support the video tag
            </video>
        </div>
        <div class="culture">
            <p>文创故事</p>
            <video src="/images/viode.mp4" controls="controls" width="100%" height="100%" >
                your browser does not support the video tag
            </video>
        </div>

        <!--发布需求-->
        <div class="demand">
        	<p></p>
        </div>
        
        {{--<div id="exhibition">--}}
            {{--<div class="exhibition_left">--}}
                {{--<ul></ul>--}}
            {{--</div>--}}
            {{--<div class="exhibition_right">--}}
                {{--<ul></ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    </section>
</div>
<!--引入footer-->
@extends('layout.footer')
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>

    $(function () {
        contentList();
    });

    function contentList() {
        var link = "/getHotNote";
        var searchContent = $("#searchContent").val();
        var rightHtml = "",leftHtml = "";
        if (searchContent !='') {
            link = "/searchNote/" + searchContent;
        }
        $.get(link, {}, function (data) {
            console.log(data)
            if (data.status) {
                $.each(data.data, function (k, v) {
                    if(v.id%2 == 0){
                        rightHtml = flex_index(rightHtml,v);
                    }else {
                        leftHtml = flex_index(leftHtml,v);
                    }
                });
                $(".exhibition_left>ul").html(leftHtml);
                $(".exhibition_right>ul").html(rightHtml);
            }else {
                alert(data.message);
            }
        });
    }
    function flex_index(obj,v) {
        obj += '<li id="'+v.id+'"><div>';
        obj += '<a href="/wap/noteDetail/' + v.id + '">';
        obj += '<img src="' + v.image_one_url + '">';
        obj += '</a></div>';
        obj += '<div class="exhibition_left_describe">';
        obj += '<p class="indexTitle">' + v.title + '</p>';
        obj += '<p>' + v.content + '</p><h3><span>';
        obj += '<em  id=dianzan-'+v.id+' class="iconfont icon-dianzan" onclick="addLikes('+v.id+')"></em>';
        obj += '</span><i>点赞(<i id="likeNum-'+v.id+'">'+ v.likeNum +' </i>)</i>';
        obj += '<span onclick="addForward('+v.uid+','+v.id+')">';
        obj += '<svg class="icon" aria-hidden="true">';
        obj += '<use xlink:href="#icon-zhuanfa"></use>';
        obj += '</svg> ';
        obj += '</span>';
        obj += '<i>转发(<i id="forward-'+v.id+'">' + v.forwardNum + '</i>)</i>';
        obj += '</h3></div></li>';
        return obj;
    }

    function toActive() {
        window.location.href = "/wap/activeList";
    }
</script>
</html>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
<script>

</script>