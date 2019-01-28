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
        <style>
            .address-cont{
                width:70%;
            }
            .edit-address{
                width:10%;
                float:right;
                margin-top:-35px;
                background: #ffcc00;
                color:#fff;
                border-radius:6px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a class="goback"></a></div>
            <div class="header-right bg-add"><a class="add_address" href="javascript:void(0);"></a></div>
            <h3 class="top-title">收货地址</h3>
        </div>
        <div class="content-box">
            <div class="my-address-box">
                <ul>
                </ul>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
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
                    var noteHtml = '';
                    if (data.status){
                        $.each(data.data, function (k, v) {
                            noteHtml += '<li><div class="icon-box">'+v.name.substr(0,1)+'</div>';
                            noteHtml += '<div class="address-cont address"><input type="hidden" value="'+v['id']+'">';
                            noteHtml += '<h3>'+v.name+'<span>'+v.mobile+'</span></h3>';
                            noteHtml += '<p>';
                                            if(v.is_default == 1){
                                                noteHtml += '<span>默认</span>';
                                            }
                            noteHtml += v.province+' '+v.city+' '+v.area+' '+v.address_info+'</p>';
                            noteHtml += '</div><a href="javascript:void(0)" id="'+v.id+'" class="edit-address btn-bjdz">编辑</a></li>';
                        });
                        $(".my-address-box ul").html(noteHtml);
                    }else {
                        layer.msg(data.message)
                    }
                }
            });
            var goods_ids = getUrlParam('goods_id');
            var num = getUrlParam('num');
            var flag = getUrlParam('flag');
            $(document).on("click",".btn-bjdz",function () {
                var addressId = $(this).attr("id");
                if(flag != null){
                    window.location.href = "/wap/edit_address?id="+addressId+'&flag=1&goods_id='+goods_ids+'&num='+num;
                    return false;
                }
                window.location.href = "/wap/edit_address?id="+addressId;
            });
            $(document).on("click",".address",function () {
                var addressId = $(this).find('input').val();
                if(flag != null){
                    window.location.href = "/wap/shop_purchase?id="+addressId+'&goods_id='+goods_ids+'&num='+num;
                    return false;
                }
            });
            $('.goback').on('click',function(){
                if(flag != null){
                    window.location.href = "/wap/shop_purchase?goods_id="+goods_ids+'&num='+num;
                    return false;
                }
                window.location.href = "/wap/personal";
            });
            //新增地址
            $('.add_address').on('click',function(){
                if(flag != null){
                    window.location.href = "/wx/ad?flag=1&goods_id="+goods_ids+'&num='+num;
                    return false;
                }
                window.location.href = "/wx/ad";
            });
            function getUrlParam(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
                if (r != null) return unescape(r[2]); return null; //返回参数值
            }
        });
    </script>
</html>