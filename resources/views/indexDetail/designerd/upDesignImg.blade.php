<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞文化</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/active.css">
    <link rel="stylesheet" href="/styles/base.css">
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
</head>
<style>

</style>
<body>
<div class="zc_upImg">
    <div class="fileinput-button">
        图片选择<input type="file" name="file0" id="file0" multiple="multiple" />
    </div>
    <img src="/images/jia.png" id="img0" style="width: 200px;height: 150px;">

</div>
    <!--引入footer-->
    @extends('layout.footer')
</div>


</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>
    $(function () {
        $("#file0").change(function(){
            var objUrl = getObjectURL(this.files[0]) ;//获取文件信息
            console.log("objUrl = "+objUrl);

            // 放在全局
            window.url = objUrl;
            if (objUrl) {
                $("#img0").attr("src", objUrl);
            }
        }) ;
    })

    //获取地址
    function getObjectURL(file) {
        console.log(666)
        var url = null;
        if (window.createObjectURL!=undefined) {
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }

</script>

</html>

