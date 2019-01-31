<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
    <title>商品上架-神奇的山洞</title>

    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/personal.css">
</head>
<style>
    .myborder{
        border:1px solid #878787;
    }
    .nextBtn{
        width: 100%;
        height: auto;
        margin-top: 10px;
    }
    .nextBtn>button{
        width: 60px;
        height: 25px;
        border-radius: 10px;
        background: #eb2f57;
        margin: 0 auto;
        font-size: 14px;
        color: #fff;
        line-height: 25px;
        text-align: center;
        outline: none;
        display: block;
        border: none;
    }
</style>
<body>
<div class="header">
    <div class="header-left" id="upper-return" onclick="history.back()" ></div>
    <h3 class="top-title" id="upper-title">上传作品</h3>
</div>
<div class="content-box upper-content">
    <div class="add-photo-box">
        <ul id="shop-img-list">
            <li class="btn-add-photo">
                <input type="file" id="add-photo" name="source">
                <span>添加照片</span>
            </li>
        </ul>
    </div>
    <div class="ipt-box">
        <div class="ipt-shop-brief myborder">
            <textarea id="shop-brief" placeholder="请描述一下您的作品" rows="4"></textarea>
        </div>
    </div>
  <div class="nextBtn">
  <button class="button" onclick="publishImg()">提交</button>
  </div>
</div>
<!--引入footer-->
@extends('layout.footer')
</body>
{{--<script src="/js/jquery-3.0.0.min.js"></script>--}}
<script src="/js/jquery-1.11.0.js"></script>
<script src="/layer/layer.js"></script>
<script src="/js/uploadfile.js"></script>
<script src="/js/common.js"></script>
<script src="/js/proving.js"></script>
<script>


 $(function () {
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

 })

     function publishImg() {
  var id=GetUrlParam('demoId')
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

     var text= $("#shop-brief").val()
         $.ajax({
             type: "post",
             url:"/addCreation",
             data: {
               "introduction" : text,
                 "creation_urls":arrS,
                 "demand_id":id

             },
             async: true,
             success: function(data) {
                 console.log(data)
                alert("提交成功")
             },
             error: function(data) {

             }
         });
     }

</script>
</html>