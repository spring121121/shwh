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
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/styles/material.min.css" />
    <link rel="stylesheet" href="/styles/bootstrap-material-datetimepicker.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/styles/default.css">

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
        <input type="text" placeholder="需求标题" id="worksTitle"></input>
        <div class="zc_line"></div>
        <textarea  placeholder="请描述你的需求" id="worksTexar"></textarea>
    </div>
    <div class="zc_workContent">
        {{--<div class="zc_contentList">--}}
            {{--<p class="zc_worksStart">开始时间</p>--}}
            {{--<section id="form">--}}
                {{--<form action="">--}}
                    {{--<input type="text" name="startStime" id="USER_AGE" readonly class="input" placeholder="开始时间" />--}}

                    {{--<!--<input type="submit" id="tj" class="submit" value="提交" />-->--}}
                {{--</form>--}}
            {{--</section>--}}
        {{--</div>--}}

        {{--<div class="zc_contentList">--}}
            {{--<p class="zc_worksStart">结束时间</p>--}}
            {{--<section id="form">--}}
                {{--<form action="">--}}
                    {{--<input type="text" name="startStime" id="USER_AOE"  readonly class="input" placeholder="开始时间" />--}}

                    {{--<!--<input type="submit" id="tj" class="submit" value="提交" />-->--}}
                {{--</form>--}}
            {{--</section>--}}
        {{--</div>--}}
        <div class="container well">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-control-wrapper">
                                <input type="text" id="date-start" class="form-control floating-label" placeholder="开始时间">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-control-wrapper">
                                <input type="text" id="date-end" class="form-control floating-label" placeholder="结束时间">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="zc_contentList">
            <p class="zc_worksStart">奖金</p>
            <span onclick="zc_wind()" id="getmoney"><img src="/images/right.png" alt=""></span>

        </div>
        <div class="zc_windDet">
            <div class="zc_windDetail">
                <div class="zc_windOne">
                    <p>请输入奖金</p>
                    <input type="text" id="priceInp">
                </div>
                <div class="zc_windTwo">
                    <div onclick="getPrice()">确定</div>

                    <div onclick="colseWin()">取消</div>
                </div>
            </div>

        </div>

        <div class="zc_actionBtn" onclick="postWorks()">提交</div>
    </div>

<!--引入footer-->
@extends('layout.footer')
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/mobiscroll_date.js" charset="gb2312"></script>
<script src="/js/mobiscroll.js"></script>

<script src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/material.min.js"></script>
<script type="text/javascript" src="/js/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-material-datetimepicker.js"></script>

<script>
    $(function () {

        $('#date').bootstrapMaterialDatePicker
        ({
            time: false
        });

        $('#time').bootstrapMaterialDatePicker
        ({
            date: false,
            shortTime: true,
            format: 'HH:mm'
        });

        $('#date-format').bootstrapMaterialDatePicker
        ({
            format: 'dddd DD MMMM YYYY - HH:mm'
        });
        $('#date-fr').bootstrapMaterialDatePicker
        ({
            format: 'DD/MM/YYYY HH:mm',
            lang: 'fr',
            weekStart: 1,
            cancelText : 'ANNULER'
        });

        $('#date-end').bootstrapMaterialDatePicker
        ({
            weekStart: 0, format: 'DD/MM/YYYY HH:mm'
        });
        $('#date-start').bootstrapMaterialDatePicker
        ({
            weekStart: 0, format: 'DD/MM/YYYY HH:mm'
        }).on('change', function(e, date)
        {
            $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
        });

        $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });

        $.material.init()

        //上传图片
        $("#file0").change(function(){
            var objUrl = getObjectURL(this.files[0]) ;//获取文件信息
            console.log("objUrl = "+objUrl);

            // 放在全局
            window.url = objUrl;
            if (objUrl) {
                $("#img0").attr("src", objUrl);
            }
        }) ;

          // 选择日期

    })
    //获取地址
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
   function getPrice(){
      var prive=$("#priceInp").val();
      $("#getmoney").html(prive+"元");
       $(".zc_windDet").hide();
   }
   function colseWin(){
       $(".zc_windDet").hide()
   }


   // 发布需求
    function postWorks() {
        console.log(url)
        var title= $("#worksTitle").val();
        var content=$("#worksTexar").val();
        var bonus=$("#priceInp").val();
        var start=$("#date-start").val();
        var end=$("#date-end").val();
            $.ajax({
                type: "post",
                url: "/addDemand",
                data: {
                    "demand_url":url,
                    "title":title,
                    "content":content,
                    "bonus":bonus,
                    "start_time":"2019-01-20 13:50:00",
                    "end_time":"2019-01-21 13:50:00"
                },
                async: true,
                success: function(data) {
                    console.log(data)
                    if(data.message==="成功"){
                        alert("发布成功")
                    }
                }
            });
    }
</script>
</html>