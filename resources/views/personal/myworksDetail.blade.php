<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
    <title>个人中心-神奇的山洞</title>

    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/personal.css">
    <link rel="stylesheet" href="/styles/style1.css?v=7" />
    <link href="/styles/mobiscroll.css" rel="stylesheet" />
    <link href="/styles/mobiscroll_date.css" rel="stylesheet" />
    <link rel="stylesheet" href="/styles/normalize3.0.2.min.css" />
</head>
<body>
    <header>
        <ul>
            <li onclick="handlePersonal()">
                <img src="/images/fanhui.png" alt="">
            </li>
            <li class="styleTitle">
                <p >发布需求</p>
            </li>
            <li>
                <span onclick="changeHead()">
                        {{--<img src="/images/serch.png" alt="">--}}
                </span>
            </li>
        </ul>
    </header>
    <div class="zc_addheight"></div>
     <div class="zc_upImg">
         <form name="form0" id="form0">
             <div class="zc_upinp">
             <input type="file" name="file0" id="file0" multiple="multiple" />
             </div>
             <img src="/images/jia.png" id="img0" style="width: 200px;height: 150px;">
         </form>
     </div>
    <div class="zc_worksText">
        <input type="text" placeholder="需求标题"></input>
        <div class="zc_line"></div>
        <textarea  placeholder="请描述你的需求"></textarea>
    </div>
    <div class="zc_workContent">
        <div class="zc_contentList">
            <p class="zc_worksStart">开始时间</p>
            <section id="form">
                <form action="">
                    <input type="text" name="startStime" id="USER_AGE" readonly class="input" placeholder="开始时间" />

                    <!--<input type="submit" id="tj" class="submit" value="提交" />-->
                </form>
            </section>
        </div>

        <div class="zc_contentList">
            <p class="zc_worksStart">结束时间</p>
            <section id="form">
                <form action="">
                    <input type="text" name="startStime" id="USER_AOE"  readonly class="input" placeholder="开始时间" />

                    <!--<input type="submit" id="tj" class="submit" value="提交" />-->
                </form>
            </section>
        </div>

        <div class="zc_contentList">
            <p class="zc_worksStart">奖金</p>
            <span onclick="zc_wind()"><img src="/images/right.png" alt=""></span>

        </div>
        <div class="zc_windDet">
            <div class="zc_windDetail">
                <div class="zc_windOne">
                    <p>请输入奖金</p>
                    <input type="text">
                </div>
                <div class="zc_windTwo">
                    <div onclick="getPrice()">确定</div>

                    <div onclick="colseWin()">取消</div>
                </div>
            </div>

        </div>
    </div>

<!--引入footer-->
@extends('layout.footer')
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/mobiscroll_date.js" charset="gb2312"></script>
<script src="/js/mobiscroll.js"></script>

<script>
    $(function () {
        // 上传图片
        $("#file0").change(function(){
            var objUrl = getObjectURL(this.files[0]) ;//获取文件信息
            console.log("objUrl = "+objUrl);
            if (objUrl) {
                $("#img0").attr("src", objUrl);
            }
        }) ;

          // 选择日期
            var currYear = (new Date()).getFullYear();
            var opt={};
            opt.date = {preset : 'date'};
            opt.datetime = {preset : 'datetime'};
            opt.time = {preset : 'time'};
            opt.default = {
                theme: 'android-ics light', //皮肤样式
                display: 'modal', //显示方式
                mode: 'scroller', //日期选择模式
                dateFormat: 'yyyy-mm-dd',
                lang: 'zh',
                showNow: true,
                nowText: "今天",
                startYear: currYear - 50, //开始年份
                endYear: currYear + 10 //结束年份
            };

            $("#USER_AGE").mobiscroll($.extend(opt['date'], opt['default']));
        $("#USER_AOE").mobiscroll($.extend(opt['date'], opt['default']));
    })

    function getObjectURL(file) {
        console.log(666)
        var url = null;
        if (window.createObjectURL!=undefined) {
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }


    function toworksDetail() {
        window.location.href = "/wap/activeList";
    }
    function handlePersonal() {
        window.location.href = "/wap/personal";
    }

    function  zc_wind() {
        $(".zc_windDet").show()
    }
</script>
</html>