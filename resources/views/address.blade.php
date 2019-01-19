<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
</head>
<body>
<script type="text/javascript">
    wx.config({
        debug: false,
        appId: "{{$addrSign["appId"]}}",
        timestamp: "{{$addrSign["timestamp"]}}",
        nonceStr: "{{$addrSign["nonceStr"]}}",
        signature: "{{$addrSign["signature"]}}",
        jsApiList: [
            'checkJsApi',
            'openAddress'
        ]
    });
    wx.ready(function () {
        // wx.openAddress({
        //     success: function (res) {
        //         alert(JSON.stringify(res));
        //     }
        //     error: function(res) {
        //         alert('failed')
        //     }
        // });
    });
    function getaddr() {
        wx.openAddress({
            success: function (res) {
                // 用户成功拉出地址
                // alert(JSON.stringify(res));
                document.getElementById("showAddress").innerHTML="收件人："+res.userName+"  <br>联系电话："+res.telNumber+"  <br>收货地址："+res.provinceName+res.cityName+res.countryName+res.detailInfo+"  <br>邮编："+res.postalCode;
            },
            cancel: function (errMsg) {
                // 用户取消拉出地址 //
                alert(JSON.stringify(errMsg));
            }
        });
    }




</script>
<h1 onclick="getaddr()">点击获取共享地址</h1>
<p id="showAddress">

</p>
</body>
</html>