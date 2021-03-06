<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>首页-商城购物车</title>

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
				margin: 0 10px 0 5px;
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
				margin-top:8px;
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
			.zc_btnmin,.zc_btnleft,.zc_btnright{
				line-height:25px;
				vertical-align: middle;
				font-size:12px;
			}
			.del_goods{
				margin-left: 20px;
				height: 30px;
				float: right;
				text-align: center;
				border-radius: 15px;
				line-height: 30px;
				vertical-align: middle;
				margin-top: 8px;
				margin-right: 10px;
				background: #fff;
				color:red;
				border:1px solid #DD0E44;
				width:50px;
			}
			.car_empty{
				height:70px;
				margin-top:20%;
				margin-left:30%;
			}
			.car_empty img{
				width:45px;
				height:45px;
			}
			.car_font{
				float:left;
				margin-top:10px;
				margin-left:10px;
				color:#dbdbdb;
				letter-spacing: 2px;
			}
			.classify-all{
				display:flex;
			}
			.recommend{
				text-align: center;
				margin-bottom:10px;
				color:#ffaa00;
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
				<li class="settle">管理</li>
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
		</section>

		<div class="classify-display">
			<h2 class="recommend">为&nbsp;你&nbsp;推&nbsp;荐</h2>
			<ul class="classify-all">

			</ul>
		</div>

		<!--购物车底部-->
		<div class="zc_cartbottom">
			<div>
				<div class="check">
					<input class="zc-checkbox all-checkbox" type="checkbox">
				</div>
				<div class="all">
					<span>全选</span>
				</div>
			</div>
			<div class="submit">
				<div class="set">
					<span>合计:</span><span class="car_price">￥<span class="settle_price">0.00</span></span>
					<div class="payment">
						<span>结&nbsp;算</span>
						<span>(</span>
						<span class="settle_num">0</span>
						<span>)</span>
					</div>
				</div>
				<div class="del_goods">
					<span>删&nbsp;除</span>
				</div>
			</div>
		</div>

		<!--引入footer-->
		@extends('layout.footer')
	</body>
	<script type="text/javascript" src="/js/jquery-1.11.0.js" ></script>
	<script>
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
                    if(data.data == ''){
                        $('.select').html('<div class="car_empty"><div style="float:left;"><img src="/images/shop/gouwuche.png"></div><div class="car_font">购物车空空如也！</div></div>');
                        $('.select').css('background','#f0f0f0');
                        $('.zc_cartbottom').hide();
                    	$('.classify-display').css('margin-bottom','55px');
                        return false;
					}
                    $.each(data.data, function (k, v) {
                        car += '<div class="store_parent">';
                        car += '<div class="store_div">';
                        car += '<div class="store_height"></div>';
                        car += '<div class="store_nameDiv">';
                        car += '<div class="store_checkbox">';
                        car += '<input name="store_id" class="zc-checkbox store_id" type="checkbox" />';
                        car += '</div>';
                        car += '<div class="store_name">'+v['name']+'</div>';
                        car += '<div class="store_img">';
                        car += '<img class="store_image" src="/images/right.png"/>';
                        car += '</div>';
                        car += '</div>';
                        $.each(v.goods, function (k, goods) {
                            var goods_name = goods['goods_name'];
                            var goods_info = goods['goods_info'];
                            if(goods_name.length>5){
                                goods_name = goods_name.substr(0,5)+'...';
                            }
                            if(goods_info.length>6){
                                goods_info = goods_info.substr(0,6)+'...';
                            }
                            car += '<div class="car_div">';
                            car += '<div class="store_checkbox">';
                            car += '<div class="img_height"></div>';
                            car += '<input class="zc-checkbox goods_id" name="goods_id" type="checkbox" value="'+goods['id']+'"/>';
                            car += '</div>';
                            car += '<div class="car_img">';
                            car += '<img class="car_image" src="'+goods['image_one']+'"/>';
                            car += '</div>';
                            car += '<div class="store_checkbox">';
                            car += '<p>'+goods_name+'</p>';
                            car += '<p>'+goods_info+'</p>';
                            car += '<p class="car_"></p>';
                            car += '<p class="car_price">￥<span>'+goods['price']+'</span></p></div>';
                            car += '<div class="zc_btngroup car_num"><div class="zc_btnleft">-</div><div class="zc_btnmin">1</div> <div class="zc_btnright" >+</div></div></div>';
						});
                        car += '</div></div>';
                    });
                    $('.classify-display').css('margin-bottom','105px');
                    $('.zc_carGoods').html(car);
                }
            });
            goodsList("/recommendGoodsList");
			//结算
            $('.payment').on('click',function(){
 				var goods_ids = [];
 				var num = [];
                $.each($('input[name="goods_id"]:checked'),function(){
                    goods_ids.push($(this).val());
                    num.push($(this).parent().siblings('.car_num').find('.zc_btnmin').text());
                });
                if(goods_ids == ''){
                    alert('您还没有选择商品哦！');
                    return false;
				}
				window.location.href = '/wap/shop_purchase?goods_id='+goods_ids+'&num='+num;
			});
            //右上角管理按钮
			$(".del_goods").hide();
            $(".settle").on('click',function(){
                var settle = $(this).text();
                if(settle == "管理"){
                    $(this).text("完成");
                    $(".set").hide();
                    $(".del_goods").show();
                }else if(settle == "完成"){
                    $(this).text("管理");
                    $(".set").show();
                    $(".del_goods").hide();
                }
            });
            //删除商品
            $('.del_goods').on('click',function(){
                var goods_ids = [];
                $.each($('input[name="goods_id"]:checked'),function(){
                    goods_ids.push($(this).val());
                });
                if(goods_ids == ''){
                    alert('您还没有选择商品哦！');
                    return false;
                }
                $.ajax({
                    url: "/delCar",	//请求url 商城分类
                    type: "get",	//请求类型  post|get
                    async: false,
                    dataType: "json",  //返回数据的 类型 text|json|html--
                    data: {goods_id:goods_ids},
                    success: function (data) {//回调函数 和 后台返回的 数据
						if(data.status){
						    alert('删除成功！');
                            window.location.reload();
						}
                    }
                });
			});
                //返回
            $('.back').on('click',function(){
                window.location.href="/wap/shop"
            });
            var n=1;
			$(".zc_btnright").click(function(){
                n = $(this).prev().text();
				if(n<1){
					//禁止点击
					$(this).prev().text(1);
				}else{
				    n++;
				    if(n<1){
                        $(this).prev().text(1);
					}else{
                        $(this).prev().text(n)
					}
				}
                price();
			});
			
			$(".zc_btnleft").click(function(){
                n = $(this).next().text();
				if(n<1){
					//禁止点击
					$(this).next().text(1)
				}else{
				    n--;
                    if(n<1){
                        $(this).next().text(1);
                    }else{
                        $(this).next().text(n)
                    }
				}
                price();
			});
			//全选
            $('.check').on('click',function(){
                var check = $(this).find('.zc-checkbox').is(':checked');
                if(check){
                    $('input[name="goods_id"]:checkbox').each(function(){
                        $(this).prop("checked",true);
                    });
                    $('input[name="store_id"]:checkbox').each(function(){
                        $(this).prop("checked",true);
                    });
				}else{
                    $('input[name="goods_id"]:checkbox').each(function(){
                        $(this).prop("checked",false);
                    });
                    $('input[name="store_id"]:checkbox').each(function(){
                        $(this).prop("checked",false);
                    });
				}
				price();
            });
			//店铺选中（所属商品全选）
            $('input[name="store_id"]').on('click',function(){
                var check = $(this).is(':checked');
                var ele = $(this).parent().parent().siblings('.car_div').find('.store_checkbox').find('.zc-checkbox');
                if(check){
                    ele.each(function(){
                        $(this).prop("checked",true);
                    });
                }else{
                    ele.each(function(){
                        $(this).prop("checked",false);
                    });
                }
                all();
                price();
            });
            //选中商品
            $('input[name="goods_id"]').on('click',function(){
                var check = $(this).is(':checked');
                var parentEle = $(this).parent().parent().siblings('.store_nameDiv').find('.store_checkbox').find('.zc-checkbox');
                var ele = $(this).parent().parent().siblings('.car_div').find('.store_checkbox').find('.zc-checkbox');
                if(check){
                    var isChecked = 0;
                    ele.each(function() {
                        if (!$(this).is(":checked")) {
                            isChecked = 1;//存在没有选中的
                        }
                    });
                    if(isChecked == 1){
						parentEle.prop("checked",false);
					}else{
                        parentEle.prop("checked",true);
					}
				}else{
                    parentEle.prop("checked",false);
				}
                all();
                price();
			});
            //详情
            $(".detail").on("click",function () {
                var id = $(this).next().val();
				browseNum("/createRecord",id,"post");
                window.location.href = "/wap/shop_detail?id="+id;
            });

            $(".agent").on("click",function () {
                var goodsId = $(this).attr('id');
                window.location.href = "/wap/shop_share?goods_id="+goodsId;
            });
            //店铺，商品都选中
			function all(){
                var allStore_id = $("input[name='store_id']").length;//所有个数
                var store_id = $('input[name="store_id"]:checked').length;//选中个数
                var allGoods_id = $('input[name="goods_id"]').length;
                var goods_id = $('input[name="goods_id"]:checked').length;
                if(store_id == allStore_id && goods_id==allGoods_id){
                    $('.all-checkbox').prop("checked",true);
                }else{
                    $('.all-checkbox').prop("checked",false);
                }
			}
			//结算价格
			function price(){
                var num = '';
                var price = '';
                var total = 0;
                var settle_num = 0;
                $.each($('input[name="goods_id"]:checked'),function(){
                    price = $(this).parent().siblings('.store_checkbox').find('.car_price').find('span').text();
                    num = $(this).parent().siblings('.car_num').find('.zc_btnmin').text();
                    settle_num ++;
                    total += price*num;
                });
                $('.settle_price').text(total.toFixed(2));
                $('.settle_num').text(settle_num);
			}
            function goodsList(url){
                var goodsList = '';
                $.ajax({
                    url : url,	//请求url 商城分类
                    type : "get",	//请求类型  post|get
                    async: false,
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data:{},
                    success : function(data){//回调函数 和 后台返回的 数据
                        console.log(data);
                        $.each(data.data, function (k, v) {
                            var image = v['image_url'][0];
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
                            if(v['be_agent']==0){
                                goodsList += '<div class="distribution-icon agent" id="'+v.id+'"></div></div></div></li>';
                            }

                        });
                        $('.classify-all').html(goodsList);
                    }
                });
            }
		});
	</script>
</html>
