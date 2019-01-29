<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/styles/museumName.css"/>
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
    <link rel="stylesheet" type="text/css" href="/styles/base.css"/>
</head>

<body>
<div class="container">
    <!--头部-->
    <div class="nameHead">
        <span onclick="history.back()" class="iconfont icon-ffanhui-"></span>
        <div class="nameHeadBox">
            <div class="museumImg">
                <img src="" id="muse_logo" onerror="this.src='/images/a3.jpg'"/>
            </div>
            <div class="nameHeadRight">
                <div class="introduce">
                    <p id="name"></p>
                    <span class="iconfont icon-dengji"></span>
                </div>
                <div class="fansCourse">
                    <p>已认证</p>
                    <div class="">|</div>
                    <p>粉丝&nbsp;&nbsp;<span id="fans"></span></p>
                </div>
                <div class="followBtn" id="focus">

                </div>
            </div>
        </div>
        <!--简介-->
        <div class="simpleText" style="height: 50px;">
            <p id="info">
            </p>

        </div>
    </div>
    <input  value="{{$id}}" id="uid" type="hidden">

    <div class="nameContent">
        <div class="contentNav clearfix">
            <div class=""><p class="navboder" onclick="nameList(1)">探宝笔记</p></div>
            <div class=""><p onclick="nameList(2)">文创宝藏</p></div>
        </div>
        <div class="nameList">
            <div class="list_left">

            </div>
            <div class="list_right"></div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>
    window.onload = function () {

        $(".contentNav>div>p").click(function () {
            $(this).addClass("navboder").parent().siblings().children().removeClass("navboder")
        })

        nameList(1);
        getStoreInfo();
    }

    //添加关注
    function addFocus(uid) {
        $.post("/focus", {'uid': uid}, function (data) {
            if (data.status) {
                alert("关注成功");
                $("#focus").bind('click',function(){
                    cancelFocus(beuid);
                });
                $("#focus").html('<span>-</span><span>取关</span>')
            } else {
                alert("哎呀！出错了")
            }
        })
    }

    //取消关注
    function cancelFocus(uid) {
        $.post("/cancelFocus", {'uid': uid}, function (data) {
            if (data.status) {
                alert("取关成功");
                $("#focus").bind('click',function(){
                    addFocus(uid);
                });
                $("#focus").html('<span>+</span><span>关注</span>')

            } else {
                alert("哎呀！出错了")
            }
        })
    }

    function getStoreInfo() {
        var storeId = GetUrlParam("store_id");
        $.get("/getStoreDetail", {'id': storeId}, function (data) {
            if (data.code == 200) {
                $("#muse_logo").attr("src", data.data[0].logo_pic_url)
                $("#info").html(data.data[0].introduction)
                $("#name").html(data.data[0].name)
                getFansNum(data.data[0].uid)
                if($("#uid").val()!=0){
                    judgeFocus(data.data[0].uid);
                }else{
                    $("#focus").html('<span>+</span><span><a style="text-decoration:none;color:inherit;" href="/wap/login_index">关注</a></span>')
                }

            }
        })

    }

    function judgeFocus(beuid) {
        $.get('/judgeFocus', {'beuid':beuid}, function (data) {
            if (data.data.is_focus) {
                $("#focus").bind('click',function () {
                    cancelFocus(beuid);
                })
                $("#focus").html('<span>-</span><span>取关</span>')
            }else{
                $("#focus").bind('click',function () {
                    addFocus(beuid);
                })
                $("#focus").html('<span>+</span><span>关注</span>')
            }
        })
    }

    function getFansNum(uid) {
        $.get("/myFans", {'uid': uid}, function (data) {
            $("#fans").html(data.data.count + "万")
        })
    }

    function nameList(num) {
        var storeId = GetUrlParam("store_id");

        $.get('/getNoteByStoreId/' + storeId, {}, function (data) {
            var nameListLeft = "";
            var nameListRight = "";
            if (data.status) {
                $.each(data.data, function (i, v) {
                    if (i % 2 == 0) {
                        nameListLeft += '<div class="museum_shop_pic">'
                        nameListLeft += '<div>'
                        nameListLeft += '<a href="/wap/noteDetail/'+v.id+'"><img src="' + v.image_one_url + '" onerror="this.src=\'/images/note.jpg\'"></a>'
                        nameListLeft += '</div>'
                        nameListLeft += '<div>'
                        nameListLeft += '<h3 >' + v.title + '</h3>'
                        nameListLeft += '<h4>'
                        nameListLeft += '<a href="/wap/other_home?id='+v.uid+'"><span><img src="' + v.photo + '" onerror="this.src=\'/images/photo.png\'"/></span></a>'
                        nameListLeft += '<p>'
                        nameListLeft += '<i class="contentNum">152222</i>'
                        nameListLeft += '<em onclick="addcolor()" class="iconfont icon-dianzan"></em>'
                        nameListLeft += '</p>'
                        nameListLeft += '</h4>'
                        nameListLeft += '</div>'
                        nameListLeft += '</div>'
                    } else {
                        nameListRight += '<div class="museum_shop_pic">'
                        nameListRight += '<div>'
                        nameListRight += '<a href="/wap/noteDetail/'+v.id+'"><img src="' + v.image_one_url + '" onerror="this.src=\'/images/note.jpg\'"></a>'
                        nameListRight += '</div>'
                        nameListRight += '<div>'
                        nameListRight += '<h3 >' + v.title + '</h3>'
                        nameListRight += '<h4>'
                        nameListRight += '<a href="/wap/other_home?id='+v.uid+'"><span><img src="' + v.photo + '" onerror="this.src=\'/images/photo.png\'"/></span></a>'
                        nameListRight += '<p>'
                        nameListRight += '<i class="contentNum">' + v.likeNum + '</i>'
                        nameListRight += '<em onclick="addcolor()" class="iconfont icon-dianzan"></em>'
                        nameListRight += '</p>'
                        nameListRight += '</h4>'
                        nameListRight += '</div>'
                        nameListRight += '</div>'
                    }

                })
                $(".list_left").html(nameListLeft)
                $(".list_right").html(nameListRight)
            }

        })

    }


</script>

</html>