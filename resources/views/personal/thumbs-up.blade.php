<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>点赞笔记-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/my_note"></a></div>
            <div class="header-right"><a href="/wap/personal">我的</a></div>
            <div class="header-right"></div>
            <h3>点赞笔记</h3>
        </div>
        <div class="content-box">
            <ul class="note-list-box" id="dianzan-box">
                <li>
                    <div class="note-img"><img class="common-img" src="/images/"></div>
                    <div class="note-list-right">
                        <a href="#" class="btn-notes"><i></i>浏览</a>
                        <h3>探宝笔记的标题<span>2018-12-26 13:30</span></h3>
                        <p>笔记的部分内容,笔记的部分内容,笔记的部分内容,笔记的部分内容</p>
                        <a href="#" class="btn-notes"><i></i>赞</a>
                        <a href="#" class="btn-notes"><i></i>评论</a>
                        <a href="#" class="btn-notes"><i></i>转发</a>
                    </div>
                </li>
                <li>
                    <div class="note-img"><img class="common-img" src="/images/"></div>
                    <div class="note-list-right">
                        <a href="#" class="btn-notes"><i></i>浏览</a>
                        <h3>探宝笔记的标题<span>2018-12-26 13:30</span></h3>
                        <p>笔记的部分内容,笔记的部分内容,笔记的部分内容,笔记的部分内容</p>
                        <a href="#" class="btn-notes"><i></i>赞</a>
                        <a href="#" class="btn-notes"><i></i>评论</a>
                        <a href="#" class="btn-notes"><i></i>转发</a>
                    </div>
                </li>
            </ul>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var page = 1;
            $.ajax({
                url : "/getMyLikeNote",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {
                    limit:5,
                    page:page
                },
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    var noteHtml = '';
                    if (data.status){
                        $.each(data.data, function (k, v) {
                            noteHtml += '<li>';
                            noteHtml += '<div class="note-img"><img class="common-img" src="' + v.image_one_url + '"></div>';
                            noteHtml += '<div class="note-list-right">';
                            noteHtml += '<h3>' + v.title + '<span>' + v.created_at + '</span></h3>';
                            noteHtml += '<p>' + v.content + '</p>';
                            noteHtml += '<div class="btn-notes btn-zf"><i></i>转发(' + v.forwardNum + ')</div>';
                            noteHtml += '<div class="btn-notes btn-pl-list"><i></i>评论(' + v.commentNum + ')</div>';
                            noteHtml += '<div class="btn-notes btn-zan"><i></i>赞(' + v.likeNum + ')</div>';
                            noteHtml += '</div></li>';
                        });
                        $("#dianzan-box").html(noteHtml);
                    }else {
                        alert("哎呀！出错了")
                    }
                }
            });
        })
    </script>
</html>