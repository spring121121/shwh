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

       <div id="bander">
           <div class="swiper-container swiper-addone">
               <div class="swiper-wrapper">
                   <div class="swiper-slide"><img src="/images/wenyi1.jpg" alt=""></div>
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
                   <div class="dzimg">
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
               <!-- Add Pagination -->
               <div class="swiper-pagination"></div>
               <!-- Add Arrows -->
               <!-- <div class="swiper-button-next"></div>
               <div class="swiper-button-prev"></div> -->
           </div>
           <p class="bannerTitle">"苍茫宇宙&nbsp无边无际"</p>
           <div class="studyPeople">
               <img src="/images/people.jpg" alt="">
               <p class="bannerName">约翰</p>
               <div class="studyDz">
                   <div class="dzimg">
                       <img src="/images/dz-icon.png" alt="">
                       <img src="/images/dz-icon-red.png" alt="" class="redDz">
                   </div>
                   <p>65656</p>
               </div>
           </div>
       </div>
         <div class="addhight"></div>
       <!--引入footer-->
       @extends('layout.footer')
   </div>
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
<script>
    $(function () {
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


</script>
</html>