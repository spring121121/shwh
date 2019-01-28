<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
</head>
<body>
<script type="text/javascript">
    wx.config({
        debug: false,
        appId: "{{$data["appId"]}}",
        timestamp: "{{$data["timestamp"]}}",
        nonceStr: "{{$data["nonceStr"]}}",
        signature: "{{$data["signature"]}}",
        jsApiList: [
            'checkJsApi',
            'getLocation',
        ]
    });
    wx.ready(function () {

    });

    function getLocation() {
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
                document.getElementById("showLocation").innerHTML="经度："+res.latitude+"  <br>纬度："+res.longitude+"  <br>速度：" + res.speed + "  <br>位置精度："+res.accuracy;
            }
        });
    }



</script>
<h1 onclick="getLocation()">点击获取地理位置</h1>
<p id="showLocation">

</p>
</body>
</html>