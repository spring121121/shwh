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
                <div class="ipt-search-box"><input type="text" placeholder="输入搜索内容"></div>
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
                    <span id="count-down-s" class="right">18</span>
                    <strong class="right">:</strong>
                    <span id="count-down-m" class="right">20</span>
                    <strong class="right">:</strong>
                    <span id="count-down-h" class="right">01</span>
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
                    <div class="swiper-wrapper" id="category">
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
            var category = '';
            $.ajax({
                url : "/categoryList/1",	//请求url 商城分类
                type : "get",	//请求类型  post|get
                async: false,
                dataType : "json",  //返回数据的 类型 text|json|html--
                data:{},
                success : function(data){//回调函数 和 后台返回的 数据
                    category += '<div class="swiper-slide one" id="0"><span>全部</span></div>';
                    $.each(data.data, function (k, v) {
                        category += '<div class="swiper-slide one" id="'+v['id']+'">';
                        category +='<span>'+v['category_name']+'</span>';
                        category += '</div>';
                    });
                    $('#category').html(category);
                }
            });
            countDown(1800);
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
            goodsList(0);
            $(".classify-list span").eq(0).css("border-bottom","1px solid #ffaa00");
            $(".classify-all").css("display","flex");
            $(".one").on("click",function () {
                $(this).find("span").css("border-bottom","1px solid #ffaa00");
                $(this).siblings().find("span").css("border-bottom","none");
                var id = $(this).attr('id');
                goodsList(id);
                $(".classify-display ul").eq($(this).attr("id")).css("display","flex");

                $(".classify-display ul").eq($(this).attr("id")).siblings().css("display","none");
            });
            $(".shop-img-box").css("height",$(".shop-img-box").width()+"px");
            $(".distribution-icon").on("click",function () {
                window.location.href = "/wap/shop_share";
            });

            $(".detail").on("click",function () {
                var id = $(this).next().val();
                window.location.href = "/wap/shop_detail?id="+id;
            });

            function goodsList(id){
                var goodsList = '';
                $.ajax({
                    url : "/getGoodsList",	//请求url 商城分类
                    type : "get",	//请求类型  post|get
                    async: false,
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data:{id:id},
                    success : function(data){//回调函数 和 后台返回的 数据
                        console.log(data);
                        $.each(data.data.data, function (k, v) {
                            var image = v['image_one'];
                            if(image == ''){
                                image = '/images/shop/default.jpg'
                            }
                            goodsList += '<li>';
                            goodsList += '<div class="shop-list-box">';
                            goodsList += '<div class="shop-img-box">';
                            goodsList += '<img src="'+image+'" class="common-img detail"><input type="hidden" value="'+v['id']+'">';
                            goodsList += '</div>';
                            goodsList += '<p><strong>'+v['goods_name']+'</strong><span>'+v['goods_info']+'</span></p>';
                            // goodsList += '<h3><i></i><span>用户名称</span></h3>';
                            goodsList += '<div class="price-box"><span>￥ '+v['price']+'</span>';
                            goodsList += '<div class="distribution-icon"></div></div></div></li>';
                        });
                        $('.classify-all').html(goodsList);
                    }
                });
            }
        });
        function handleTodetail(){
            window.location.href = "/wap/shop_detail";
        }
        function countDown(times){
            var timer=null;
            timer=setInterval(function(){
                var day=0,
                    hour=0,
                    minute=0,
                    second=0;//时间默认值
                if(times > 0){
                    day = Math.floor(times / (60 * 60 * 24));
                    hour = Math.floor(times / (60 * 60)) - (day * 24);
                    minute = Math.floor(times / 60) - (day * 24 * 60) - (hour * 60);
                    second = Math.floor(times) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                }
                if (day <= 9) day = '0' + day;
                if (hour <= 9) hour = '0' + hour;
                if (minute <= 9) minute = '0' + minute;
                if (second <= 9) second = '0' + second;

                //console.log(day+"天:"+hour+"小时："+minute+"分钟："+second+"秒");
                $("#count-down-h").html(hour);
                $("#count-down-m").html(minute);
                $("#count-down-s").html(second);
                times--;
            },1000);
            if(times<=0){
                clearInterval(timer);
            }
        }
    </script>
</html>