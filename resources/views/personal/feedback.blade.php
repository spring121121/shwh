<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>意见反馈-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left qx-write"><a class="common-a" href="/wap/personal">取消</a></div>
            <h3>意见反馈</h3>
        </div>
        <div class="content-box">
            <div class="note-ipt-box">
                <form action="">
                    <div class="note-cont"><textarea id="feedback" placeholder="写下您对山洞的意见及建议，我们会及时查看" rows="15"></textarea></div>
                    {{--<ul>--}}
                        {{--<li><div class="btn-phone"><span>添加证据</span></div></li>--}}
                    {{--</ul>--}}
                </form>
            </div>
            <div class="btn-write-note">
                <a class="common-a" href="javascript:void(0);" id="btn-submit">提交</a>
                <a class="common-a other-color" href="/wap/personal">取消</a>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            $("#btn-submit").click(function () {
                var feedback = $("#feedback").val();
                if (feedback == ""){
                    layer.msg("请输入你想要反馈的问题和建议");
                }else {
                    $.ajax({
                        url : "/feedback",	//请求url
                        type : "post",	//请求类型  post|get
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        data: {
                            feedback:feedback
                        },
                        success : function(data){//回调函数 和 后台返回的 数据
                            if (data.status){
                                layer.msg("提交成功",{
                                    time: 3000 //不自动关闭
                                },function () {
                                    window.location.href = "/wap/personal";
                                });
                            }else {
                                layer.msg(data.message);
                            }
                        }
                    });
                }
            });
        })
    </script>
</html>