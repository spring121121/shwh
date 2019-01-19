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
	</head>

	<body>
		<div class="index-header header">
			<div class="common-header-left" onclick="handleToshop()"><img src="/images/fanhui.jpg"/></div>
			<p class="zc_cartitle">购物车</p>
			<div class="zc_right">
				<p>管理</p>
			</div>
		</div>
		<div class="zc_carGoods">
			<div class="zc_carName">
				<div class="zc_choose">
					<input class="zc-checkbox" type="checkbox" />
					<input class="zc-checkbox mt35" type="checkbox" />
				</div>
				<div class="zc_cartimg">
					<p>店铺名称</p>
					<img src="/images/a4.jpg"/>
				</div>
				<div class="zc_cartText">
					<p>商品名称</p>
					<p>商品内容</p>
					<p>175cm,88公斤</p>
					<p>￥300</p>
				</div>
				<div class="zc_goright">
					<div class="zc_gorightImg">
						<img src="/images/right.png"/>
					</div>
					<div class="zc_btngroup">
						<div class="zc_btnleft" >-</div>
						<div class="zc_btnmin">0</div>
						<div class="zc_btnright" >+</div>
					</div>
				</div>
			</div>
			
			<div class="zc_carName">
				<div class="zc_choose">
					<input class="zc-checkbox" type="checkbox" />
					<input class="zc-checkbox mt35" type="checkbox" />
				</div>
				<div class="zc_cartimg">
					<p>店铺名称</p>
					<img src="/images/a4.jpg"/>
				</div>
				<div class="zc_cartText">
					<p>商品名称</p>
					<p>商品内容</p>
					<p>175cm,88公斤</p>
					<p>￥300</p>
				</div>
				<div class="zc_goright">
					<div class="zc_gorightImg">
						<img src="/images/right.png"/>
					</div>
					<div class="zc_btngroup">
						<div class="zc_btnleft" >-</div>
						<div class="zc_btnmin">0</div>
						<div class="zc_btnright" >+</div>
					</div>
				</div>
			</div>
			
			<div class="zc_carName">
				<div class="zc_choose">
					<input class="zc-checkbox" type="checkbox" />
					<input class="zc-checkbox mt35" type="checkbox" />
				</div>
				<div class="zc_cartimg">
					<p>店铺名称</p>
					<img src="/images/a4.jpg"/>
				</div>
				<div class="zc_cartText">
					<p>商品名称</p>
					<p>商品内容</p>
					<p>175cm,88公斤</p>
					<p>￥300</p>
				</div>
				<div class="zc_goright">
					<div class="zc_gorightImg">
						<img src="/images/right.png"/>
					</div>
					<div class="zc_btngroup">
						<div class="zc_btnleft" >-</div>
						<div class="zc_btnmin">0</div>
						<div class="zc_btnright" >+</div>
					</div>
				</div>
			</div>
			
			<div class="zc_carName">
				<div class="zc_choose">
					<input class="zc-checkbox" type="checkbox" />
					<input class="zc-checkbox mt35" type="checkbox" />
				</div>
				<div class="zc_cartimg">
					<p>店铺名称</p>
					<img src="/images/a4.jpg"/>
				</div>
				<div class="zc_cartText">
					<p>商品名称</p>
					<p>商品内容</p>
					<p>175cm,88公斤</p>
					<p>￥300</p>
				</div>
				<div class="zc_goright">
					<div class="zc_gorightImg">
						<img src="/images/right.png"/>
					</div>
					<div class="zc_btngroup">
						<div class="zc_btnleft" >-</div>
						<div class="zc_btnmin">0</div>
						<div class="zc_btnright" >+</div>
					</div>
				</div>
			</div>
		</div>
		<!--购物车底部-->
		<div class="zc_cartbottom">
			
			<div class="zc_cartdiv" id="zc_cartdiv2">
				<input class="zc-checkbox" type="checkbox" />
				<p>全选</p>
				<div class="zc_cart_Count ml100">取消</div>
				<div class="zc_cart_Count">删除<span>(0)</span></div>
			</div>
			
			<div class="zc_cartdiv" id="zc_cartdiv1">
				<input class="zc-checkbox" type="checkbox" />
				<p>全选</p>
				<p class="zc_cartTotal">合计<span>￥0</span></p>
				<div class="zc_cart_Count">结算<span>(0)</span></div>
			</div>
		</div>
			
	</body>
	<script type="text/javascript" src="/js/jquery-1.11.0.js" ></script>
	<script>
		var n=0;
		$(function(){
			$(".zc_btnright").click(function(){
				n++;
			if(n<0){
				//禁止点击
				$(this).prev().text(0)
			}else{
				$(this).prev().text(n)
			}
			console.log($(this).text())
			})
			
			$(".zc_btnleft").click(function(){
				n--;
			if(n<0){
				//禁止点击
				$(this).next().text(0)
			}else{
				$(this).next().text(n)
			}
			console.log($(this).next().text())
			})
			
			$(".zc_right>p").click(function(){
				if($(this).text()=="管理"){
					$(this).text("完成")
					$("#zc_cartdiv1").hide();
					$("#zc_cartdiv2").show();
				}else{
					$(this).text("管理");
					$("#zc_cartdiv1").show();
					$("#zc_cartdiv2").hide();
				}
			})
		})

      function handleToshop(){
			window.location.href = "/wap/shop_detail";
		}
	</script>
</html>
