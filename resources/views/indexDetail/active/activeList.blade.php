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
</head>
<body>
 <div class="container">
     <header>
         <div class="activeTitle">
             <div class="goIndex" onclick="toIndex()"><img src="/images/fanhui.png" alt=""></div>
             <p>活动展览</p>
             <span></span>
         </div>
     </header>

     <div class="activeContent">
         <div class="activeGo">
             <img src="/images/haibao.jpg" alt="" onclick="toDetail()">
             <p class="listTitle">2019 NEW ERA 青春电影</p>
             <div class="listTime">
                 <img src="/images/time.png" alt="">
                 <p>2019.1.24-2019.1.28                                                                                                                                                                                                                                        </p>
             </div>
         </div>
     </div>

     <div class="activeContent">
         <div class="activeGo">
             <img src="/images/haibao2.jpg" alt="" onclick="toDetail()">
             <p class="listTitle">VGLO.01 欢迎来到我的宇宙</p>
             <div class="listTime">
                 <img src="/images/time.png" alt="">
                 <p>2019.1.24-2019.1.28                                                                                                                                                                                                                                        </p>
             </div>
         </div>
     </div>

     <div class="activeContent">
         <div class="activeGo">
             <img src="/images/haibao3.jpg" alt="" onclick="toDetail()">
             <p class="listTitle">凯迪拉克XT4然炸 </p>
             <div class="listTime">
                 <img src="/images/time.png" alt="">
                 <p>2019.1.24-2019.1.28                                                                                                                                                                                                                                        </p>
             </div>
         </div>
     </div>

     <div class="activeContent">
         <div class="activeGo">
             <img src="/images/haibao.jpg" alt="" onclick="toDetail()">
             <p class="listTitle">2019 NEW ERA 青春电影</p>
             <div class="listTime">
                 <img src="/images/time.png" alt="">
                 <p>2019.1.24-2019.1.28                                                                                                                                                                                                                                        </p>
             </div>
         </div>
     </div>
     <div class="addhight"></div>

     <!--引入footer-->
     @extends('layout.footer')
 </div>


</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>
    function toIndex(){
        window.location.href = "/wap/index";
    }

    function  toDetail() {
        window.location.href = "/wap/activeDetail";
    }

</script>
</html>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
