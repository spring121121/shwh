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
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
        ]
    });
    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '山洞标题', // 分享标题
            desc: '自定义山洞描述',
            link: 'http://shwh.jianghairui.com/wx/share', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1548211804&di=d4e593085193f11411c5acba54fca29d&imgtype=jpg&er=1&src=http%3A%2F%2Fg.hiphotos.baidu.com%2Fzhidao%2Fwh%253D450%252C600%2Fsign%3D2a72651e33fa828bd17695e7c82f6d02%2Fcb8065380cd791230191756fad345982b2b780bc.jpg', // 分享图标
            success: function () {
                // 用户点击了分享后执行的回调函数
                // alert('分享成功')
            },

        });
        wx.onMenuShareAppMessage({
            title: '山洞标题', // 分享标题
            desc: '自定义山洞描述', // 分享描述
            link: 'http://shwh.jianghairui.com/wx/share', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1548211804&di=d4e593085193f11411c5acba54fca29d&imgtype=jpg&er=1&src=http%3A%2F%2Fg.hiphotos.baidu.com%2Fzhidao%2Fwh%253D450%252C600%2Fsign%3D2a72651e33fa828bd17695e7c82f6d02%2Fcb8065380cd791230191756fad345982b2b780bc.jpg', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // alert('分享成功')
            }
        });

    });



</script>
<h1>这是准备分享的内容!!!</h1>
</body>
</html>