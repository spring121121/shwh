<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/styles/base.css" />
		<link rel="stylesheet" type="text/css" href="/styles/museumGoods.css" />
		<link rel="stylesheet" type="text/css" href="/font/iconfont3.css" />
		<script type="text/javascript" src="/js/iconfont.js"></script>
	</head>
	<style>
		.icon {
			width: 1em;
			height: 1em;
			vertical-align: -0.15em;
			fill: currentColor;
			overflow: hidden;
		}
	</style>

	<body>
		<div class="container">
			<div class="goodsHead">
				<span onclick="handleTomuseum()" class="iconfont icon-ffanhui-"></span>
			</div>
			<div class="goodsNav">
				<div class="goodsImg">
					<img src="/images/a4.jpg" />
				</div>
				<p class="goodstext">博物馆名称</p>
				<div class="goodsBtn">+关注</div>
			</div>
			<div class="goodsDetail">
				博物馆博物馆博物馆66666666666666博物馆博物馆博物馆66666666666666博物馆博物馆博物馆6666666666 6666博物馆博物馆博物馆 66666666666666博物馆博物馆博物馆66666666666666博物馆博物馆博物馆66666666 666666博物馆博物馆博物馆 6666666666666 6博物馆博物馆博物馆66666666666666
			</div>
			<div class="shareGoods">
				<div class="start">
					<svg class="icon" aria-hidden="true">
						<use xlink:href="#icon-unie601"></use>
					</svg>
					<svg id="yelloStart" class="icon" aria-hidden="true">
						<use xlink:href="#icon-star__easyico"></use>
					</svg>
				</div>
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-zhuanfa"></use>
				</svg>
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-pinglun"></use>
				</svg>
			</div>
			<div class="factory">
				<p>制作工厂</p>
				<div class="factoryDetail">
					<img src="/images/a4.jpg" />
					<div class="factoryText">
						<p>工厂名称</p>
						<p>光辉事迹</p>
						<p>参与作品</p>
					</div>
					<div class="factoryBtn">+关注</div>
				</div>
			</div>
			<div class="factory">
				<p>合作机构</p>
				<div class="factoryDetail">
					<img src="/images/a3.jpg" />
					<div class="factoryText">
						<p>机构名称</p>
						<p>光辉事迹</p>
						<p>参与作品</p>
					</div>
					<div class="factoryBtn">+关注</div>
				</div>
			</div>
			<div class="similarity">
				<p>相似产品推荐</p>
				<div class="goodsList">
					<div class="list_left">
						<div class="leftContent">
							<div class="leftImg">
								<img src="/images/a2.jpg"/>
								<div class="start2">
									<svg class="icon" aria-hidden="true">
										<use xlink:href="#icon-unie601"></use>
									</svg>
									<svg id="yelloStart" class="icon" aria-hidden="true">
										<use xlink:href="#icon-star__easyico"></use>
									</svg>
								</div>
							</div>
							<div class="leftText">
								商品好好好商品好好好商品
							</div>
						</div>
					</div>
					<div class="list_right"></div>
					
				</div>
			</div>

		</div>
	</body>
	<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
	<script>
		$(function() {
			 goodsList();
			$(".start>svg").click(function() {
				$(this).hide().siblings().show()
			})
			$(".start2>svg").click(function() {
				$(this).hide().siblings().show()
			})
			
		 	
		})
        var arrgoods=["/images/a1.jpg",
                      "/images/a2.jpg",
                      "/images/a3.jpg",
                      "/images/a4.jpg",
                      "/images/a1.jpg",
                                           ]
        function goodsList(){
        	var goodsList=""
        	arrgoods.forEach(function(i){
        		goodsList+='<div class="leftContent">'
        		goodsList+='<div class="leftImg">'
        		goodsList+='<img src="'+i+'"/>'
        		goodsList+='<div class="start2">'
        		goodsList+='<svg class="icon" aria-hidden="true">'
        		goodsList+='<use xlink:href="#icon-unie601"></use>'
        		goodsList+='</svg>'
        		goodsList+='<svg id="yelloStart" class="icon" aria-hidden="true">'
        		goodsList+='<use xlink:href="#icon-star__easyico"></use>'
        		goodsList+='</svg>'
        		goodsList+='</div>'
        		goodsList+='</div>'	
        		goodsList+='<div class="leftText">商品好好好商品好好好商品'	
        		goodsList+='</div>'
        		goodsList+='</div>'
				
        	})
        	$(".list_left").html(goodsList);
        	$(".list_right").html(goodsList);
        }
        
		function handleTomuseum() {
			window.location.href = "/wap/index";
		}
	</script>

</html>