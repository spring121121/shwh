<?php

require_once "Jssdk.php";

$jssdk = new Jssdk("wx1dc64acc9bd9eb09", "18030345ebbbc089f628a5eb1db5cda3");
$data = $jssdk->getSignPackage();




function halt($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die();
}
?>
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
        appId: "<?php echo $data['appId'];?>",
        timestamp: "<?php echo $data['timestamp'];?>",
        nonceStr: "<?php echo $data['nonceStr'];?>",
        signature: "<?php echo $data['signature'];?>",
        jsApiList: [
            'checkJsApi',
            'openAddress'
        ]
    });
    wx.ready(function () {
        wx.openAddress({
            success: function (res) {
                // alert(JSON.stringify(res));
                document.getElementById("showAddress").innerHTML="<h2>已获取如下信息</h2><br>收件人："
                    +res.userName+"  <br>联系电话："
                    +res.telNumber+"  <br>收货地址："
                    +res.provinceName
                    +res.cityName
                    +res.countryName
                    +res.detailInfo
                    +"  <br>邮编："
                    +res.postalCode;
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
<div id="showAddress" style="font-size: 16px"></div>
</body>
</html>


