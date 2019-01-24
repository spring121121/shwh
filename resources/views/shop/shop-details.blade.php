<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>首页-商城首页</title>

		<link rel="stylesheet" href="/styles/swiper.min.css">
		<link rel="stylesheet" href="/styles/common.css">
		<link rel="stylesheet" href="/styles/shop-header.css">
		<link rel="stylesheet" href="/styles/shop.css">
	</head>

	<body>
		<div class="index-header header">
			<div class="common-header-left" onclick="handleToshop()"><img src="/images/fanhui.jpg"/></div>
			<div class="zc_right" onclick="handletoCart()"><img  src="/images/shop/shop-cart.png"/></div>
		</div>
		<div class="content-box">
			<div class="swiper-box">
				<div class="swiper-container shop-index">
					<div class="swiper-wrapper">
						{{--<div class="swiper-slide"><img class="common-img" src="/images/test.jpg"></div>--}}
						{{--<div class="swiper-slide"><img class="common-img" src="/images/2.jpg"></div>--}}
						{{--<div class="swiper-slide"><img class="common-img" src="/images/test1.jpg"></div>--}}
					</div>
				</div>
			</div>
			{{--商品详情--}}
			<div class="zc_detailContent">
                <div id="sp_detail">
                    {{--<p class="zc_price">￥200</p>--}}
                    {{--<del class="zc_del">价格360</del>--}}
                    {{--<div class="zc_goodsDetail">--}}
                        {{--<p>商品名称</p>--}}
                        {{--<div>|</div>--}}
                        {{--<p>商品详情</p>--}}
                    {{--</div>--}}
                    {{--<div class="zc_detail">--}}
                        {{--内容详情6666666666666666666666666666666666666666666666666666666666666--}}
                    {{--</div>--}}
                    {{--<div class="zc_business">--}}
                        {{--<p>快递:<span>10.0</span></p>--}}
                        {{--<p>月销:<span>29650</span></p>--}}
                        {{--<p>天津静海</p>--}}
                    {{--</div>--}}
                </div>
				<div class="zc_line"></div>
				<div class="zc_businehref">
                    <input type="hidden" id="store_id" value="">
					{{--<img src="/images/a4.jpg" />--}}
					{{--<div class="zc_businRank">--}}
						{{--<p>店铺名称</p>--}}
						{{--<p>店铺等级</p>--}}
					{{--</div>--}}
					{{--<div class="zc_allbusi">全部商品</div>--}}
					{{--<div class="zc_allbusi">进店逛逛</div>--}}
				</div>
				<div class="zc_business">
					<p>宝贝描述:<span>4.9</span></p>
					<p>买卖服务:<span>4.5</span></p>
					<p>物流服务:
						<pan>4.8</pan>
					</p>
				</div>
				<div class="zc_line"></div>
			</div>
			<p class="zc_contentNext">商品详情</p>

			{{--商品详情图--}}
			<div class="zc_goodsimg">
				<img src="/images/1.jpg" />
			</div>
			<div class="zc_contentBottom">
				<img class="zc_bussimg" src="/images/a4.jpg"/>
				<div class="zc_Collection">
					<img src="/images/dz-icon.png"/>
					{{--<img src="/images/dz-icon-red.png"/>--}}
				</div>
				<div class="zc_btn">
					<div class="addCar">加入购物车</div>
					<div class="">立即购买</div>
				</div>
			</div>

		</div>
		<input type="hidden" value="{{$id}}" id="uid">
		<!--引入footer-->
		
	</body>
	<script src="/js/jquery-3.0.0.min.js"></script>
	<script src="/js/swiper.min.js"></script>
	<script src="/js/common.js"></script>
	<script>
		$(function() {

            var categoryDetail = '';
            var store = '';
            var splideImg = '';
            var id = getUrlParam('id');
            $.ajax({
                url : "/getGoodsDetail",	//请求url 商城分类
                type : "get",	//请求类型  post|get
                async: false,
                dataType : "json",  //返回数据的 类型 text|json|html--
                data:{id:id},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data);
                    $.each(data.data, function (k, v) {
                        //轮播图
                        splideImg += '<div class="swiper-slide"><img class="common-img" src="'+v['image_one']+'"></div>';
                        splideImg += '<div class="swiper-slide"><img class="common-img" src="'+v['image_two']+'"></div>';
                        splideImg += '<div class="swiper-slide"><img class="common-img" src="'+v['image_three']+'"></div>';
                        splideImg += '<div class="swiper-slide"><img class="common-img" src="'+v['image_four']+'"></div>';
                        //详情
						categoryDetail += '<input type="hidden" id="goods_id" value="'+v['id']+'">';
                        categoryDetail += '<p class="zc_price">￥'+v['price']+'</p>';
                        categoryDetail += '<del class="zc_del">价格'+v['price']+'</del>';
                        categoryDetail += '<div class="zc_goodsDetail">';
                        categoryDetail += '<p>'+v['goods_name']+'</p><div></div><p></p>';
                        categoryDetail += '</div>';
                        categoryDetail += '<div class="zc_detail">'+v['goods_info']+'</div>';
                        categoryDetail += '<div class="zc_business"><p>快递:<span>￥'+v['postage']+'</span></p> <p>月销:<span>29650</span></p> <p>天津静海</p></div>';

                        $('#store_id').val(v['store_id']);
                    });
                    $('.swiper-wrapper').html(splideImg);
                    $('#sp_detail').html(categoryDetail);
                }
            });
            var storeId = $('#store_id').val();
            $.ajax({
                url : "/getStoreDetail",	//请求url 商城分类
                type : "get",	//请求类型  post|get
                async: false,
                dataType : "json",  //返回数据的 类型 text|json|html--
                data:{id:storeId},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data);
                    $.each(data.data, function (k, v) {
                        store += '<img src="'+v['logo_pic_url']+'" />';
                        store += '<div class="zc_businRank">';
                        store += '<p>'+v['name']+'</p>';
                        store += '</div><div class="zc_allbusi">进店逛逛</div>';

                        $('.zc_bussimg').attr('src',v['logo_pic_url']);
                    });
                    $('.zc_businehref').html(store);
                }
            });

			var swiper_shop = new Swiper('.shop-index', {
				autoplay: 3000,
				paginationClickable: true,
				loop: true
			});
			var swiper_flash_sale = new Swiper('.flash-swiper', {
				autoplay: 3000,
				autoplayDisableOnInteraction: false,
				slidesPerView: 4,
				spaceBetween: 10,
				paginationClickable: true,
				loop: true
			});
			var swiper_classify = new Swiper('.classify-swiper', {
				slidesPerView: 6,
				spaceBetween: 10
			});
			
			$(".zc_Collection>img").click(function(){
				$(this).hide().siblings().show()
			});
            //我的购物车页面
            var uid = $('#uid').val();
			$('.zc_right').on('click',function(){
                if(uid == 0){
                    window.location.href = "/wap/login_index";
                    return false;
                }
                window.location.href = "/wap/shop_cart";
            });
            //加入购入车
            $('.addCar').on('click',function(){
                var goods_id = $('#goods_id').val();
                if(uid == 0){
                    window.location.href = "/wap/login_index";
                    return false;
				}
                $.ajax({
                    url : "/addCar",	//请求url 商城分类
                    type : "post",	//请求类型  post|get
                    async: false,
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data:{id:goods_id},
                    success : function(data){//回调函数 和 后台返回的 数据
                        if(!data.status){
                            alert(data.data);
						}else{
                            alert('加入成功！');
						}
                    }
                });
            });
		});
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }

		function handleToshop(){
			window.location.href = "/wap/shop";
		}
		function handletoCart(){
			window.location.href = "/wap/shop_cart";
		}
	</script>

</html>