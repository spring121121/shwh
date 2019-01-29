<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>山洞-设计师_作品</title>
	<link rel="stylesheet" href="/styles/designerd_serch.css">
	<link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
	<script type="text/javascript" src="/js/iconfont.js" ></script>
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
<div id="home">
	<header>
		<ul>
			<li>
				<!--<a href="../designerd.html"></a>-->
				<span onclick="handleTodesi()" class="iconfont icon-ffanhui-"></span>
			</li>
			<li class="header_input">
				<input type="text" placeholder="请输入你需要" id="bin">
				<div>
                        <span>
                            <img src="/images/serch.png" alt="">
                        </span>
				</div>
			</li>
			<li>
				<span></span>
			</li>
		</ul>
	</header>
	<div class="bigContainer">
		<div id="designerd_abstract">
			<div class="designerd_abstract_top">
				<div>
					<div class="designerd_abstract_chart">
						<img src="/images/people3.jpg" alt="">
					</div>
					<div class="designerd_abstract_locn">
						<div><img src="/images/man.jpg"/></div>
						<div><img src="/images/dengji.jpg"/></div>
					</div>
				</div>
				<div>+关注</div>
			</div>
		</div>
		<div id="designerd_serch_pic">
			<div class="designerd_serch_pic">
				<ul>
					<li>
						<div class="desContent">
							<img src="/images/a3.jpg">
							<div class="start2">
								<svg class="icon" aria-hidden="true">
									<use xlink:href="#icon-unie601"></use>
								</svg>
								<svg id="yelloStart" class="icon" aria-hidden="true">
									<use xlink:href="#icon-star__easyico"></use>
								</svg>
							</div>
						</div>
						<div>
							博物馆名字
						</div>
					</li>
					<li>
						<div class="desContent">
							<img src="/images/a4.jpg">
							<div class="start2">
								<svg class="icon" aria-hidden="true">
									<use xlink:href="#icon-unie601"></use>
								</svg>
								<svg id="yelloStart" class="icon" aria-hidden="true">
									<use xlink:href="#icon-star__easyico"></use>
								</svg>
							</div>
						</div>
						<div>
							博物馆名字
						</div>
					</li>
				</ul>
			</div>
			<div class="designerd_serch_pic">
				<ul>
					<li>
						<div class="desContent">
							<img src="/images/a2.jpg">
							<div class="start2">
								<svg class="icon" aria-hidden="true">
									<use xlink:href="#icon-unie601"></use>
								</svg>
								<svg id="yelloStart" class="icon" aria-hidden="true">
									<use xlink:href="#icon-star__easyico"></use>
								</svg>
							</div>
						</div>
						<div>
							博物馆名字
						</div>
					</li>
					<li>
						<div class="desContent">
							<img src="/images/a1.jpg">
							<div class="start2">
								<svg class="icon" aria-hidden="true">
									<use xlink:href="#icon-unie601"></use>
								</svg>
								<svg id="yelloStart" class="icon" aria-hidden="true">
									<use xlink:href="#icon-star__easyico"></use>
								</svg>
							</div>
						</div>
						<div>
							博物馆名字
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js" ></script>
<script>
    $(function(){
        $(".start2>svg").click(function() {
            $(this).hide().siblings().show()
        })
    })
    function handleTodesi(){
        window.location.href = "/wap/museumOne";
    }
</script>

</html>

