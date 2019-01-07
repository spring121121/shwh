<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>关注-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <ul class="follow-title flex-box"><li>关注的人</li><li>我的粉丝</li></ul>
        </div>
        <div class="content-box">
            <!--关注的人-->
            <div class="my-concern gz-common">
                <ul class="tjgz-box">
                    <li class="first-title">
                        <button>换一批</button>
                        <span>推荐关注</span>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                </ul>
                <ul class="tjgz-box">
                    <li class="first-title">
                        <span>我的关注</span>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                </ul>
            </div>
            <!--我的粉丝-->
            <div class="my-fans gz-common">
                <ul class="tjgz-box fans-box" id="my-three-fans">
                    <li class="first-title">
                        <span>近三天粉丝</span>
                    </li>
                </ul>
                <ul class="tjgz-box fans-box">
                    <li class="first-title">
                        <span>我的粉丝</span>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                    <li>
                        <div class="gz-img-box"><img src="/images/portrait.png" class="common-img"></div>
                        <div class="gz-right">
                            <button><i></i>关注</button>
                            <h3>昵称</h3>
                            <span>个人等级</span>
                            <p>有多少人关注了她</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            myFansList();
        });
        function myFansList() {
            $.get("/myFansList", {}, function (data) {
                var noteHtml = '';
                if (data.status) {
                    $.each(data.data, function (k, v) {
                        var fans_count = getFansCount(v.id);
                        if (v.photo == 0){
                            photo = "/images/portrait.png"
                        }else {
                            photo = v.photo;
                        }
                        noteHtml += '<li>';
                        noteHtml += '<div class="gz-img-box"><img src="'+ photo +'" class="common-img"></div>';
                        noteHtml += '<div class="gz-right">';
                        noteHtml += '<button><i></i>关注</button>';
                        noteHtml += '<h3>' + v.nickname + '</h3>';
                        noteHtml += '<span>'+v.grade_name+'</span>';
                        noteHtml += '<p>有'+fans_count+'人关注了她</p>';
                        noteHtml += '</div></li>';
                    });
                    $("#my-three-fans").append(noteHtml);
                }
            });
        }

        function getFansCount(id){
            var fans_count = 0;
            $.ajax({
                url: '/myFans',
                async: false,//同步方式发送请求，true为异步发送
                type: "GET",
                data: {uid:id},
                success: function (data) {
                    fans_count = data.data.count;
                }
            });
            return fans_count;
        }
    </script>
</html>