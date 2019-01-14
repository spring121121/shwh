<!Doctype HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>支付中</title>
    <script type="text/javascript">

        function onBridgeReady(){
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest', {
                    appId:"{{$prepay['appId']}}",
                    timeStamp:"{{$prepay['timeStamp']}}",
                    nonceStr:"{{$prepay['nonceStr']}}",
                    package:"{{$prepay['package']}}",
                    signType:"MD5",
                    paySign:"{{$prepay['paySign']}}"
                },
                function(res){
                    console.log(res)
                    WeixinJSBridge.call('closeWindow');
                    //document.addEventListener('WeixinJSBridgeReady', function(){ WeixinJSBridge.call('closeWindow'); }, false);
                }
            );
        }
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
            }
        }else{
            onBridgeReady();
        }
    </script>
</head>
<body>
</body>
</html>