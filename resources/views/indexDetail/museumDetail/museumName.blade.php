<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/styles/museumName.css" />
		<link rel="stylesheet" type="text/css" href="/font/iconfont3.css" />
		<link rel="stylesheet" type="text/css" href="/styles/base.css" />
	</head>

	<body>
		<div class="container">
			<!--头部-->
			<div class="nameHead">
				<span onclick="handleTofen()" class="iconfont icon-ffanhui-"></span>
				<div class="museumImg">
					<img src="/images/a4.jpg" />
				</div>
				<div class="introduce">
					<p>博物馆名称6666666</p>
					<span class="iconfont icon-dengji"></span>
				</div>
				<div class="fansCourse">
					<p>已认证</p>
					<div class="">|</div>
					<p>粉丝&nbsp;&nbsp;<span>2365万</span></p>
				</div>
				<div class="followBtn">
					<p>+</p>
					<p>关注</p>
				</div>
			</div>
			<!--简介-->
			<div class="simpleText">
				<p>简介</p>
				<ul>
					<li>博物馆</li>
					<li>博物馆博物馆</li>
					<li>博物馆博物馆博物馆</li>
				</ul>
				<span class="iconfont icon-xiala"></span>
			</div>
			<div class="nameContent">
				<div class="contentNav clearfix">
					<div class=""><p class="navboder" onclick="nameList(1)">探宝笔记</p></div>
					<div class=""><p onclick="nameList(2)">文创宝藏</p></div>
				</div>
              <div class="nameList">
              	<div class="list_left">
              		
              	</div>
              	<div class="list_right"></div>
              </div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
	<script>
		window.onload = function() {
			$(".contentNav>div>p").click(function(){
			  $(this).addClass("navboder").parent().siblings().children().removeClass("navboder")
			})
			
			nameList();
		}
		function handleTofen() {
			window.location.href = "/wap/museumed";
		}
		  
		  var arrlist=["/images/a1.jpg",
		               "/images/a4.jpg",
		                "/images/a2.jpg",
		               "/images/a3.jpg",
		               "/images/a4.jpg",
		                "/images/a1.jpg",
		                "/images/a2.jpg"]
		 function nameList(num){
		 	if(num==1||num==""){
		 		arrlist=["/images/a1.jpg",
		               "/images/a4.jpg",
		                "/images/a2.jpg",
		               "/images/a3.jpg",
		               "/images/a4.jpg",
		                "/images/a1.jpg",
		                "/images/a2.jpg"]
		 	}else{
		 		arrlist=["/images/a2.jpg",
		               "/images/a3.jpg",
		                "/images/a1.jpg",
		               "/images/a3.jpg",
		               "/images/a1.jpg",
		                "/images/a1.jpg",
		                "/images/a4.jpg"]
		 	}
		 	
		 	
		 	var nameList=""
		 	arrlist.forEach(function(i){
		 	nameList+='<div class="museum_shop_pic">'
			nameList+='<div>'
			nameList+='<img src='+i+' alt="">'
			nameList+='</div>'
			nameList+='<div>'
			nameList+='<h3 >博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆博物馆</h3>'
			nameList+='<h4>'
			nameList+='<span><img src="/images/a3.jpg"/></span>'
			nameList+='<p>'
			nameList+='<i>152222</i>'
			nameList+='<em onclick="addcolor()" class="iconfont icon-dianzan"></em>'
			nameList+='</p>'
			nameList+='</h4>'
			nameList+='</div>'
			nameList+='</div>'  
		 	})
		 	$(".list_left").html(nameList)
		 	$(".list_right").html(nameList)
		 }
		 
		      
	</script>

</html>