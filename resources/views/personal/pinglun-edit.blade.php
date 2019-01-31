<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>评论-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header header-bottom">
            <div class="header-left header-reply"><a class="common-a btn" id="btn-pl-return" href="/wap/collection">取消</a></div>
            <div class="header-right header-reply"><a class="common-a btn" id="btn-pl-send" href="javascript:void(0);">发送</a></div>
            <h3 class="header-hf">评论<span>{{$nickname}}}</span></h3>
        </div>
        <div class="reply-cont">
            <textarea id="pl-content" placeholder="输入你想要说的话" rows="5"></textarea>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var url = window.location.search;
            var note_id = url.substr(4);
            $("#btn-pl-send").click(function () {
                var pinglun = $("#pl-content").val();
                if (pinglun == ""){
                    alert("请输入评论内容")
                }else {
                    $.ajax({
                        url : "/commentNote",	//请求url
                        type : "post",	//请求类型  post|get
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        data: {
                            'comment[note_id]':note_id,
                            'comment[content]':pinglun,
                        },
                        success : function(data){//回调函数 和 后台返回的 数据
                            console.log(data)
                            if (data.status){
                                alert("评论成功");
                                window.location.href = "/wap/collection";
                            }else {
                                alert("哎呀！出错了")
                            }
                        }
                    });
                }
            });
        })
    </script>
</html>