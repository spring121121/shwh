<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>收货地址-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <div class="header-right bg-add"><a href="/wap/new_address"></a></div>
            <h3 class="top-title">收货地址</h3>
        </div>
        <div class="content-box">
            <div class="my-address-box">
                <ul>
                </ul>
            </div>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            $.ajax({
                url : "/addressList",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data)
                    var noteHtml = '';
                    if (data.status){
                        $.each(data.data, function (k, v) {
                            noteHtml += '<li><div class="icon-box">'+v.name.substr(0,1)+'</div>';
                            noteHtml += '<div class="address-cont"><a href="javascript:void(0)" id="'+v.id+'" class="edit-address btn-bjdz">编辑</a>';
                            noteHtml += '<h3>'+v.name+'<span>'+v.mobile+'</span></h3>';
                            noteHtml += '<p>';
                                            if(v.is_default == 1){
                                                noteHtml += '<span>默认</span>';
                                            }
                            noteHtml += v.province+' '+v.city+' '+v.area+' '+v.address_info+'</p>';
                            noteHtml += '</div></li>';
                        });
                        $(".my-address-box ul").html(noteHtml);
                    }
                }
            });
            $(document).on("click",".btn-bjdz",function () {
                var addressId = $(this).attr("id");
                console.log(111)
                window.location.href = "/wap/edit_address?id="+addressId;
            });
        });
    </script>
</html>