<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
    <title>推荐消息-神奇的山洞</title>

    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/personal.css">
</head>
<body>
<div class="header">
    <div class="header-left"><a onclick="history.back()"></a></div>
    <div class="header-right btn-title-text btn-zf"></div>
    <h3 class="top-title">笔记详情页</h3>
</div>
<div class="content-box">
    <div class="swiper-tuijian-box">
        <div class="swiper-tuijian-banner swiper-container" style="height: 250px">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image: url('{{$noteDetail['image_one_url']}}');background-position: center;background-size: 100%"></div>
                <div class="swiper-slide" style="background-image: url('{{$noteDetail['image_two_url']}}');background-position: center;background-size: 100%"></div>
                <div class="swiper-slide" style="background-image: url('{{$noteDetail['image_three_url']}}');background-position: center;background-size: 100%"></div>
            </div>
        </div>
    </div>
    <div class="tuijian-cont-box">
        <div class="head-img"><img style="border-radius: 50%" class="common-img" src="{{$noteDetail['photo']}}"
                                   onerror="this.src='/images/portrait.png'"/></div>
        <h4>{{$noteDetail['nickname']}}<i></i>
            <span id="focus">
                @if($noteDetail['is_foucus'])
                    <div class="btn-gz" onclick="cancelFocus({{$noteDetail['uid']}})">取关</div>
                @else
                    <div class="btn-gz" onclick="addFocus({{$noteDetail['uid']}})">关注</div>
                @endif
            </span>
        </h4>
        <p style="font-weight: bold">{{$noteDetail['title']}}</p>
        <p>{{$noteDetail['content']}}</p>
    </div>
    <ul class="btn-list-icon">
        <li id="pinglun"><a class="pl-text" href="#"></a></li>
        <li id="shoucang" onclick="addForward({{$noteDetail['uid']}},{{$noteDetail['id']}})"></li>
        <li id="dianzan"></li>
    </ul>
    <div class="more-pl-title">
        <span>七嘴八舌的探宝者</span>
        <a class="btn-more-pl" href="#">查看更多评论<i></i></a>
    </div>
    <div class="pl-content">
        <ul>
            <li>
                <a href="#">
                    <div class="pl-icon-box">
                        <img class="common-img" src="/images/weChat-2x.png" alt="头像">
                    </div>
                    <div class="pl-cont">
                        <h3>昵称或是山洞官方小编<i></i><span>发布的时间</span>
                            <div class="dianzan"></div>
                        </h3>
                        <p>评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现评论消息的内容呈现</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="share-box">
    <span>分享至</span>
    <ul>
        <li>
            <div class="icon-box"><img src="/images/weChat-2x.png" class="common-img"></div>
            <span>主页</span>
        </li>
        <li>
            <div class="icon-box"><img src="/images/weChat-2x.png" class="common-img"></div>
            <span>微信好友</span>
        </li>
        <li>
            <div class="icon-box"><img src="/images/weChat-2x.png" class="common-img"></div>
            <span>朋友圈</span>
        </li>
        <li>
            <div class="icon-box"><img src="/images/weChat-2x.png" class="common-img"></div>
            <span>微博</span>
        </li>
        <div class="clear"></div>
    </ul>
    <button>取消</button>
</div>

<!--引入footer-->
@extends('layout.footer')
</body>
<script src="/js/jquery-3.0.0.min.js"></script>
<script src="/js/swiper.min.js"></script>
<script src="/js/myswiper.js"></script>
<script src="/js/common.js"></script>
<script>
        var isclick = true;
        //添加关注
        function addFocus(uid) {
            if(isclick) {
                isclick = false;
                $.post("/focus",{'uid':uid},function(data){
                    if (data.status){
                        $("#focus").html('<div class="btn-gz" onclick="cancelFocus('+uid+')">取关</div>');
                        isclick = true;
                    }else {
                        alert("哎呀！出错了")
                        isclick = true;
                    }
                })
            }

        }

        //取消关注
        function cancelFocus(uid) {
            if(isclick) {
                isclick = false;
                $.post("/cancelFocus", {'uid': uid}, function (data) {
                    if (data.status) {
                        $("#focus").html('<div class="btn-gz" onclick="addFocus(' + uid + ')">关注</div>');
                        isclick = true;
                    } else {
                        alert("哎呀！出错了")
                        isclick = true;
                    }
                })
            }
        }
        //转发笔记
        function addForward(uid,note_id) {
            if(isclick) {
                isclick = false;
                $.post("/forwardNote",{'beuid':uid,'note_id':note_id},function(data){
                    if (data.status){
                        alert("转发成功");
                        isclick = true;
                    }else {
                        alert("哎呀！出错了")
                        isclick = true;
                    }
                })
            }

        }

</script>
</html>