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
            {{--限时抢购--}}
            <div class="flash-sale">
                <h2><em>限时抢购</em></h2>
                <p>
                    <strong class="left">9:00场</strong>
                    <span class="right">18</span>
                    <strong class="right">:</strong>
                    <span class="right">20</span>
                    <strong class="right">:</strong>
                    <span class="right">01</span>
                    <strong class="right flash-tip">距离开始还有</strong>
                </p>
                <div class="flash-sale-swiper">
                    <div class="swiper-container flash-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide flash-sale-cont">
                                <div class="limit-shop-img">
                                    <img src="/images/collection-img1.jpg" onerror="this.src='/images/collection-img1.jpg'" class="common-img">
                                </div>
                                <p>商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情</p>
                                <p>￥10.00</p>
                            </div>
                            <div class="swiper-slide flash-sale-cont">
                                <div class="limit-shop-img">
                                    <img src="/images/collection-img2.jpg" onerror="this.src='/images/collection-img2.jpg'" class="common-img">
                                </div>
                                <p>商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情</p>
                                <p>￥10.00</p>
                            </div>
                            <div class="swiper-slide flash-sale-cont">
                                <div class="limit-shop-img">
                                    <img src="/images/collection-img1.jpg" onerror="this.src='/images/collection-img1.jpg'" class="common-img">
                                </div>
                                <p>商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情</p>
                                <p>￥10.00</p>
                            </div>
                            <div class="swiper-slide flash-sale-cont">
                                <div class="limit-shop-img">
                                    <img src="/images/collection-img2.jpg" onerror="this.src='/images/collection-img2.jpg'" class="common-img">
                                </div>
                                <p>商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情</p>
                                <p>￥10.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--分类展示--}}



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
            var swiper_flash_sale = new Swiper('.flash-swiper', {
                autoplay: 3000,
                autoplayDisableOnInteraction : false,
                slidesPerView : 4,
                spaceBetween : 10,
                paginationClickable: true,
                loop: true
            });
            console.log($(".limit-shop-img").width())
            $(".limit-shop-img").css("height",$(".limit-shop-img").width()+"px");
        });
    </script>
</html>