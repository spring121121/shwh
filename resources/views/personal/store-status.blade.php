<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>店铺-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common-body.css">
        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <h3>店铺申请说明</h3>
        </div>

        {{--申请店铺流程第一步--}}
        <div class="content-box store-apply-box store-apply-first">
            <div class="about-cave">
                <h3>店铺入驻</h3>
                <p>山洞文创生态系统平台是一个专注于做文创生态体系的平台，将中国的文化传承是为己任，是目前为止首个专为文创服务的平台。</p>
            </div>
            <div class="role-classify">
                <h4>入驻角色（四类角色）</h4>
                <ul>
                    <li>博物馆</li>
                    <li>文创机构</li>
                    <li>设计师</li>
                    <li>工厂</li>
                </ul>
            </div>
            <div class="btn-next-page" id="first-page">查看店铺入驻须知</div>
        </div>

        {{--申请店铺流程第二步--}}
        <div class="content-box store-apply-box">

            <div class="btn-next-page">店铺入住</div>
        </div>
        <div class="store-first-tip">
            <div class="tip-content">
                <span id="tip-text">你好{{$nickname}}，您还没有店铺。<br />请您先申请开店</span>
                <a id="register-store" href="/wap/register_store">去注册</a>
            </div>
        </div>

    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            $("#first-page").click(function () {
                
            });
            var address_url = window.location.search;
            var store_status = address_url.substr(4);
            console.log(store_status);
            if(store_status == 3){
                $("#tip-text").html("你好{{$nickname}}，您还没有店铺。<br />请您先申请开店")
                $("#register-store").html("去注册");
            }else if(store_status == 0){
                $("#tip-text").html("你好{{$nickname}}，您的申请正在审核。<br />请您耐心等待")
                $("#register-store").remove();
            }else if(store_status == 2){
                $("#tip-text").html("你好{{$nickname}}，您的申请已被驳回。<br />请您确认信息真实性")
                $("#register-store").html("去完善信息").attr("href","/wap/register_store?id="+store_status);
            }
        });
    </script>
</html>