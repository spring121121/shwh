<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>注册-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/style.css">
        <link rel="stylesheet" href="/styles/common.css">
    </head>
    <body>
        <div class="dlzc-box">
            <div class="logo-box register-logo-box">
                <img class="common-img" src="/images/logo-2x.png" alt="神奇的山洞">
            </div>
            <div class="chose-login register-title">
                <h3>欢迎注册山洞</h3>
            </div>
            <div class="ipt-cont">
                <form action="">
                    <div class="ipt-box"><input class="phone" type="text" placeholder="请输入手机号码"></div>
                    <div class="ipt-box"><input class="password" type="password" placeholder="请输入密码"></div>
                    <div class="ipt-box"><input class="password-again" type="password" placeholder="请再次输入密码"></div>
                    <div class="ipt-box yzm-code"><input id="code" type="text" placeholder="请输入验证码">
                        {{--<button class="verification">验证码</button>--}}
                        <div class="yzm-img"><img class="common-img" src="/getCodeImg"/></div>
                    </div>
                </form>
                <div class="tips">请输入8-16位英文和数字密码</div>
                <div class="btn-box">
                    <button class="register">注册</button>
                    <button class="return">取消</button>
                </div>
            </div>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/proving.js"></script>
    <script>
        $(function () {
            $(".register").click(function () {
                var phone = $(".phone").val();
                var pass = $(".password").val();
                var passAgain = $(".password-again").val();
                var code = $("#code").val();
                console.log(phone,pass,passAgain,code)
                $.ajax({
                    url : "/register",	//请求url
                    type : "post",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {
                        "mobile":phone,
                        "password":pass,
                        "password_again":passAgain,
                        "code":code
                    },
                    success : function(data){//回调函数 和 后台返回的 数据
                        console.log(data)
                        if (data.code == 200){
                            console.log("注册成功")
                        } else {
                            console.log("注册失败")
                        }
                    }
                });
            });
        });
    </script>
</html>