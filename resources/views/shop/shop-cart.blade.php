<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>首页-商城首页</title>

		<link rel="stylesheet" href="/styles/swiper.min.css">
		<link rel="stylesheet" href="/styles/common.css">
		<link rel="stylesheet" href="/styles/shop-header.css">
		<link rel="stylesheet" href="/styles/shop.css">

		<style>
			.store_parent{
				background: #eeeeee;
				border-radius:10px;
				margin-bottom:15px;
			}
			.store_div{
				margin-left:10px;
			}
			.store_height{
				height:15px;
			}
			.store_nameDiv{
				height:30px;
			}
			.store_checkbox{
				float:left;
			}
			.store_name{
				float:left;
				margin-left:10px;
				font-size:18px;
			}
			.store_img{
				float:right;
			}
			.store_image{
				width:30px;
				height:30px;
			}
			.car_div{
				height:100px;
				margin-top:20px;
			}
			.car_img{
				float:left;
				margin-left:10px;
				margin-right:10px;
			}
			.car_image{
				width:80px;
				height:80px;
				border-radius:10px;
			}
			.car_{
				font-size:12px;
				margin-top:8px;
			}
			.car_price{
				font-size:12px;
			}
			.car_num{
				float:right;
				margin-top:60px;
				margin-right:10px;
			}
			.img_height{
				height:25px;
			}
		</style>
	</head>
	<body>
		<div class="index-header header">
			<div class="common-header-left" onclick="handleToshop()"><img src="/images/fanhui.jpg"/></div>
			<p class="zc_cartitle">购物车</p>
			{{--<div class="zc_right" ><img  src="/images/shop/shop-cart.png"/></div>--}}
		</div>
		<div class="zc_carGoods">
			<div class="store_parent">
				<div class="store_div">
					<div class="store_height"></div>
					<div class="store_nameDiv">
						<div class="store_checkbox">
							<input class="zc-checkbox" type="checkbox" />
						</div>
						<div class="store_name">店铺名称</div>
						<div class="store_img">
							<img class="store_image" src="/images/right.png"/>
						</div>
					</div>

					<div class="car_div">
						<div class="store_checkbox">
							<div class="img_height"></div>
							<input class="zc-checkbox" type="checkbox" />
						</div>
						<div class="car_img">
							<img class="car_image" src="/images/a4.jpg"/>
						</div>
						<div class="store_checkbox">
							<p>商品名称</p>
							<p>商品内容</p>
							<p class="car_">175cm,88公斤</p>
							<p class="car_price">￥300</p>
						</div>
						<div class="zc_btngroup car_num">
							<div class="zc_btnleft">-</div>
							<div class="zc_btnmin">1</div>
							<div class="zc_btnright" >+</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!--购物车底部-->
		<div class="zc_cartbottom">
			<input class="zc-checkbox" type="checkbox" />
			<p style="margin-left:-35px;">全选</p>
			<p class="zc_cartTotal">合计<span>￥0</span></p>
			<div class="zc_cart_Count">结算<span>(0)</span></div>
		</div>
	</body>
	<script type="text/javascript" src="/js/jquery-1.11.0.js" ></script>
	<script>
		var n=1;
		$(function(){
		    var car = '';
            $.ajax({
                url : "/myCarList",	//请求url 商城分类
                type : "get",	//请求类型  post|get
                async: false,
                dataType : "json",  //返回数据的 类型 text|json|html--
                data:{},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data.data);
                    $.each(data.data, function (k, v) {
                        car += '<div class="store_parent">';
                        car += '<div class="store_div">';
                        car += '<div class="store_height"></div>';
                        car += '<div class="store_nameDiv">';
                        car += '<div class="store_checkbox">';
                        car += '<input class="zc-checkbox" type="checkbox" />';
                        car += '</div>';
                        car += '<div class="store_name">'+v['name']+'...</div>';
                        car += '<div class="store_img">';
                        car += '<img class="store_image" src="/images/right.png"/>';
                        car += '</div>';
                        car += '</div>';
                        $.each(v.goods, function (k, goods) {
                            car += '<div class="car_div">';
                            car += '<div class="store_checkbox">';
                            car += '<div class="img_height"></div>';
                            car += '<input class="zc-checkbox" type="checkbox" />';
                            car += '</div>';
                            car += '<div class="car_img">';
                            car += '<img class="car_image" src="'+goods['image_one']+'"/>';
                            car += '</div>';
                            car += '<div class="store_checkbox">';
                            car += '<p>'+goods['goods_name'].substr(0,5)+'...</p>';
                            car += '<p>'+goods['goods_info'].substr(0,5)+'...</p>';
                            car += '<p class="car_">175cm,88公斤</p>';
                            car += '<p class="car_price">￥'+goods['price']+'</p></div>';
                            car += '<div class="zc_btngroup car_num"><div class="zc_btnleft">-</div><div class="zc_btnmin">1</div> <div class="zc_btnright" >+</div></div></div>';
						});
                        car += '</div></div>';
                    });
                    $('.zc_carGoods').html(car);
                }
            });
			$(".zc_btnright").click(function(){
				n++;
			if(n<1){
				//禁止点击
				$(this).prev().text(1)
			}else{
				$(this).prev().text(n)
			}
			console.log($(this).text())
			});
			
			$(".zc_btnleft").click(function(){
				n--;
			if(n<1){
				//禁止点击
				$(this).next().text(1)
			}else{
				$(this).next().text(n)
			}
			console.log($(this).next().text())
			})
		})

	</script>
</html>
