<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞-工厂</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/studyIndex.css">
    <link rel="stylesheet" href="/styles/base.css">
    <link rel="stylesheet" href="/styles/common.css">

</head>
<body>
   <div class="container">
        <header>
            <ul>
                <li onclick="handleToindex()">
                    <img src="/images/fanhui.png" alt="">
                </li>
                <li class="styleTitle">
                   <p class="addcolor">精选</p>
                    <p>关注</p>
                </li>
                <li>
                    <span onclick="changeHead()">
                        <img src="/images/serch.png" alt="">
                    </span>
                </li>
            </ul>


        </header>
       <div class="noteList">
       <div id="bander">
           <div class="swiper-container swiper-addone">
               <div class="swiper-wrapper">
                   <div class="swiper-slide" onclick="toNoteDetail()"><img src="/images/wenyi1.jpg" alt=""></div>
                   <div class="swiper-slide"><img src="/images/wemyi2.jpg" alt=""></div>
                   <div class="swiper-slide"><img src="/images/wenyi3.jpg" alt=""></div>
               </div>
               <!-- Add Pagination -->
               <div class="swiper-pagination"></div>
               <!-- Add Arrows -->
               <!-- <div class="swiper-button-next"></div>
               <div class="swiper-button-prev"></div> -->
           </div>
           <p class="bannerTitle">"星辰大海&nbsp远方与爱"</p>
           <div class="studyPeople">
               <img src="/images/people2.jpg" alt="">
               <p class="bannerName">詹姆斯</p>
               <div class="studyDz">
                   <div class="dzimg" onclick="addLikes(1)">
                   <img src="/images/dz-icon.png" alt="">
                   <img src="/images/dz-icon-red.png" alt="" class="redDz">
                   </div>
                   <p>65656</p>
               </div>
           </div>
       </div>

       <div id="bander">
           <div class="swiper-container swiper-addtwo">
               <div class="swiper-wrapper">
                   <div class="swiper-slide"><img src="/images/wenyi4.jpg" alt=""></div>
                   <div class="swiper-slide"><img src="/images/wenyi5.jpg" alt=""></div>
                   <div class="swiper-slide"><img src="/images/wenyi6.jpg" alt=""></div>
               </div>
               <!-- Add Pagination -->
               <div class="swiper-pagination"></div>
               <!-- Add Arrows -->
               <!-- <div class="swiper-button-next"></div>
               <div class="swiper-button-prev"></div> -->
           </div>
           <p class="bannerTitle">"花前月下&nbsp扎西瓜"</p>
           <div class="studyPeople">
               <img src="/images/people3.jpg" alt="">
               <p class="bannerName">闰土</p>
               <div class="studyDz">
                   <div class="dzimg">
                       <img src="/images/dz-icon.png" alt="">
                       <img src="/images/dz-icon-red.png" alt="" class="redDz">
                   </div>
                   <p>65656</p>
               </div>
           </div>
       </div>

       <div id="bander">
           <div class="swiper-container swiper-addthree">
               <div class="swiper-wrapper">
                   <div class="swiper-slide"><img src="/images/banner1.jpg" alt=""></div>
                   <div class="swiper-slide"><img src="/images/banner2.jpg" alt=""></div>
                   <div class="swiper-slide"><img src="/images/banner3.jpg" alt=""></div>
               </div>
               <div class="swiper-pagination"></div>     
           </div>
           <p class="bannerTitle">"苍茫宇宙&nbsp无边无际"</p>
           <div class="studyPeople">
               <img src="/images/people.jpg" alt="">
               <p class="bannerName">约翰</p>
               <div class="studyDz">
                   <div class="dzimg"  >
                       <img src="/images/dz-icon.png" alt="">
                       <img src="/images/dz-icon-red.png" alt="" class="redDz">
                   </div>
                   <p>65656</p>
               </div>
           </div>
       </div>
       </div>
       <div class="caseud" now="1" num="10">
           <a href="javascript:;">加载更多</a>
       </div>
         <div class="addhight"></div>
       <!--引入footer-->
       @extends('layout.footer')
   </div>
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
<script src="/js/common.js"></script>
<script>
    $(function () {
        // getNote();
        getNote1();
        $(".styleTitle>p").click(function () {
            $(this).addClass("addcolor").siblings().removeClass("addcolor")
        })

        $(".dzimg>img").click(function () {
            $(this).hide().siblings().show();
        })


    })

    function handleToindex() {
        window.location.href = "/wap/index";
    }
// 头部切换
    function changeHead() {
        var titleList=""
            titleList+='<div class="styleSou">',
            titleList+=' <div class="souinp">',
            titleList+='<img src="/images/serch.png" alt="">',
            titleList+=' <input type="text" placeholder="请输入作品,店铺">',
            titleList+='</div>',
            titleList+='<p onclick="changeHead2()">取消</p>',
            titleList+='</div>'
        console.log(titleList)
       $("header").html(titleList)
    }

    function changeHead2() {
       var headList=""
        headList+='<ul>'
        headList+=' <li onclick="handleToindex()">'
        headList+='<img src="/images/fanhui.png" alt="">'
        headList+='</li>'
        headList+='<li class="styleTitle">'
        headList+=' <p class="addcolor">精选</p>'
        headList+=' <p>关注</p>'
        headList+=' </li>'
        headList+='<li>'
        headList+='<span onclick="changeHead()">'
        headList+='<img src="/images/serch.png" alt="">'
        headList+=' </span>'
        headList+='</li>'
        headList+='</ul>'
        $("header").html(headList)
    }
// 笔记列表
   function getNote(){
   	$.ajax({
   		type:"get",
   		url:"/getHotNote",
   		data:{},
   		async:true,
   		success:function(data){
   			console.log(data)
   			var liList = "";
			data.data.forEach(function(i) {
               liList+='<div id="bander">'
               liList+='<div class="swiper-container swiper-addone">'
			   liList+='<div class="swiper-wrapper">'
			   liList+='<div class="swiper-slide"><img src="'+i.image_one_url+'" alt=""></div>'
			   liList+='<div class="swiper-slide"><img src="'+i.image_three_url+'" alt=""></div>'
			   liList+='<div class="swiper-slide"><img src="'+i.image_two_url+'" alt=""></div>'
			   liList+='</div>'
			   liList+='<div class="swiper-pagination"></div>'
			   liList+='</div>'	
			   liList+='<p class="bannerTitle">"'+i.content+'"</p>'
			   liList+='<div class="studyPeople">'
			   liList+='<img src="/images/people2.jpg" alt="">'
			   liList+='<p class="bannerName">'+i.title+'</p>'
			   liList+='<div class="studyDz">'
			   liList+='<div class="dzimg">'
			   liList+='<img src="/images/dz-icon.png" alt="">'
			   liList+='<img src="/images/dz-icon-red.png" alt="" class="redDz">'
			   liList+='</div>'
			   liList+='<p>65656</p>'
			   liList+='</div>'
			   liList+='</div>'
			   liList+='</div>'
			})
			$(".noteList").html(liList)
   		}
   	});
   }

 function getNote1() {
     var state=true;
     //滚动条滚动的时候
     $(window).scroll(function(){
         //获取当前加载更多按钮距离顶部的距离
         var bottomsubmit = $('.caseud').offset().top;
         //获取当前页面底部距离顶部的高度距离
         var nowtop = $(document).scrollTop()+$(window).height();
         //获取当前页数，默认第一页
         var now = $('.caseud').attr('now');
         //获取总页数，PHP分页的总页数
         var num = $('.caseud').attr('num');
         //当当前页面的高度大于按钮的高度的时候开始触发加载更多数据
         if(nowtop>bottomsubmit){
             //如果为真继续执行，这个是用于防止滚动获取过多的数据情况
             if(state==true){
                 //执行一次获取数据并停止再进来获取数据
                 state=false;

                 setTimeout(function(){
                     //当前页数++
                     now++;
                     //记录当前为第二页
                     $('.caseud').attr('now',now);
                      console.log(now)
                     $.ajax({
                         //通过ajax传页数参数获取当前页数的数据
                         url:"/getHotNote",
                         data:{
                             "page":now,
                               "total":num
                         },
                         type:'GET',
                         cache:false,
                         // dataType:"html",
                         success:function(data){
                             console.log(data)
                             //把通过php处理的html和数据，写入容器底部
                             // $('.case').append(data);
                             //如果当前页大于等于总页数就提示没有更多数据

                             var liList = "";
                             data.data.forEach(function(i) {
                                 liList+='<div id="bander">'
                                 liList+='<div class="swiper-container swiper-addone">'
                                 liList+='<div class="swiper-wrapper">'
                                 liList+='<div class="swiper-slide"><img src="'+i.image_one_url+'" alt=""></div>'
                                 liList+='<div class="swiper-slide"><img src="'+i.image_three_url+'" alt=""></div>'
                                 liList+='<div class="swiper-slide"><img src="'+i.image_two_url+'" alt=""></div>'
                                 liList+='</div>'
                                 liList+='<div class="swiper-pagination"></div>'
                                 liList+='</div>'
                                 liList+='<p class="bannerTitle">"'+i.content+'"</p>'
                                 liList+='<div class="studyPeople">'
                                 liList+='<img src="/images/people2.jpg" alt="">'
                                 liList+='<p class="bannerName">'+i.title+'</p>'
                                 liList+='<div class="studyDz">'
                                 liList+='<div class="dzimg">'
                                 liList+='<img src="/images/dz-icon.png" alt="">'
                                 liList+='<img src="/images/dz-icon-red.png" alt="" class="redDz">'
                                 liList+='</div>'
                                 liList+='<p>65656</p>'
                                 liList+='</div>'
                                 liList+='</div>'
                                 liList+='</div>'

                             })
                             $(".noteList").html(liList)



                             if(now>=num){
                                 $('.caseud a').text('没有更多数据');
                                 //并把状态设置为假，下次下滑滚动时不再通过ajax获取数据
                                 state=false;
                             }else{
                                 // 否则继续
                                 state=true;
                             }
                         },
                         error:function(){
                             $('.caseud a').text('加载错误,请刷新页面！');
                         }
                     });
                 },500);
             }
         }
     });
 }

  
  function toNoteDetail(){
  	 window.location.href = "/wap/noteDetail/{noteId}";
  }
</script>
</html>