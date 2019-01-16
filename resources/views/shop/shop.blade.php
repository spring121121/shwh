<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>首页-商城首页</title>

        <link rel="stylesheet" href="/styles/swiper.min.css">
        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/shop-header.css">
        <link rel="stylesheet" href="/styles/shop.css">
    </head>
    <body>
        <div class="index-header header">
            <div class="common-header-left"></div>
            <div class="common-header-right"></div>
            <div class="search-box">
                <div class="ipt-icon"></div>
                <div class="ipt-search-box"><input type="text" placeholder="输入商品名称"></div>
            </div>
        </div>
        <div class="content-box">
            <div class="swiper-box">
                <div class="swiper-container shop-index">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img class="common-img" src="/images/test.jpg"></div>
                        <div class="swiper-slide"><img class="common-img" src="/images/2.jpg"></div>
                        <div class="swiper-slide"><img class="common-img" src="/images/test1.jpg"></div>
                    </div>
                </div>
            </div>
            <div class="flash-sale">
                <h2>限时抢购</h2>

            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/swiper.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var swiper_shop = new Swiper('.shop-index', {
                autoplay:3000,
                paginationClickable: true,
                loop: true
            });
        });
    </script>
</html>