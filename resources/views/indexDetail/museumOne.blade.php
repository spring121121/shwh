<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞-博物馆</title>
    <link rel="stylesheet" href="/styles/museum.css">
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
</head>
<body>
    <div id="home">
        <header>
            <ul>
                <li>
                	<span onclick="handleToindex()" class="iconfont icon-ffanhui-"></span>
                </li>
                <li >博物馆</li>
                <li>
                    <span onclick="handleTofen()" class="iconfont icon-fenlei"></span>
                </li>
            </ul>
           
        </header>
        <div id="museum_list">
            <!--<ul id="nav">
                <li class="on" onclick="museumList(1)">推荐</li>
                <li onclick="museumList(2)">打卡圣地</li>
                <li onclick="museumList(3)">排行榜</li>
                <li onclick="museumList(4)">必去地点</li>
               
            </ul>-->
            <div></div>
        </div>
        <section class="b">   
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
		
    	console.log(num)
    	$.ajax({
    		url : "/getStoreListBySearch",
    		type:"get",
    		dataType:"json",
    		data:{
    			roleId:2,
//  			storeName:"江西店"
    			},
    		success:function(data){
    			console.log(data.data)
    			var museumList=""
				data.data.forEach(function(i){
					museumList+='<div class="museum_shop_pic">'
					museumList+='<div>'
//					museumList+='<img src='+i.logo_pic_url+' alt="">'
					museumList+='<img src="/images/a2.jpg"/>'
					museumList+='</div>'
					museumList+='<div>'
					museumList+='<h3 >'+i.name+'</h3>'
					museumList+='</div>'
					museumList+='</div>'    
					console.log(i.logo_pic_url)                          
				})
				$(".museum_shop_left").html(museumList);
				$(".museum_shop_right").html(museumList);
    			
    			
    		},
    		error: function(data){
    			console.log(222)
    		}
    	});

		
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
<!--<script src="../js/museum.js"></script>-->
