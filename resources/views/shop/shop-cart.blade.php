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
		<link rel="stylesheet" type="text/css" href="/font/iconfont3.css">
		<link rel="stylesheet" href="/styles/museum.css">

		<style>
			.store_parent{
				background: #fff;
				border-radius:10px;
				margin-bottom:10px;
			}
			.store_div{
				margin-left:10px;
			}
			.store_height{
				height:10px;
			}
			.store_nameDiv{
				height:30px;
			}
			.store_checkbox{
				float:left;
				margin-top:3px;
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
				color:red;
			}
			.car_num{
				float:right;
				margin-top:60px;
				margin-right:10px;
			}
			.img_height{
				height:25px;
			}
			header ul {
				margin: 0 10px;
			}
			.settle{
				margin-right:3%;
			}
			.select{
				background: #F2F2F2;
			}
			.payment{
				margin-left:20px;
				width:80px;
				height:30px;
				float:right;
				text-align:center;
				background: red;
				border-radius:15px;
				color:#fff;
				line-height:30px;
				vertical-align: middle;
				margin-top:10px;
				margin-right:10px;
			}
			.check{
				float:left;
				margin-top:5px;
			}
			.all{
				float:left;
				margin-left:5px;
				color:#878787;
			}
			.zc_btnmin{
				line-height:25px;
				vertical-align: middle;
				font-size:12px;
			}
		</style>
	</head>
	<body>
		<header class="head" style="position: fixed;z-index:999;">
			<ul>
				<li>
					<span class="iconfont icon-ffanhui- back"></span>
				</li>
				<li class="title">购物车</li>
				<li class="settle">
					管理
				</li>
			</ul>
		</header>
		{{--<div class="index-header header">--}}
			{{--<div class="" onclick="handleToshop()"><span style="color:#fff;" class="iconfont icon-ffanhui- "></span></div>--}}
			{{--<p class="zc_cartitle">购物车</p>--}}
			{{--<div class="zc_right">--}}
				{{--<p>管理</p>--}}
			{{--</div>--}}
		{{--</div>--}}
		<section class="b select">
			<div class="zc_carGoods">
			</div>
			<div style="height:100px;">
			</div>
		</section>
		<!--购物车底部-->
		<div class="zc_cartbottom">
			<div>
				<div class="check">
					<input class="zc-checkbox" type="checkbox">
				</div>
				<div class="all">
					<span>全选</span>
				</div>
			</div>
			<div>
				<span>合计:</span><span class="car_price">￥300</span>
				<div class="payment">
					<span>结&nbsp;算</span><span>(100)</span>
				</div>
			</div>
		</div>

		<!--引入footer-->
		@extends('layout.footer')
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
                        car += '<div class="store_name">'+v['name']+'</div>';
                        car += '<div class="store_img">';
                        car += '<img class="store_image" src="/images/right.png"/>';
                        car += '</div>';
                        car += '</div>';
                        $.each(v.goods, function (k, goods) {
                            car += '<div class="car_div">';
                            car += '<div class="store_checkbox">';
                            car += '<div class="img_height"></div>';
                            car += '<input class="zc-checkbox" name="goods_id" type="checkbox" value="'+goods['id']+'"/>';
                            car += '</div>';
                            car += '<div class="car_img">';
                            car += '<img class="car_image" src="'+goods['image_one']+'"/>';
                            car += '</div>';
                            car += '<div class="store_checkbox">';
                            car += '<p>'+goods['goods_name'].substr(0,5)+'...</p>';
                            car += '<p>'+goods['goods_info'].substr(0,5)+'...</p>';
                            car += '<p class="car_"></p>';
                            car += '<p class="car_price">￥'+goods['price']+'</p></div>';
                            car += '<div class="zc_btngroup car_num"><div class="zc_btnleft">-</div><div class="zc_btnmin">1</div> <div class="zc_btnright" >+</div></div></div>';
						});
                        car += '</div></div>';
                    });
                    $('.zc_carGoods').html(car);
                }
            });

            $('.payment').on('click',function(){
 				var goods_ids = [];
 				var num = [];
                $.each($('input[name="goods_id"]:checked'),function(){
                    goods_ids.push($(this).val());
                    num.push($(this).parent().siblings('.car_num').find('.zc_btnmin').text());
                });
				window.location.href = '/wap/shop_purchase?goods_id='+goods_ids+'&num='+num;
			});
            $('.back').on('click',function(){
                window.history.go(-1);
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
			});
			
			$(".settle").click(function(){
				if($(this).text()=="管理"){
					$(this).text("完成");
					$("#zc_cartdiv1").hide();
					$("#zc_cartdiv2").show();
				}else{
					$(this).text("管理");
					$("#zc_cartdiv1").show();
					$("#zc_cartdiv2").hide();
				}
			})
		});
	</script>
</html>
