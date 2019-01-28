<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="ti"></title>
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
                <li id="role"></li>
                <li>
                    <span onclick="handleTofen()" class="iconfont icon-fenlei"></span>
                </li>
            </ul>
           
        </header>

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
<script type="text/javascript" src="/js/common.js" ></script>
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
     function museumList() {
         var roleId = GetUrlParam("roleId")
         if(roleId==2){
             $("#ti").html("山洞-博物馆")
             $("#role").html("博物馆")

         }else if(roleId==4){
             $("#ti").html("山洞-文创机构")
             $("#role").html("文创机构")
         }else{
             $("#ti").html("山洞-工厂")
             $("#role").html("工厂")
         }


         $.ajax({
             url: "/getStoreListBySearch",
             type: "get",
             dataType: "json",
             data: {
                 roleId: roleId,
//  			storeName:"江西店"

             },
             success: function (data) {
                 console.log(data.data)
                 var museumListLeft = ""
                 var museumListRight = ""
                 $.each(data.data,function(i,v){
                     if (i % 2 == 0) {
                         museumListLeft+='<div class="museum_shop_pic">'
                         museumListLeft+='<div>'
                         museumListLeft+='<a href="/wap/musename?store_id='+v.id+'"><img src="'+v.logo_pic_url+'" onerror="this.src=\'/images/a2.jpg\'"  alt=""></a>'
                         museumListLeft+='</div>'
                         museumListLeft+='<div>'
                         museumListLeft+='<h3 >'+v.name+'</h3>'
                         museumListLeft+='</div>'
                         museumListLeft+='</div>'
                     }else{
                         museumListRight+='<div class="museum_shop_pic">'
                         museumListRight+='<div>'
                         museumListRight+='<a href="/wap/musename?store_id='+v.id+'"><img src="'+v.logo_pic_url+'" onerror="this.src=\'/images/a2.jpg\'"  alt=""></a>'
                         museumListRight+='</div>'
                         museumListRight+='<div>'
                         museumListRight+='<h3 >'+v.name+'</h3>'
                         museumListRight+='</div>'
                         museumListRight+='</div>'
                     }
                 })
                 $(".museum_shop_left").html(museumListLeft);
                 $(".museum_shop_right").html(museumListRight);


             },
             error: function (data) {
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
	 function  handleTodetail() {
         window.location.href="/wap/musename";
     }

</script>
</html>
<!--<script src="../js/museum.js"></script>-->
