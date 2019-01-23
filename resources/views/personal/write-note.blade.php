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
            <div class="note-ipt-title"><input type="text" placeholder="输入你的标题"></div>
            <div class="note-cont"><textarea placeholder="输入你的笔记内容" rows="11"></textarea></div>
            <ul>
                <li>
                    <div class="btn-phone"><span>添加照片</span></div>
                </li>
            </ul>
            <img src="">
        </form>
    </div>
    <div class="btn-release">
        <a href="#">发布</a>
    </div>
</div>

<!--引入footer-->
@extends('layout.footer')
</body>
<script src="/js/jquery-3.0.0.min.js"></script>
<script src="/js/common.js"></script>

<script>
    $("#source").on("change",function(){
        $.ajaxFileUpload({
            url: '/upload', //用于文件上传的服务器端请求地址
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: 'source', //文件上传域的ID
            dataType: 'json', //返回值类型 一般设置为json
            success: function (data){  //服务器成功响应处理函数
                $('#btn-my-header').attr('src',data.data.url);
            },
            error: function (data, status, e){//服务器响应失败处理函数

            }
        });
    });

    function addNote() {

    }
</script>
</html>