<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山洞-工厂</title>
    <link rel="stylesheet" href="/styles/swiper.min.css">
    <link rel="stylesheet" href="/styles/museum.css">
    <link rel="stylesheet" href="/styles/factory.css">
    <style>
        .container {
            width:96%;margin: 0 auto;padding:0;
            margin-top: 20px;
        }
        .waterfall{
            /* Firefox */
            /*-moz-column-count:4; */
            /* Safari 和 Chrome */
            /*-webkit-column-count:4; */
            column-count:2;
            -moz-column-gap: 1em;
            -webkit-column-gap: 1em;
            column-gap: 1em;
        }
        /*一个内容层*/
        .item{
            padding: 0em;
            margin: 0 0 1em 0;
            -moz-page-break-inside: avoid;
            -webkit-column-break-inside: avoid;
            break-inside: avoid;
            border: 0;
        }
        .item img{
            width: 100%;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
    <div id="home">
        <header>
            <ul>
                <li>
                    <a href="/wap/index"></a>
                </li>
                <li>工厂</li>
                <li>
                    <span></span>
                </li>
            </ul>
        </header>
        <!--笔记-->
        <div class="container" style="padding:15px 0px">
            <div class="waterfall">
                @foreach ($list as $li)
                    <div class="item">
                        <img src="{{$li['logo_pic_url']}}" alt="">
                        <p style="text-align: center">{{$li['store_name']}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>