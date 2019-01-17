<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
</head>
<body>
<script type="text/javascript">
    wx.config({
        debug: true,
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
        wx.openAddress({
            success: function (res) {
                alert(JSON.stringify(res));
            }
            // error: function(res) {
            //     alert('failed')
            // }
        });
    });
    // function getaddr() {
    //     wx.openAddress({
    //         success: function (res) {
    //             // 用户成功拉出地址
    //             //alert(JSON.stringify(res));
    //             document.getElementById("showAddress").innerHTML="收件人："+res.userName+"  联系电话："+res.telNumber+"  收货地址："+res.proviceFirstStageName+res.addressCitySecondStageName+res.addressCountiesThirdStageName+res.addressDetailInfo+"  邮编："+res.addressPostalCode;
    //         },
    //         cancel: function (errMsg) {
    //             // 用户取消拉出地址 //
    //             alert(errMsg);
    //         }
    //     });
    // }



</script>
</body>
</html>