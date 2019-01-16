<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
            </div>
        </div>
        <div class="container">
            <div class="panel-heading">upload</div>
            <form class="form-horizontal" method="POST" action="/upload" id="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="file">选择文件</label>
                <input id="file" type="file" class="form-control" name="source" id="source">
                <input  type="text" class="form-control" name="need_check" value="1" >
                <button type="submit" class="btn btn-primary">确定</button>
            </form>
        </div>
        <div class="container">
            <div class="panel-heading">checkimg</div>
            <form class="form-horizontal" method="POST" action="/sameHqSearch" id="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="file">选择文件</label>
                <input id="file" type="file" class="form-control" name="source" id="source">
                <button type="submit" class="btn btn-primary">确定</button>
            </form>
        </div>
    </body>
</html>
