<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>首页-商城首页</title>

        <link rel="stylesheet" href="/styles/swiper.min.css">
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
                            <div class="swiper-slide flash-sale-cont" onclick="handleTodetail()">
                                <div class="limit-shop-img">
                                    <img src="/images/collection-img2.jpg" onerror="this.src='/images/collection-img1.jpg'" class="common-img">
                                </div>
                                <p>商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情</p>
                                <p>￥10.00</p>
                            </div>
                            <div class="swiper-slide flash-sale-cont" onclick="handleTodetail()">
                                <div class="limit-shop-img">
                                    <img src="/images/collection-img2.jpg" onerror="this.src='/images/collection-img2.jpg'" class="common-img">
                                </div>
                                <p>商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情</p>
                                <p>￥10.00</p>
                            </div>
                            <div class="swiper-slide flash-sale-cont" onclick="handleTodetail()">
                                <div class="limit-shop-img">
                                    <img src="/images/collection-img2.jpg" onerror="this.src='/images/collection-img1.jpg'" class="common-img">
                                </div>
                                <p>商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情商品详情</p>
                                <p>￥10.00</p>
                            </div>
                            <div class="swiper-slide flash-sale-cont" onclick="handleTodetail()">
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
            <div class="classify-list">
                <div class="swiper-container classify-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" id="0"><span>全部</span></div>
                        <div class="swiper-slide" id="1"><span>饰品</span></div>
                        <div class="swiper-slide" id="2"><span>服饰</span></div>
                        <div class="swiper-slide" id="3"><span>文具</span></div>
                        <div class="swiper-slide" id="4"><span>书画</span></div>
                        <div class="swiper-slide" id="5"><span>瓷器</span></div>
                        <div class="swiper-slide" id="6"><span>家具</span></div>
                    </div>
                </div>
            </div>
            <div class="classify-display">
                <ul class="classify-all">
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img2.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img2.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img2.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img2.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                </ul>

                {{--饰品列表--}}
                <ul class="classify-ornament">
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img1.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img1.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img1.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                    <li>
                        <div class="shop-list-box">
                            <div class="shop-img-box">
                                <img src="/images/collection-img1.jpg" class="common-img">
                            </div>
                            <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                            <h3><i></i><span>用户名称</span></h3>
                            <div class="price-box"><span>￥20.00</span><div class="distribution-icon"></div></div>
                        </div>
                    </li>
                </ul>
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
            var swiper_flash_sale = new Swiper('.flash-swiper', {
                autoplay: 3000,
                autoplayDisableOnInteraction : false,
                slidesPerView : 4,
                spaceBetween : 10,
                paginationClickable: true,
                loop: true
            });
            $(".limit-shop-img").css("height",$(".limit-shop-img").width()+"px");
            var swiper_classify = new Swiper('.classify-swiper', {
                slidesPerView : 6,
                spaceBetween : 10
            });

            for (var i=0;i<$(".classify-display li").length;i++){
                if (i%2 == 0){
                    $(".shop-list-box").eq(i).css({"margin-left":"unset","margin-right":"5px"})
                }
            }

            // 点击分类显示相应内容
            $(".classify-list span").eq(0).css("border-bottom","1px solid #ffaa00");
            $(".classify-all").css("display","flex");
            $(".classify-list").on("click",".swiper-slide",function () {
                $(this).find("span").css("border-bottom","1px solid #ffaa00");
                $(this).siblings().find("span").css("border-bottom","none");
                $(".classify-display ul").eq($(this).attr("id")).css("display","flex")
                $(".classify-display ul").eq($(this).attr("id")).siblings().css("display","none")
            });
            $(".shop-img-box").css("height",$(".shop-img-box").width()+"px");
        });
        function handleTodetail(){
            window.location.href = "/wap/shop_detail";
        }
    </script>
</html>