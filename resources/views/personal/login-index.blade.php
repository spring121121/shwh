<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>登录-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common-body.css">
        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="dlzc-box">
            <div class="vertical-center">
                <div class="logo-box">
                    <img class="common-img" src="/images/logo.png" alt="神奇的山洞">
                </div>
                <div class="chose-login fc-login">
                    <h3>由此爱上文创</h3>
                </div>
                <div class="ipt-cont">
                    <div class="btn-box">
                        {{--<a href="/wap/login" class="login">手机号登录</a>--}}
                        <a href="http://shwh.jianghairui.com/wx/auth" class="register weChat-login">微信登录</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mask-box">
            <div class="weChat">
                <h3>微信授权</h3>
                <div class="head-portrait"><img class="common-img" src="/images/weChat-2x.png"></div>
                <div class="success">微信授权成功</div>
                <span>授权绑定的手机号码</span>
                <div class="btn-mask">
                    <button id="btn-qx">取消</button>
                    <button>允许</button>
                </div>
            </div>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
</html>