<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞-设计师-搜索</title>
    <link rel="stylesheet" href="/styles/designerd_works.css">
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
</head>
<style>
    .write-note{
        position: fixed;
        width: 50px;
        left: 50%;
        margin-left: -25px;
        bottom: 60px;
        text-align: center;
    }
    .write-note span{
        color: #000;
        font-size: 14px;
    }
    .write-note .write-img-box{
        width: 42px;
        height: 42px;
        margin: 0 auto;
        background-image: url("../images/jiahao-white.png");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 70%;
        background-color: #333;
        border-radius: 50%;
    }
    .addhight{
        width: 100%;
        height: 62px;
    }
    .caseud{
        line-height: 30px;
        background: #eee;
    }
    .caseud a{
        font-size: 14px;
        color: #999;
        display: block;
        color: #000;
        width: 100%;
        height: 100%;
        font-size: 12px;
        text-align: center;
    }
</style>
<body>
    <div id="home">
        <header>
            <ul>
                <li>
               
                    <span onclick="history.bsck()" class="iconfont icon-ffanhui-"></span>
                </li>
                <li>作品展示</li>
                <li>
                    <span></span>
                </li>
            </ul>
        </header>

        <p class="worksText">经典艺术</p>
        <div class="workContainer">
        <div class="worksList">
            <div class="worksImg">
                <img src="/images/collection-img6.jpg" alt="">
            </div>
            <div class="worksZs">
                <p>景德镇青花瓷</p>
                <img src="/images/dz-icon.png" alt="">
                <p>1666</p>
            </div>
        </div>
        <div class="worksList">
            <div class="worksImg">
                <img src="/images/collection-img5.jpg" alt="">
            </div>
            <div class="worksZs">
                <p>景德镇青花瓷</p>
                <img src="/images/dz-icon.png" alt="">
                <p>1666</p>
            </div>
        </div>
        <div class="worksList">
            <div class="worksImg">
                <img src="/images/collection-img4.jpg" alt="">
            </div>
            <div class="worksZs">
                <p>景德镇青花瓷</p>
                <img src="/images/dz-icon.png" alt="">
                <p>1666</p>
            </div>
        </div>
        </div>
        <div class="caseud" page="1" total="10">
            <a href="javascript:void(0);"></a>
        </div>
        <div class="write-note">
            <a href="/wap/upDesign?demoId=0">
                <div class="write-img-box"></div>
            </a>
        </div>

        <div class="addhight"></div>
    </div>

    <!--引入footer-->
    @extends('layout.footer')
</body>
 <script type="text/javascript" src="/js/jquery-1.11.0.js" ></script>
 <script>
     $(function () {
         var limit=10;
         getMywork(1, 10)
         $(window).scroll(function () {
             if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
                 var page = parseInt($(".caseud").attr('page'))
                 var total = parseInt($(".caseud").attr('total'))
                 var pages = Math.ceil(total / limit);
                 if (page <=pages) {
                      getMywork(page, limit)
                 }

             }
         });
     })
 	function handleTodesi(){
 		window.location.href = "/wap/design";
 	}

 	function getMywork(page, limit) {
        $.ajax({
            type: "get",
            url: "/getMyCreationList",
            data: {
                'page': page,
                'limit': limit
            },
            async: true,
            success: function (data) {
                console.log(data)
              var datalist="";
                data.data.forEach(function (i) {
                        datalist+='<div class="worksList">'
                        datalist+='  <div class="worksImg">'
                        datalist+=' <img src="/images/collection-img6.jpg" alt="">'
                        datalist+='</div>'
                        datalist+='  <div class="worksZs">'
                        datalist+='  <p>景德镇青花瓷</p>'
                        datalist+='<img src="/images/dz-icon.png" alt="">'
                        datalist+='<p>1666</p>'
                        datalist+=' </div>'
                        datalist+='</div>'
                })
                $(".workContainer").html(datalist)
            }
        });
    }
 </script>
</html>
<script>
   
</script>
