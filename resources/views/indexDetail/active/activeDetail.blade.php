<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞文化</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/active.css">
    <link rel="stylesheet" href="/styles/base.css">
</head>
<body>
<div class="container">
    <header>
        <div class="activeTitle">
            <div class="goIndex" onclick="history.back()"><img src="/images/fanhui.png" alt=""></div>
            {{--{{$active['demand_url']}}--}}
            <p class="btn1">{{$active['title']}}</p>
            <span></span>
        </div>
    </header>
    <div class="de_navActive">
        <ul>
            <li class="addcolor c"><a class="common-a" href="#activeRule">需求说明</a></li>
            <li style="font-size: 12px;" id="creation"></li>
            <li class="e"><a href="#activeList">获奖作品</a></li>
            <input type="hidden" id="decomand_uid" value="{{$active['uid']}}">
            <input type="hidden" id="decomand_id" value="{{$active['id']}}">

        </ul>
    </div>
    <div class="addtTopheight"></div>
    <div class="de_activeRule" id="activeRule">
        <p class="de_ruleOne">需求说明</p>
        <p class="de_ruleTwo">
            {{$active['content']}}
        </p>
    </div>

    <div class="de_activeList" id="activeList">
        <p class="de_ruleOne">获奖作品</p>
        <ul class="de_ListGode clearfix">
            <li>
                <img src="/images/collection-img3.jpg" alt="">
                <p class="de_workName">杯子蛋糕</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>
            <li>
                <img src="/images/collection-img3.jpg" alt="">
                <p class="de_workName">杯子蛋糕</p>
                <p class="de_workPeople">作者:<span>大伟</span></p>
            </li>


        </ul>
    </div>
    <div class="de_liuyan">
        <p class="de_activeTell">留言区</p>
        <div class="de_activePublish">
            <textarea id="textar" placeholder="输入评论内容"></textarea>
            <div class="de_tellBtn" id="reply-btn">发布</div>
        </div>
    </div>
    <div class="de_activeNext comment0">
        @foreach ($commentList as $li)
            <div class="de_fansSay">
                <div class="de_fansOne">
                    <div class="de_fansHead">
                        <img src="{{$li['photo']}}" alt="">
                        <p>{{$li['nickname']}}</p>
                    </div>
                    <div class="de_fansTwo">{{$li['content']}}</div>
                    <div class="de_follow">
                        <div class="de_followTime">
                            <img src="/images/time.png" alt="">
                            <p>{{$li['created_at']}}</p>
                        </div>
                        <div class="de_followPl">
                            <img src="/images/pl-icon.png" alt="">
                            <p onclick="pinglun({{$li['id']}},'{{$li['nickname']}}')">回复</p>
                        </div>
                    </div>
                </div>
            </div>
            {{--子集评论--}}
            <div class="de_activeNext comment{{$li['id']}}" style="margin-left: 30px">
                @foreach ($li['child'] as $lii)
                    <div class="de_fansSay">
                        <div class="de_fansOne">
                            <div class="de_fansHead">
                                <img src="{{$lii['photo']}}" alt="">
                                <p>{{$lii['nickname']}}</p>

                            </div>
                            <div class="de_fansTwo">@<b>{{$lii['to_nickname']}}</b> {{$lii['content']}}</div>
                            <div class="de_follow">
                                <div class="de_followTime">
                                    <img src="/images/time.png" alt="">
                                    <p>{{$lii['created_at']}}</p>
                                </div>
                                <div class="de_followPl">
                                    <img src="/images/pl-icon.png" alt="">
                                    <p onclick="pinglun({{$lii['id']}},'{{$lii['nickname']}}')">回复</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>


        <div class="gopuilsh" onclick="gopulish({{$active['id']}})">
            <img src="/images/baoming.png" alt="">
            <p>参加活动</p>
        </div>
        <div class="de_addheight"></div>
    <!--引入footer-->
    @extends('layout.footer')
</div>


</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>
    $(function () {
        getPeopleList();

        // 滚轴时间
        // $(document).scroll(function(){
        //     var wheight=$(window).height();
        //     var stop=$(document).scrollTop();
        //     var m=$("#activeRule").offset().top;
        //
        //
        //     var n=$("#activeGold").offset().top
        //     var k=$("#activeList").offset().top
        //   console.log(m+100+"px")
        //     if (stop>(m-200)) {
        //         $(".c").addClass("addcolor").siblings().removeClass("addcolor");
        //     }
        //     if (stop>(n-200)) {
        //         $(".d").addClass("addcolor").siblings().removeClass("addcolor");
        //     }
        //     if (stop>(k-200)) {
        //         $(".e").addClass("addcolor").siblings().removeClass("addcolor");
        //     }
        // })

        var login_uid = getCookie("uid");
        var decomand_uid = $("#decomand_uid").val()
        var decomand_id = $("#decomand_id").val()
        if (login_uid == decomand_uid) {
            $("#creation").html("<a href='/wap/design?demand_id="+decomand_id+"'>参与作品</a>")
        }

    })
    var isclick = true, activeId = "{{$active['id']}}", to_cid = 0;


    $("#reply-btn").click(function () {

        var content = $("#textar").val();
        if (content.length === 0) {
            alert('请输入回复内容');
            return;
        }
        if (isclick) {
            isclick = false;
            $.ajax({
                url: "/active/reply",
                // url:"http://f.jianghairui.com/index/test/test",
                type: "POST", dataType: "json",
                data: {note_id: activeId, to_cid: to_cid, content: content},
                success: function (res) {
                    // alert(JSON.stringify(res));
                    if (res.code == 200) {
                        // alert('评论成功');
                        $("#textar").val('');
                        to_cid = 0;
                        $("#textar").attr('placeholder', '');
                        addPlList(res.data);
                    } else if (res.code == 50009) {
                        alert(res.message);
                        window.location.href = "/wx/auth";
                    } else {
                        alert(res.message);
                    }
                    isclick = true;
                },
                error: function (res) {
                    alert('服务器异常');
                    isclick = true;
                }
            })
        }

    })
    // 去首页
    function toIndex() {
        window.location.href = "/wap/activeList";
    }
   //去发布
   function gopulish(demoId) {
       window.location.href = "/wap/upDesign?demoId="+demoId;
   }

    function pinglun(cid, to_nickname) {
        // alert(cid);
        if (cid != to_cid) {
            $("#textar").val('');
        }
        to_cid = cid;
        $("#textar").attr("placeholder", "回复" + to_nickname + " : ")
        $("#textar").focus()
    }

    // 添加评论
    function addPlList(data) {
        var plList = "";
        plList += '<div class="de_fansSay">';
        plList += '<div class="de_fansOne">';
        plList += '<div class="de_fansHead">';
        plList += '<img src="' + data.photo + '" alt="">';
        plList += '<p>' + data.nickname + '</p>';
        plList += '</div>';
        if (data.to_nickname !== '') {
            plList += '<div class="de_fansTwo">@<b>' + data.to_nickname + '</b> ' + data.content + '</div>';
        } else {
            plList += '<div class="de_fansTwo"> ' + data.content + '</div>';
        }
        plList += '<div class="de_follow">';
        plList += '<div class="de_followTime">';
        plList += '<img src="/images/time.png" alt="">';
        plList += ' <p>' + data.created_at + '</p>';
        plList += '</div>';
        plList += '<div class="de_followPl">';
        plList += ' <img src="/images/pl-icon.png" alt="">';
        plList += '<p onclick="pinglun(' + data.id + ',\'' + data.nickname + '\')">回复</p>';
        plList += '</div></div></div></div>';
        if (data.root_cid == 0) {
            plList += '<div class="de_activeNext comment' + data.id + '" style="margin-left: 30px">';
        }
        $(".comment" + data.root_cid).append(plList)

    }

    // 需求详情
    function getPeopleList() {
        $.ajax({
            type: "get",
            url: "/getDemandDetail/1",
            data: {},
            async: true,
            success: function (data) {
                console.log(data)

                // $(".activeMidden").html(middenList)
            }
        });
    }


</script>

</html>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
