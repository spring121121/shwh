<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞-博物馆</title>
    <link rel="stylesheet" href="/styles/museum.css">
    <link rel="stylesheet" type="text/css" href="/styles/mechOne.css"/>
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
</head>
<body>
    <div id="home">
        <header>
            <ul>
                <li>
                	<span onclick="handleToindex()" class="iconfont icon-ffanhui-"></span>
                </li>
                <li >文创机构</li>
                 <li>
                    <span onclick="handleTofen()" class="iconfont icon-fenlei"></span>
                </li>
            </ul>
           
        </header>
        {{--<div id="museum_list">--}}
            {{--<ul id="nav">--}}
                {{--<li class="on" onclick="museumList(1)">综合</li>--}}
                {{--<li onclick="museumList(2)">最新</li>--}}
                {{--<li onclick="museumList(3)">最热</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        <section class="b">
            <p class="mechTitle">文创机构总览</p>
            <div id="museum_shop">
                <div class="museum_shop_left">
                    
                </div>
                <div class="museum_shop_right">
                   
                </div>
            </div>
        </section>
        
    </div>
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js" ></script>
<script>
	 window.onload = function() {
      museumList();
   }
	$(function(){
		$("#nav>li").click(function(){
			$(this).addClass("on").siblings().removeClass("on")
		})
	})
//	 列表渲染
	function museumList(num){
		var arr=[];
		if(num==1||num==""){
			arr=['/images/a1.jpg',
		         "/images/a2.jpg",
		         "/images/a3.jpg",
		         "/images/a4.jpg",
		         "/images/a1.jpg",
		         "/images/a2.jpg",
		         "/images/a3.jpg",
		         "/images/a4.jpg"
		         ]
		}else if(num==2){
			arr=['/images/a2.jpg',
		         "/images/a1.jpg",
		         "/images/a3.jpg",
		         "/images/a3.jpg",
		         "/images/a1.jpg",
		         "/images/a3.jpg",
		         "/images/a3.jpg",
		         "/images/a1.jpg"
		         ]
		}else if(num=3){
		 arr=['/images/a3.jpg',
		         "/images/a2.jpg",
		         "/images/a1.jpg",
		         "/images/a4.jpg",
		         "/images/a3.jpg",
		         "/images/a2.jpg",
		         "/images/a2.jpg",
		         "/images/a1.jpg"
		         ]
		}
		var museumList=""
		arr.forEach(function(i){
			museumList+='<div class="museum_shop_pic">'
			museumList+='<div>'
			museumList+='<img src='+i+' alt="">'
			museumList+='</div>'
			museumList+='<div>'
			museumList+='<h3 >文创机构名称</h3>'
			museumList+='<div>'
			
			museumList+='</div>'
			museumList+='</div>'
			museumList+='</div>'                              
		})
		$(".museum_shop_left").html(museumList);
		$(".museum_shop_right").html(museumList);
	}
	//返回首页
	function handleToindex(){
		window.location.href="/wap/index";
	}
//	跳转分类
	function handleTofen(){
		window.location.href="/wap/musefen";
	}
	

</script>
</html>

