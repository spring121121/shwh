<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>博物馆分类</title>
		<link rel="stylesheet" type="text/css" href="/styles/museumfen.css" />
		<link rel="stylesheet" type="text/css" href="/font/iconfont2.css" />
		<link rel="stylesheet" type="text/css" href="/font/iconfont3.css" />
	</head>

	<body>
		<div class="container">
			<div class="cover">
				<span onclick="handleTomuseum()" class="iconfont icon-ffanhui-"></span>
				<p class="bigTitle">分类</p>
				<div class="search">
					<span class="iconfont icon-sousuo"></span>
					<input type="text" class="searchInput" placeholder="搜索你的内容" />

				</div>
			</div>
			<div class="parse">
				<div class="parse_left">
					<div class="parseHead">A</div>
					<ul class="museumList">
						<li>
							<img src="../../images/a3.jpg" />
							<p>A字母开头博物馆</p>
						</li>
					</ul>
				</div>
				<div class="parse_right">
					<ul class="navigation" >
						
					</ul>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
	<script>
		window.onload = function() {
			parseList();
			museumListadd();
			navList();

			$(".navigation>a").click(function() {
				console.log(666)
				$(this).addClass("backgrd").siblings().removeClass("backgrd");

			})

		}

		var arrone = [1, 2, 3, 4];
		var arrtwo = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "G", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"]

		function museumListadd() {
			var addList = ""
			arrone.forEach(function(i) {
				addList += '<li onclick="museumName()">'
				addList += '<img src="../../images/a3.jpg" />'
				addList += '<p>A字母开头博物馆</p>'
				addList += '</li>'
			})
			$(".museumList").html(addList)
		}

		function parseList() {
			var parseList = ""
			arrtwo.forEach(function(i) {
				parseList += '<div id="' + i + '" class="adddiv"></div>'
				parseList += '<div  class="parseHead">' + i + '</div>'
				parseList += '<ul class="museumList">'
				parseList += '</ul>'

			})
			$(".parse_left").html(parseList)
		}

		function navList() {
			var navList = ""
			arrtwo.forEach(function(i) {
				navList += '<a href="#' + i + '">' + i + '</a>'
			})
			$(".navigation").html(navList)
		}
          //跳转博物馆首页
		function handleTomuseum() {
			window.location.href = "/wap/museum";
		}
		
		function museumName(){
			window.location.href = "/wap/musename";
		}
	</script>

</html>