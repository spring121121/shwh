<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>收藏夹-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <h3 class="top-title">收藏</h3>
        </div>
        <div class="content-box">
            <div class="flex-box">
                <ul class="flex-left">
                    <li>
                        <div class="flex-img-box">
                            <img src="/images/collection-img1.jpg" class="common-img">
                            <span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>5人</span>
                        </div>
                        <h3>藏品的名称</h3>
                        <p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>
                        <div class="btn-flex-box">
                            <span class="zf-icon"><i></i>转发</span>
                            <span class="zan-icon"><i></i>赞</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex-img-box">
                            <img src="/images/collection-img3.jpg" class="common-img">
                            <span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>20人</span>
                        </div>
                        <h3>藏品的名称</h3>
                        <p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>
                        <div class="btn-flex-box">
                            <span class="zf-icon"><i></i>转发</span>
                            <span class="zan-icon"><i></i>赞</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex-img-box">
                            <img src="/images/collection-img5.jpg" class="common-img">
                            <span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>100人</span>
                        </div>
                        <h3>藏品的名称</h3>
                        <p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>
                        <div class="btn-flex-box">
                            <span class="zf-icon"><i></i>转发</span>
                            <span class="zan-icon"><i></i>赞</span>
                        </div>
                    </li>
                </ul>
                <ul  class="flex-right">
                    <li>
                        <div class="flex-img-box">
                            <img src="/images/collection-img2.jpg" class="common-img">
                            <span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>72人</span>
                        </div>
                        <h3>藏品的名称</h3>
                        <p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>
                        <div class="btn-flex-box">
                            <span class="zf-icon"><i></i>转发</span>
                            <span class="zan-icon"><i></i>赞</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex-img-box">
                            <img src="/images/collection-img6.jpg" class="common-img">
                            <span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>36人</span>
                        </div>
                        <h3>藏品的名称</h3>
                        <p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>
                        <div class="btn-flex-box">
                            <span class="zf-icon"><i></i>转发</span>
                            <span class="zan-icon"><i></i>赞</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex-img-box">
                            <img src="/images/collection-img4.jpg" class="common-img">
                            <span><div class="ll-icon-box"><img src="/images/liulan-icon.png" class="common-img"></div>96人</span>
                        </div>
                        <h3>藏品的名称</h3>
                        <p>内容的描述，内容的描述，内容的描述，内容的描述内容的描述内容的描述内容的描述</p>
                        <div class="btn-flex-box">
                            <span class="zf-icon"><i></i>转发</span>
                            <span class="zan-icon"><i></i>赞</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            $.ajax({
                url : "/getMyCollectNote",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    var noteHtml = '';
                    if (data.status){
                        // $.each(data.data, function (k, v) {
                        //     noteHtml += '<li id="'+v.provinceid+'">'+v.province+'</li>';
                        // });
                        // $("#province").html(noteHtml);
                    }else {
                        alert("哎呀！出错了")
                    }
                }
            });
        });
    </script>
</html>