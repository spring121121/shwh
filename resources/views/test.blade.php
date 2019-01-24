<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/jquery-1.11.0.js"></script>
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
            width: 100%
        }
    </style>
</head>
<body>
<div class="container">
    <h1>测试短信</h1>
</div>
<script type="text/javascript">

    $.ajax({
        url:"http://shwh.jianghairui.com/bindTel",
        type:"post",
        dataType:"json",
        data:{tel:'18526860284',code:'920363'},
        success:function(res) {
            alert(JSON.stringify(res))
        },
        error:function(res) {
            alert('bug')
        }

    })
</script>
</body>
</html>
