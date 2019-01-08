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
                                <h3>中国瓷器名满天下！！！<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="recommend-banner-box">
                            <img class="common-img" src="/images/test1.jpg" alt="banner图">
                            <div class="re-title">
                                <h3>凝眸的眼神，望穿苍穹！！！！<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="recommend-banner-box">
                            <img class="common-img" src="/images/test2.jpg" alt="banner图">
                            <div class="re-title">
                                <h3>巧夺天工！！！<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="recommend-banner-box">
                            <img class="common-img" src="/images/test3.jpg" alt="banner图">
                            <div class="re-title">
                                <h3>静静的享受艺术的熏陶！！<span></span></h3>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <!--系统消息-->
        <div class="massage-cont system">
            <ul>
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
                if (data.status) {
                    $.each(data.data.data, function (k, v) {
                        if (v.photo == 0){
                            photo = "/images/portrait.png"
                        }else {
                            photo = v.photo;
                        }
                        noteHtml += '<li onclick="read_sys_message(' + v.id+ ')"><a href="#">';
                        noteHtml += '<div class="massage-cont-left">';
                        noteHtml += '<div class="icon-box"><img class="common-img" src="'+ photo +'" alt="头像"></div></div>';
                        noteHtml += '<div class="massage-cont-right">';
                        noteHtml += '<h3 class="sys-title">';

                                    if(v.is_read == 0){
                                        noteHtml += v.title+'<sup></sup><span>'+ formatTime(v.created_at);
                                    }else{
                                        noteHtml += v.title+'<span>'+ formatTime(v.created_at);
                                    }
                        noteHtml +='</span></h3>';

                        noteHtml += '<p>' + v.content + '</p>';
                        noteHtml += '</div></a></li>';
                    });
                    $(".system ul").html(noteHtml);
                    if (data.data.is_read_count != 0){
                        $(".massage-category").find("li").eq(0).html('系统消息<sup>' + data.data.is_read_count + '</sup>');
                    }
                }
            });
        });
        function formatTime(time){
            var datetime = new Date(time);
            var year = datetime.getFullYear();
            var month = datetime.getMonth() + 1 < 10 ? "0" + (datetime.getMonth() + 1) : datetime.getMonth() + 1;
            var date = datetime.getDate() < 10 ? "0" + datetime.getDate() : datetime.getDate();
            var hour = datetime.getHours()< 10 ? "0" + datetime.getHours() : datetime.getHours();
            var minute = datetime.getMinutes()< 10 ? "0" + datetime.getMinutes() : datetime.getMinutes();
            var second = datetime.getSeconds()< 10 ? "0" + datetime.getSeconds() : datetime.getSeconds();
            return hour+":"+minute;
        }
        function read_sys_message(id) {
            $.get("/readSysMessage", {id:id}, function (data) {
            });
        }
    </script>
</html>