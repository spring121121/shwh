<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/personal.css">
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
                document.getElementById("shr-name").value=   res.userName;
                document.getElementById("shr-address-info").value = res.provinceName + res.cityName + res.countryName + res.detailInfo;
                document.getElementById("shr-phone").value = res.telNumber;
                document.getElementById("province").innerHTML = '<option>'+res.provinceName+'</option>';
                document.getElementById("city").innerHTML = '<option>'+res.cityName+'</option>';
                document.getElementById("area").innerHTML = '<option>'+res.countryName+'</option>';
            },
            cancel: function (errMsg) {
                // 用户取消拉出地址 //
                alert(JSON.stringify(errMsg));
            }
        });
    }




</script>
<div class="header">
    <div class="header-left"><a href="/wap/my_address"></a></div>
    <h3 class="top-title">增加收货地址</h3>
</div>
<div class="content-box">
    <div class="ipt-cont ipt-address-box">
        <form>
            <div class="ipt-box"><input id="shr-name" type="text" placeholder="收货人姓名"></div>
            <div class="ipt-box"><input id="shr-phone" type="text" placeholder="手机号码"></div>
            <div class="ipt-box address-choice">
                <label>收货地址</label>
                <div class="select-box">
                    <select id="province" name="province">
                        <option>请选择省份</option>
                    </select>
                    <select id="city" name="city">
                        <option>请选择城市</option>
                    </select>
                    <select id="area" name="area">
                        <option>请选择地区</option>
                    </select>
                </div>
            </div>
            <label>具体位置</label>
            <div class="ipt-box"><input id="shr-address-info" type="text" placeholder="小区名称xx号楼xx门门牌号"></div>
            <div class="ipt-box default-box"><input type="checkbox" id="default">设置为默认<label for="default"><em></em></label></div>
        </form>
    </div>
    <div class="btn-new-address"><a href="#" id="btn-new-keep">保存</a></div>
    <div onclick="getaddr()"  class="btn-new-address">
        <a href="#" id="btn-new-keep">点击获取微信地址</a>
    </div>
</div>
</body>
</html>