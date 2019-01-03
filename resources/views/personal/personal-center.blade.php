<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>个人中心-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <!--头像和昵称的模块-->
        <div class="personal-header">
            <div class="personal-title">
                <div class="portrait-box">
                    <img class="common-img" src="/images/" alt="头像">
                </div>
                <div class="edit-personal">
                    <a class="btn-edit" href="message-center.html"></a>
                    <h3>输入你的昵称</h3>
                    <span>编辑你的资料 <i></i></span>
                </div>
                <div class="address-grade">
                    <div class="personal-icon-box"><img class="common-img" src="/images/wechat-bg-2x.png" /></div>
                    <i></i>
                    <span>天津市 西青</span>
                    <i></i>
                    <div class="personal-icon-box"><img class="common-img" src="/images/wechat-bg-2x.png" /></div>
                    <span>个人等级</span>
                </div>
            </div>
        </div>
        <!--个人中心内容模块-->
        <div class="personal-cont">
            <ul>
                <li>
                    <a href="my-note.html">
                        <div class="icon-img"><img class="common-img" src="/images/wechat-bg-2x.png" alt="笔记"></div>
                        <p>笔记</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-img"><img class="common-img" src="/images/wechat-bg-2x.png" alt="笔记"></div>
                        <p>收藏</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-img"><img class="common-img" src="/images/wechat-bg-2x.png" alt="笔记"></div>
                        <p>店铺</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-img"><img class="common-img" src="/images/wechat-bg-2x.png" alt="笔记"></div>
                        <p>关注</p>
                    </a>
                </li>
            </ul>
            <div class="list-box">
               <div class="list-cont">
                   <span>我的优惠券</span>
                   <i></i>
               </div>
                <div class="list-cont">
                    <span>我的订单</span>
                    <i></i>
                </div>
                <div class="list-cont">
                    <a href="my-address.html">
                        <span>我的收货地址</span>
                        <i></i>
                    </a>
                </div>
            </div>
            <div class="list-box">
                <div class="list-cont">
                    <span>意见反馈</span>
                    <i></i>
                </div>
            </div>
            <div class="btn-exit-login">
                <button>退出登录</button>
            </div>
        </div>
    
        <!--引入footer-->
        @extends('layout.footer')
    </body>
</html>