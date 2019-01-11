<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>收藏夹-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <h3 class="top-title">收藏</h3>
        </div>
        <div class="content-box">
            <div class="flex-box">
                <ul class="flex-left"></ul>
                <ul  class="flex-right"></ul>
            </div>
        </div>

    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var leftHtml = '',rightHtml = '';
            $.ajax({
                url : "/getMyCollectNote",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    if (data.status){
                        $.each(data.data, function (k, v) {
                            if(v.id%2 == 0){
                                rightHtml = flex(rightHtml,v);
                            }else {
                                leftHtml = flex(leftHtml,v);
                            }
                        });
                        $(".flex-left").html(leftHtml);
                        $(".flex-right").html(rightHtml);
                    }else {
                        alert("哎呀！出错了")
                    }
                }
            });
            $(".flex-box").on("click",".pl-icon",function () {
                var note_id = $(this).parents("li").attr("id");
                window.location.href = "/wap/pinglun_edit?id="+note_id;
            })
        });
        function flex(obj,v) {
            obj += '<li id="'+v.id+'"><div class="flex-img-box">';
            obj += '<img src="'+v.image_one_url+'" class="common-img">';
            obj += '<span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>96人</span>';
            obj += '</div><h3>'+v.title+'</h3>';
            obj += '<p>'+v.content+'</p>';
            obj += '<div class="btn-flex-box">';
            obj += '<span class="zan-icon"><i></i>('+v.likeNum+')</span>';
            obj += '<span class="pl-icon"><i></i>('+v.commentNum+')</span>';
            obj += '<span class="zf-icon"><i></i>('+v.forwardNum+')</span>';
            obj += '</div></li>';
            return obj;
        }
    </script>
</html>