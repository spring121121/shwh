<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>消息中心-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <h3>消息中心</h3>
        </div>
        <div class="massage-category">
            <ul>
                <li>系统消息</li>
                <li>评论消息</li>
                <li>推荐消息</li>
            </ul>
        </div>

        <!--评论消息-->
        <div class="massage-cont discuss">
            <ul></ul>
        </div>

        <!--推荐消息-->
        <div class="massage-cont recommend">
            <ul>
                <li>
                    <a href="#">
                        <div class="recommend-banner-box">
                            <img class="common-img" src="/images/test.jpg" alt="banner图">
                            <div class="re-title">
                                <h3>推荐消息的标题1<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="recommend-banner-box">
                            <img class="common-img" src="/images/re-banner.png" alt="banner图">
                            <div class="re-title">
                                <h3>推荐消息的标题2<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="recommend-banner-box">
                            <img class="common-img" src="/images/test.jpg" alt="banner图">
                            <div class="re-title">
                                <h3>推荐消息的标题<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="recommend-banner-box">
                            <img class="common-img" src="/images/re-banner.png" alt="banner图">
                            <div class="re-title">
                                <h3>推荐消息的标题<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <!--系统消息-->
        <div class="massage-cont system">
            <ul>
                <li>
                    <a href="#">
                        <div class="massage-cont-left">
                            <div class="icon-box">
                                <img class="common-img" src="/images/weChat-2x.png" alt="头像">
                            </div>
                        </div>
                        <div class="massage-cont-right">
                            <h3>昵称或是山洞官方小编<span>16:30</span></h3>
                            <p>评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="massage-cont-left">
                            <div class="icon-box">
                                <img class="common-img" src="/images/weChat-2x.png" alt="头像">
                            </div>
                        </div>
                        <div class="massage-cont-right">
                            <h3>昵称或是山洞官方小编<span>16:30</span></h3>
                            <p>评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            $.get("/getCommentMessage", {}, function (data) {
                var noteHtml = '',photo;
                if (data.status) {
                    $.each(data.data, function (k, v) {
                        if (v.photo == 0){
                            photo = "/images/portrait.png"
                        }else {
                            photo = v.photo;
                        }
                        noteHtml += '<li>';
                        noteHtml += '<div class="massage-cont-left"><div class="icon-box"><img class="common-img" src="'+ photo +'" alt="头像"></div></div>';
                        noteHtml += '<div class="massage-cont-right">';
                        noteHtml += '<a class="btn btn-reply" href="/wap/reply_comment">回复</a>';
                        noteHtml += '<h3>' + v.nickname + '<i></i><span>' + v.created_at + '</span></h3>';
                        noteHtml += '<p>' + v.content + '</p>';
                        noteHtml += '<div class="us-massage"><a href="#">';
                        noteHtml += '<div class="picture-box"><img class="common-img" src="' + v.image_one_url + '" alt="图片"></div>';
                        noteHtml += '<span>' + v.title + '</span>';
                        noteHtml += '<p class="us-text">' + v.note_content + '</p>'
                        noteHtml += '</a></div></div></li>'
                    })
                    $(".discuss ul").html(noteHtml);
                }
            });
            $.get("/getSysMessage", {}, function (data) {
                var noteHtml = '',photo;
                console.log(data)
                if (data.status) {
                    $.each(data.data, function (k, v) {
                        if (v.photo == 0){
                            photo = "/images/portrait.png"
                        }else {
                            photo = v.photo;
                        }
                        noteHtml += '<li><a href="#">';
                        noteHtml += '<div class="massage-cont-left">';
                        noteHtml += '<div class="icon-box"><img class="common-img" src="'+ v.photo +'" alt="头像"></div></div>';
                        noteHtml += '<a class="btn btn-reply" href="/wap/reply_comment">回复</a>';
                        noteHtml += '<h3>' + v.nickname + '<i></i><span>' + v.created_at + '</span></h3>';
                        noteHtml += '<p>' + v.content + '</p>';
                        noteHtml += '<div class="us-massage"><a href="#">';
                        noteHtml += '<div class="picture-box"><img class="common-img" src="' + v.image_one_url + '" alt="图片"></div>';
                        noteHtml += '<span>' + v.title + '</span>';
                        noteHtml += '<p class="us-text">' + v.note_content + '</p>'
                        noteHtml += '</a></div></div></li>'
                    });
                    $(".system ul").html(noteHtml);
                }
            });
        });
    </script>
</html>