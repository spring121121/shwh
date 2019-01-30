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
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
    <link rel="stylesheet" href="/styles/base.css">
    <style>
        .pl-content ul li .pl-cont h3 .dianzan{
            position: absolute;
            right: 30px;
            top: 0;
            width: 20px;
            height: 20px;
            /*background: url("/images/dz-icon.png");*/
            background-size: 100%;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            z-index: 11;
        }

        .pl-content ul li .pl-cont h3 .pinglun{
            position: absolute;
            right: 0px;
            top: 0;
            width: 20px;
            height: 20px;
            /*background: url("/images/pl-icon.png");*/
            background-size: 100%;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            z-index: 11;
        }

        .btn-list-icon #pinglun{
            /*background-image: url("/images/pl-icon.png");*/
            width: 20px;
            height: 20px;
        }
        .btn-list-icon #shoucang{
            /*background-image: url("/images/zf-icon.png");*/
            width: 20px;
            height: 20px;
        }
        .btn-list-icon #dianzan{
            /*background-image: url("/images/dz-icon.png");*/
            width: 20px;
            height: 20px;
        }

    </style>
</head>
<body>
<div class="header">
    <div class="header-left"><a onclick="history.back()"></a></div>
    <div class="header-right btn-title-text btn-zf"></div>
    <h3 class="top-title" style="color:#fff">笔记详情页</h3>
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
        <div class="head-img" onclick=" toOtherHome({{$noteDetail['uid']}})"><img style="border-radius: 50%" class="common-img" src="{{$noteDetail['photo']}}"
                                                                                  onerror="this.src='/images/portrait.png'"/></div>
        <h4>{{$noteDetail['nickname']}}
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
    <ul class="btn-list-icon guHeight clearfix">
        <li id="pinglun" onclick="pinglun(0,'')">
            <span class="iconfont icon-pinglun"></span>
        </li>
        <li id="shoucang" onclick="addForward({{$noteDetail['uid']}},{{$noteDetail['id']}})">
            <span class="iconfont icon-shoucang"></span>
        </li>
        <li><em  id="dianzan-{{$noteDetail['id']}}" class="iconfont icon-dianzan" onclick="addLikes({{$noteDetail['id']}})"></em></li>
    </ul>
    <div class="more-pl-title" style="width: 100%;">
        <div class="note-cont" style="width:100%">
            <textarea placeholder="输入评论内容" rows="3" id="content" style="width: 90%;resize: none"></textarea>
            <button id="reply-btn" style="width: 20%" class="huif">回复</span>
            </button>
        </div>
    </div>
    <div class="more-pl-title" style="margin-top: 30px">
        <span></span>
        <a class="btn-more-pl" href="#">查看更多评论<i></i></a>
    </div>
    <div class="pl-content">
        <ul>
            @foreach ($commentList as $li)
                <li>
                    <div class="pl-icon-box">
                        <img class="common-img" src="{{$li['photo']}}" alt="头像">
                    </div>
                    <div class="pl-cont">

                        <h3>{{$li['nickname']}}<i></i><span>{{$li['created_at']}}</span>
                            {{--<div class="dianzan"></div>--}}
                            <div class="pinglun" onclick="pinglun({{$li['id']}},'{{$li['nickname']}}')">
                                <span class="iconfont icon-pinglun"></span>
                            </div>
                        </h3>
                        <p>{{$li['content']}}</p>
                    </div>
                </li>
                @if(!empty($li['child']))
                    <li>
                        <ul style="margin-left: 30px">
                            @foreach ($li['child'] as $lii)
                                <li>
                                    <div class="pl-icon-box">
                                        <img class="common-img" src="{{$lii['photo']}}" alt="头像">
                                    </div>
                                    <div class="pl-cont">
                                        <h3>{{$lii['nickname']}}<i></i><span>@<b>{{$lii['to_nickname']}}</b></span>
                                            {{--<div class="dianzan"></div>--}}
                                            <div class="pinglun" onclick="pinglun({{$lii['id']}},'{{$lii['nickname']}}')">
                                                <span class="iconfont icon-pinglun"></span>
                                            </div>
                                        </h3>
                                        <p>{{$lii['content']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
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
        var isclick = true,noteId = "{{$noteDetail['id']}}",to_cid=0;
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

        function pinglun(cid,to_nickname) {
            if(cid != to_cid) {
                $("#content").val('');
            }
            to_cid = cid;
            $("#content").attr("placeholder","回复" + to_nickname + " : ")
            $("#content").focus()
        }

        $("#reply-btn").click(function () {
            var content = $("#content").val();
            if(content.length === 0) {
                alert('请输入回复内容');
                return;
            }
            if(isclick) {
                isclick = false;
                $.ajax({
                    url:"/note/reply",
                    type:"POST",
                    dataType:"json",
                    data:{note_id:noteId,to_cid:to_cid,content:content},
                    success: function (res) {
                        // alert(JSON.stringify(res))
                        if(res.code == 200) {
                            alert('评论成功')
                            $("#content").val('')
                        }else if(res.code == 50009){
                            alert(res.message)
                            window.location.href = "/wx/auth";
                        }else {
                            alert(res.message)
                        }
                        isclick = true;
                    },
                    error:  function (res) {
                        alert('服务器异常')
                        isclick = true;
                    }
                })
            }

        })

     function toOther() {
         window.location.href = "/wap/other_home";
     }

</script>
</html>