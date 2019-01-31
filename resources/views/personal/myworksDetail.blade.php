<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
    <title>神奇的山洞</title>

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
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

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

         <div class="add-photo-box">
             <ul id="shop-img-list">
                 <li class="btn-add-photo">
                     <input type="file" id="add-photo" name="source">
                     <span>添加照片</span>
                 </li>
             </ul>
         </div>
     </div>
    <div class="zc_worksText">
        <input type="text" placeholder="需求标题" id="worksTitle"></input>
        <div class="zc_line"></div>
        {{--<div id="editor" type="text/plain" style="width:350px;height:300px;"></div>--}}
        {{--<button onclick="getContent()">获得内容</button>--}}
        <textarea placeholder="请描述你的需求" id="worksTexar"></textarea>
    </div>
    <div class="zc_workContent">

        <div class="container_time">


            <input type="text" id="birthday" placeholder="开始时间" data-options="{'type':'YYYY-MM-DD hh:mm:ss','beginYear':1800,'endYear':2800,'location':'before'}">
            <input type="text" id="birthday1" placeholder="结束时间" data-options="{'type':'YYYY-MM-DD hh:mm:ss','beginYear':1800,'endYear':2800,'location':'before'}">
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
    <div class="addhight1"></div>

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
<script src="/js/jquery.date.js"></script>
<script src="/js/uploadfile.js"></script>
<script src="/js/common.js"></script>
<script>
    $(function () {
        //上传图片
        var photo_list = $("#shop-img-list li").length;
        if (photo_list == 1){
            $("#shop-img-list").css({"justify-content":"center","width":"auto"});
            $(".btn-add-photo").css({"background-color":"transparent"});
        }
        $("#add-photo").on("change",function(){
            var img_size = $("input[type=file]").get(0).files[0].size;
            console.log(img_size);
            //alert(img_size);
            if (img_size > 1000000){
                alert("上传图片过大，请上传小于1M的图片")
            } else {
                $.ajaxFileUpload({
                    url: '/upload', //用于文件上传的服务器端请求地址0
                    secureuri: false, //是否需要安全协议，一般设置为false
                    fileElementId: 'add-photo', //文件上传域的ID
                    dataType: 'json', //返回值类型 一般设置为json
                    success: function (data){  //服务器成功响应处理函数
                        console.log(data.data.url);

                        $('#shop-img-list').append('<li><div class="del-photo-list"></div><img src="'+data.data.url+'" class="common-img"></li>');
                        $("#shop-img-list").css({"justify-content":"unset","width":"max-content"});
                        $(".btn-add-photo").css({"background-color":"#eee"});
                    },
                    error: function (data, status, e){//服务器响应失败处理函数

                    }
                });
            }
        });
        $('#shop-img-list').on("click",".del-photo-list",function () {
            $(this).parent().remove();
        });

    //时间
        $.date('#birthday');
        $.date('#birthday1');
        $("#date-wrapper h3").css("background","#333");
        $("#d-confirm").css("background","#333")
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
    })

    //跳转开始
    function toworksDetail() {
        window.location.href = "/wap/activeList";
    }
    function handlePersonal() {
        window.location.href = "/wap/personal";
    }
    //跳转结束
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
        // 获取图片
        var mli=$("#shop-img-list>li").length;
        console.log(mli);
        var arr=[];
        for(var i=1;i<mli;i++){
            var imgurl=$("#shop-img-list>li").eq(i).find("img").attr("src")
            console.log(imgurl);
            arr.push(imgurl)
        }
        var arrS=arr.join(";");
        console.log(arrS)
      //获取图片结束
        var title= $("#worksTitle").val();
        var content=$("#worksTexar").val();
        var bonus=$("#priceInp").val();
        var start=$("#date-start").val();
        var end=$("#date-end").val();
        // var content1=getContent();
        // console.log(content1)
            $.ajax({
                type: "post",
                url: "/addDemand",
                data: {
                    "demand_url":arrS,
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

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
   //  var ue = UE.getEditor('editor');
   // function getContent() {
   //      var arr = [];
   //      arr.push("使用editor.getContent()方法可以获得编辑器的内容");
   //      arr.push("内容为：");
   //      arr.push(UE.getEditor('editor').getContent());
   //      alert(arr.join("\n"));
   //      var p=arr.join("\n");
   //      console.log(p);
   //      return p;
   //  }

</script>
</html>