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
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
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
               <li class="addcolor c" ><a href="#activeRule">需求说明</a></li>
               <li class="e"><a href="#activeList">获奖作品</a></li>
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
    @foreach ($commentList as $li)
        <div class="de_activeNext">

            <div class="de_fansSay">
                <div class="de_fansOne">
                    <div class="de_fansHead">
                        <img src="{{$li['photo']}}" alt="" onclick="toOtherHome({{$li['uid']}})">
                        <p>{{$li['nickname']}}</p>

                    </div>
                    <div class="de_fansTwo">{{$li['content']}}</div>
                    <div class="de_follow">
                        <div class="de_followTime">
                            <img src="/images/time.png" alt="">
                            <p>{{$li['created_at']}}</p>
                        </div>
                        {{--<div class="de_followDz">--}}
                            {{--<img src="/images/dz-icon.png" alt="">--}}
                            {{--<p>666</p>--}}
                        {{--</div>--}}
                        <div class="de_followPl">
                            {{--<img src="/images/pl-icon.png" alt="">--}}
                            <span class="iconfont icon-pinglun"></span>
                            <p onclick="pinglun({{$li['id']}},'{{$li['nickname']}}')">回复</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @if(!empty($li['child']))
                @foreach ($li['child'] as $lii)
                    <div class="de_activeNext" >
                        <div class="de_fansSay">
                            <div class="de_fansOne">
                                <div class="de_fansHead">
                                    <img src="{{$lii['photo']}}" alt="" onclick="toOtherHome({{$li['uid']}})">
                                    <p>{{$lii['nickname']}}</p>

                                </div>
                                <div class="de_fansTwo">@<b>{{$lii['to_nickname']}}</b> {{$lii['content']}}</div>
                                <div class="de_follow">
                                    <div class="de_followTime">
                                        <img src="/images/time.png" alt="">
                                        <p>{{$lii['created_at']}}</p>
                                    </div>
                                    {{--<div class="de_followDz">--}}
                                        {{--<img src="/images/dz-icon.png" alt="">--}}
                                        {{--<p>666</p>--}}
                                    {{--</div>--}}
                                    <div class="de_followPl">
                                        <span class="iconfont icon-pinglun"></span>
                                        <p onclick="pinglun({{$lii['id']}},'{{$lii['nickname']}}')">回复</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        @endif
    @endforeach
    <div class="de_addheight"></div>


    <!--引入footer-->
    @extends('layout.footer')
</div>


</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script>
    $(function(){
        getPeopleList();
        // 滚轴时间
        $(document).scroll(function(){
            var wheight=$(window).height();
            var stop=$(document).scrollTop();
            var m=$("#activeRule").offset().top;


            var n=$("#activeGold").offset().top
            var k=$("#activeList").offset().top
          console.log(m+100+"px")
            if (stop>(m-200)) {
                $(".c").addClass("addcolor").siblings().removeClass("addcolor");
            }
            if (stop>(n-200)) {
                $(".d").addClass("addcolor").siblings().removeClass("addcolor");
            }
            if (stop>(k-200)) {
                $(".e").addClass("addcolor").siblings().removeClass("addcolor");
            }
        })
    })

    var isclick = true,activeId = "{{$active['id']}}",to_cid=0;

    function pinglun(cid,to_nickname) {
        if(cid != to_cid) {
            $("#textar").val('');
        }
        to_cid = cid;
        $("#textar").attr("placeholder","回复" + to_nickname + " : ")
        $("#textar").focus()
    }

    $("#reply-btn").click(function () {
        var content = $("#textar").val();
        if(content.length === 0) {
            alert('请输入回复内容');
            return;
        }
        if(isclick) {
            isclick = false;
            $.ajax({
                url:"/active/reply",
                type:"POST",
                dataType:"json",
                data:{note_id:activeId,to_cid:to_cid,content:content},
                success: function (res) {
                    // alert(JSON.stringify(res))
                    if(res.code == 200) {
                        alert('评论成功');
                        addPlList()
                        $("#textar").val('')
                        to_cid = 0;
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

    function toIndex() {
        window.location.href = "/wap/activeList";
    }
   // 添加评论
    function addPlList() {
        var plList="";
        var text=$("#textar").val();
        console.log(text)
        plList+='<div class="de_fansSay">'
        plList+='<div class="de_fansOne">'
        plList+='<div class="de_fansHead">'
        plList+='<img src="/images/people.jpg" alt="">'
        plList+='<p>史莱克</p>'
        plList+='</div>'
        plList+='<div class="de_fansTwo">'+text+'</div>'
        plList+='<div class="de_follow">'
        plList+='<div class="de_followTime">'
        plList+='<img src="/images/time.png" alt="">'
        plList+=' <p>2019.01.05</p>'
        plList+='</div>'
        plList+='<div class="de_followDz">'
        plList+='<img src="/images/dz-icon.png" alt="">'
        plList+='<p>666</p>'
        plList+='</div>'
        plList+='<div class="de_followPl">'
        plList+=' <span class="iconfont icon-pinglun"></span>'
        plList+='<p>回复</p>'
        plList+='</div>'
        plList+='</div>'
        plList+=' </div>'
        plList+='</div>'
       $(".de_activeNext").append(plList)
    }
    // 需求详情
    function getPeopleList() {
            $.ajax({
                type: "get",
                url: "/getDemandDetail/1",
                data: {

                },
                async: true,
                success: function(data) {
                    console.log(data)

                    // $(".activeMidden").html(middenList)
                }
            });
    }


</script>

</html>
<script src="/js/swiper/swiper.min.js"></script>
<script src="/js/swiper/swiper.js"></script>
