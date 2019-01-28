<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
    <title>编辑探宝笔记-神奇的山洞</title>

    <link rel="stylesheet" href="/styles/common.css">
    <link rel="stylesheet" href="/styles/personal.css">
</head>
<body>
<div class="header">
    <div class="header-left qx-write"><a href="/wap/my_note">取消</a></div>
    <h3>发布探宝笔记</h3>
</div>
<div class="content-box">
    <div class="note-ipt-box">
        <form action="">
            <div class="note-ipt-title"><input type="text" placeholder="输入你的标题" value="" id="title"></div>
            <div class="note-cont"><textarea placeholder="输入你的笔记内容" rows="11" id="content"></textarea></div>

        </form>
        <div class="add-photo-box write-note-photo">
            <ul id="shop-img-list">
                <li class="btn-add-photo">
                    <input type="file" id="add-photo" name="source">
                    <span>添加照片</span>
                </li>
                {{--<li>--}}
                {{--<img src="/images/2.jpg" class="common-img">--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
    <div class="btn-release">
        <a href="#" onclick="addNote()">发布</a>
    </div>
</div>

<!--引入footer-->
@extends('layout.footer')
</body>
<script src="/js/jquery-3.0.0.min.js"></script>
<script src="/layer/layer.js"></script>
<script src="/js/common.js"></script>
<script src="/js/uploadfile.js"></script>

<script>
    $(function () {
        // var photo_list = $("#shop-img-list li").length;
        // if (photo_list == 1) {
        //     $("#shop-img-list").css({"justify-content": "center", "width": "auto"});
        //     $(".btn-add-photo").css({"background-color": "transparent"});
        // }
        $("#add-photo").on("change", function () {
            var img_size = $("input[type=file]").get(0).files[0].size;
            //console.log(img_size);
            //alert(img_size);
            if (img_size > 1000000){
                layer.tips("上传图片过大，请上传小于1M的图片", '.write-note-photo', {
                    tips: 3
                });
            }else {
                $.ajaxFileUpload({
                    url: '/upload', //用于文件上传的服务器端请求地址
                    secureuri: false, //是否需要安全协议，一般设置为false
                    fileElementId: 'add-photo', //文件上传域的ID
                    dataType: 'json', //返回值类型 一般设置为json
                    success: function (data) {  //服务器成功响应处理函数
                        $('#shop-img-list').append('<li><div class="del-photo-list"></div><img src="' + data.data.url + '" class="common-img"></li>');
                        $("#shop-img-list").css({"justify-content": "unset", "width": "max-content"});
                        $(".btn-add-photo").css({"background-color": "#eee"});
                    },
                    error: function (data, status, e) {//服务器响应失败处理函数

                    }
                });
            }
        });
        $('#shop-img-list').on("click", ".del-photo-list", function () {
            $(this).parent().remove();
        });
    })


    function addNote() {
        var title = $("#title").val();
        var content = $("#content").val();
        var img_list = $("#shop-img-list").find("img");
        img_one = $(img_list[0]).attr("src");
        img_two = $(img_list[1]).attr("src");
        img_three = $(img_list[2]).attr("src");
        $.post("/addNote", {
            'title': title,
            'content': content,
            'image_one_url': img_one,
            'image_two_url': img_two,
            'image_three_url': img_three,
            'goods_id': 0
        }, function (data) {
            if (data.code==200) {
                alert("发布成功")
                window.location.href="/wap/index"
            }else{
                alert(data.message)
            }
        })
    }
</script>
</html>