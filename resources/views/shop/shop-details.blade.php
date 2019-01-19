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
						<div class="swiper-slide"><img class="common-img" src="/images/test.jpg"></div>
						<div class="swiper-slide"><img class="common-img" src="/images/2.jpg"></div>
						<div class="swiper-slide"><img class="common-img" src="/images/test1.jpg"></div>
					</div>
				</div>
			</div>
			{{--商品详情--}}
			<div class="zc_detailContent">
				<p class="zc_price">￥200</p>
				<del class="zc_del">价格360</del>
				<div class="zc_goodsDetail">
					<p>商品名称</p>
					<div>|</div>
					<p>商品详情</p>
				</div>
				<div class="zc_detail">
					内容详情6666666666666666666666666666666666666666666666666666666666666
				</div>
				<div class="zc_business">
					<p>快递:<span>10.0</span></p>
					<p>月销:<span>29650</span></p>
					<p>天津静海</p>
				</div>
				<div class="zc_line"></div>
				<div class="zc_businehref">
					<img src="/images/a4.jpg" />
					<div class="zc_businRank">
						<p>店铺名称</p>
						<p>店铺等级</p>
					</div>
					<div class="zc_allbusi">全部商品</div>
					<div class="zc_allbusi">进店逛逛</div>
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
					<img src="/images/dz-icon-red.png"/>
				</div>
				<div class="zc_btn">
					<div class="">加入购物车</div>
					<div class="">立即购买</div>
				</div>
			</div>

		</div>

		<!--引入footer-->
		
	</body>
	<script src="/js/jquery-3.0.0.min.js"></script>
	<script src="/js/swiper.min.js"></script>
	<script src="/js/common.js"></script>
	<script>
		$(function() {
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
			})
		});
		
		function handleToshop(){
			window.location.href = "/wap/shop";
		}
		function handletoCart(){
			window.location.href = "/wap/shop_cart";
		}
	</script>

</html>