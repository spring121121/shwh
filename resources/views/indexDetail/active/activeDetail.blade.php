<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞文化</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/active.css">
    <link rel="stylesheet" href="/styles/base.css">
</head>
<body>
<div class="container">
    <header>
        <div class="activeTitle">
            <div class="goIndex" onclick="toIndex()"><img src="/images/fanhui.png" alt=""></div>
            <p class="btn1">2019evn我的青春</p>
            <span></span>
        </div>
    </header>
       <div class="de_navActive">
           <ul>
               <li class="addcolor c" >需求说明</li>
               <li class="d" >奖项设置</li>

               <li class="e">获奖作品</li>
           </ul>
       </div>
     <div class="addtTopheight"></div>
    <div class="de_activeRule" id="activeRule">
        <p class="de_ruleOne">竞赛说明</p>
        <p class="de_ruleTwo">早晨醒来，习惯性地打开微信朋友圈，看一下微信好友们的见闻，心得和生活。

            　　 又一次愕然看到有人午夜痛苦的说说："人活着到底为了什么……"

            　　 当越来越多的人在讨论人到底为什么而活着的时候，我想，在物欲横流的今天，
            是更多的人迷失了，甚至忽略了这个问题。

            　　 这个被物质冲昏头脑的社会，让世人活得也很累，究其原因，是我们被迫追逐得太多。

            　　 是啊，我们到底为什么活着呢？物质的最大化，还是梦想的美好？或是为爱我的人和我爱的人，
            还是那些莫名奇妙的执着与眷恋……

            　　 好像对于每个人而言都有不下一万种答案，但总的来讲只是我们要快乐富足的活着。
            因为没有谁会甘心情愿生活在困苦之中，承受身
            心煎熬。谁都不希望在追寻梦想的道路上自己是下一个凡・高。必竟人活着离不开物质，
            你所追求的艺术与梦想也都需要物质做铺垫。
        </p>
        <p class="de_ruleOne">规则说明</p>
         <div class="">
             <p class="de_ruleTwo">1.次愕然看到有人午夜痛苦的说说："人活着到底为了什么……"</p>
             <p class="de_ruleTwo">2. 好像对于每个人而言都有不下一万种答案，但总的来讲"</p>
             <p class="de_ruleTwo">3.次愕然看到有人午夜痛苦的说说："人活着到底为了什么……"</p>
             <p class="de_ruleTwo">4. 好像对于每个人而言都有不下一万种答案，但总的来讲"</p>
             <p class="de_ruleTwo">5.次愕然看到有人午夜痛苦的说说："人活着到底为了什么……"</p>
         </div>
    </div>
    <div class="de_activeGold" id="activeGold">
        <p class="de_ruleOne">奖项设置</p>
        <div class="de_myGold">
            <p class="de_ruleTwo">一等奖</p>
            <img src="/images/collection-img1.jpg" alt="">
        </div>
        <div class="de_myGold">
            <p class="de_ruleTwo">二等奖</p>
            <img src="/images/collection-img1.jpg" alt="">
        </div>
        <div class="de_myGold">
            <p class="de_ruleTwo">三等奖</p>
            <img src="/images/collection-img1.jpg" alt="">
        </div>
    </div>
    
    <div class="de_activeList" id="activeList">
        <p class="de_ruleOne">获奖作品</p>
        <ul class="de_ListGode clearfix">
            <li>
                <img src="/images/collection-img3.jpg" alt="">
                <p class="de_workName">杯子蛋糕</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img2.jpg" alt="">
                <p class="de_workName">情调广场</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img4.jpg" alt="">
                <p class="de_workName">杯子蛋糕</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img5.jpg" alt="">
                <p class="de_workName">咖啡蛋挞</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img3.jpg" alt="">
                <p class="de_workName">杯子蛋糕</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img6.jpg" alt="">
                <p class="de_workName">茄子黄瓜</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img3.jpg" alt="">
                <p class="de_workName">杯子蛋糕</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img5.jpg" alt="">
                <p class="de_workName">银狐</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>

        </ul>
    </div>
    <div class="de_addheight"></div>


    <!--引入footer-->
    @extends('layout.footer')
</div>


</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>
    $(function(){
        $(document).scroll(function(){
            var wheight=$(window).height();
            var stop=$(document).scrollTop();
            var m=$("#activeRule").offset().top;


            var n=$("#activeGold").offset().top
            var k=$("#activeList").offset().top
          console.log(m+100+"px")
            if (stop>(m-200)) {
                $(".c").addClass("addcolor").siblings().removeClass("addcolor");
            }
            if (stop>(n-200)) {
                $(".d").addClass("addcolor").siblings().removeClass("addcolor");
            }
            if (stop>(k-200)) {
                $(".e").addClass("addcolor").siblings().removeClass("addcolor");
            }
        })

    })

    function toIndex() {
        window.location.href = "/wap/activeList";
    }

</script>
</html>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
