<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>店铺-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common-body.css">
        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <h3 id="apply-title">店铺申请说明</h3>
        </div>

        {{--申请店铺流程第一步--}}
        <div class="content-box store-apply-box store-apply-first">
            <div class="first-cont">
                <div class="about-cave">
                    <h3>店铺入驻</h3>
                    <p>山洞文创生态系统平台是一个专注于做文创生态体系的平台，将中国的文化传承是为己任，是目前为止首个专为文创服务的平台。</p>
                </div>
                <div class="apply-process">
                    <ul>
                        <li class="active-color">
                            <span>填写信息</span>
                            <div class="circle-dot"></div>
                        </li>
                        <li><em></em></li>
                        <li>
                            <span>审核</span>
                            <div class="circle-dot"></div>
                        </li>
                        <li><em></em></li>
                        <li>
                            <span>申请成功</span>
                            <div class="circle-dot"></div>
                        </li>
                    </ul>
                    <div class="apply-tip">
                        <span>提示：</span>
                        <p>选择您的入驻角色，有助于我们为您快速挑选入驻需要的重要证件资料，以便您快速入驻</p>
                    </div>
                </div>
                <div class="role-classify">
                    <h4>入驻角色（请选择您想要入驻的角色）</h4>
                    <ul id="choice-role">
                        <li>博物馆</li>
                        <li>文创机构</li>
                        <li>设计师</li>
                        <li>工厂</li>
                    </ul>
                </div>
                <div class="role-classify">
                    <h4>您需要准备的入驻资料如下：</h4>
                    <p id="one-tip"></p>
                    <p id="two-tip"></p>
                    <p id="three-tip"></p>
                </div>
                <div class="btn-next-page" id="first-page">申请入驻</div>
            </div>
        </div>

        {{--申请店铺流程第二步--}}
        <div class="content-box store-apply-box store-apply-second">
            <div class="about-cave second-title">
                <h3>申请店铺</h3>
                <p class="second-text">看得见的文创孵化</p>
            </div>
            <div class="apply-process">
                <ul>
                    <li class="active-color">
                        <span>填写信息</span>
                        <div class="circle-dot"></div>
                    </li>
                    <li><em></em></li>
                    <li>
                        <span>审核</span>
                        <div class="circle-dot"></div>
                    </li>
                    <li><em></em></li>
                    <li>
                        <span>申请成功</span>
                        <div class="circle-dot"></div>
                    </li>
                </ul>
            </div>
            <div class="choice-role">
                <h3>选择你的入驻角色</h3>
                <ul>
                    <li><span>博物馆</span><label><input type="radio" name="ch"><i>✓</i>单选框</label></li>
                    <li><span>文创机构</span><label><input type="radio" name="abc"><i>✓</i>单选框</label></li>
                    <li><span>设计师</span><label><input type="radio" name="abc"><i>✓</i>单选框</label></li>
                    <li><span>工厂</span><label><input type="radio" name="abc"><i>✓</i>单选框</label></li>
                </ul>
            </div>
            <div class="btn-next-page">店铺入驻</div>
        </div>
        <div class="store-first-tip">
            <div class="tip-content">
                <span id="tip-text">你好{{$nickname}}，您还没有店铺。<br />请您先申请开店</span>
                <a id="register-store" href="/wap/register_store">去注册</a>
            </div>
        </div>

        <div class="protocol-box">
            <div class="protocol">
                <h3>山洞店铺入驻协议</h3>
                <p>欢迎您入驻成为本平台店铺！在入驻成为本平台店铺之前，请您先详细阅读店铺入驻协议!
                    山海文化有限公司（以下合称“山海文化”）同意按照本协议的规定及其不时发布的操作规则提供相关的服务，为店铺注册人（以下称“用户”）
                    应当同意本协议的全部条款并按照页面上的提示完成全部的入驻程序。用户在进行申请店铺过程中点击“同意”按钮即表示用户完全接受本协议项下的全部条款。
                </p>
                <p>欢迎您入驻成为本平台店铺！在入驻成为本平台店铺之前，请您先详细阅读店铺入驻协议!
                    山海文化有限公司（以下合称“山海文化”）同意按照本协议的规定及其不时发布的操作规则提供相关的服务，为店铺注册人（以下称“用户”）
                    应当同意本协议的全部条款并按照页面上的提示完成全部的入驻程序。用户在进行申请店铺过程中点击“同意”按钮即表示用户完全接受本协议项下的全部条款。
                </p>
                <p>欢迎您入驻成为本平台店铺！在入驻成为本平台店铺之前，请您先详细阅读店铺入驻协议!
                    山海文化有限公司（以下合称“山海文化”）同意按照本协议的规定及其不时发布的操作规则提供相关的服务，为店铺注册人（以下称“用户”）
                    应当同意本协议的全部条款并按照页面上的提示完成全部的入驻程序。用户在进行申请店铺过程中点击“同意”按钮即表示用户完全接受本协议项下的全部条款。
                </p>
            </div>
            <div class="btn-is-Agree">
                <span id="not-agree">不同意</span>
                <span id="btn-agree">我已阅读完毕，同意协议</span>
            </div>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var address_url = window.location.search;
            var store_status = address_url.substr(4);
            var role_id;

            //判断当前的店铺处于什么阶段的状态
            if(store_status == 3){
                $("#tip-text").html("你好{{$nickname}}，您还没有店铺。<br />请您先申请开店")
                $("#register-store").html("去注册");
            }else if(store_status == 0){
                $("#tip-text").html("你好{{$nickname}}，您的申请正在审核。<br />请您耐心等待")
                $("#register-store").remove();
            }else if(store_status == 2){
                $("#tip-text").html("你好{{$nickname}}，您的申请已被驳回。<br />请您确认信息真实性")
                $("#register-store").html("去完善信息").attr("href","/wap/register_store?id="+store_status);
            }

            $("#choice-role").on("click","li",function () {
                $(this).addClass("choice-role-color");
                $(this).siblings().removeClass("choice-role-color");
                if ($(this).index() == 0){
                    role_id = 2;
                    $("#one-tip").html("1、店主的身份证照片");
                    $("#two-tip").html("2、博物馆的资质证明");
                    $("#three-tip").html("");
                }
                if ($(this).index() == 1){
                    role_id = 4;
                    $("#one-tip").html("1、店主的身份证照片");
                    $("#two-tip").html("2、文创机构的资质证明");
                    $("#three-tip").html("");
                }
                if ($(this).index() == 2){
                    role_id = 3;
                    $("#one-tip").html("1、店主的身份证照片");
                    $("#two-tip").html("");
                    $("#three-tip").html("");
                }
                if ($(this).index() == 3){
                    role_id = 5;
                    $("#one-tip").html("1、店主的身份证照片");
                    $("#two-tip").html("2、工厂的资质证明");
                    $("#three-tip").html("");
                }
            });


            $("#first-page").click(function () {
                if ($("#choice-role li").hasClass("choice-role-color")) {
                    $(".protocol-box").css("display","block");
                    $(".protocol").animate({"height":"500px"},500,function () {
                        $(".btn-is-Agree").animate({"height":"50px"},250);
                    });
                }else {
                    alert("请选择您想入驻的角色");
                }
            });
            $("#not-agree").click(function () {
                $(".protocol-box").css("display","none");
                $(".protocol").css({"height":"0"});
                $(".btn-is-Agree").css({"height":"0"});
            });
            $("#btn-agree").click(function () {
                console.log(role_id)
                window.location.href = "/wap/register_store?id="+role_id;
                $(".protocol-box").css("display","none");
                $(".protocol").css({"height":"0"});
                $(".btn-is-Agree").css({"height":"0"});
            });
        });
    </script>
</html>