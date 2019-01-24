<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商城-订单</title>
    <link rel="stylesheet" href="/styles/museum.css">
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
    <link rel="stylesheet" href="/styles/personal.css">
    <style>
        .head{
            position:fixed;
        }
        .title{
            margin-left:-10%;
        }
        .select{
            height:auto;
            background: #FAFAFA;
        }
        .select_b li{
            padding:0 10px;
        }
        .select_b{
            margin-top:55px;
            background: #fff;
            margin-left:5px;
            margin-right:5px;
        }
        .open-address {
            font-size: 22px;
            color: black;
            float: right;
            width: 40px;
            height: 20px;
            text-align: right;
            border-radius: 5px;
            margin-top: 20px;
            line-height: 20px;
        }
        a,a:hover,a:active,a:visited,a:link,a:focus{
            -webkit-tap-highlight-color:rgba(0,0,0,0);
            -webkit-tap-highlight-color: transparent;
            outline:none;
            background: none;
            text-decoration: none;
        }
        .pay{
            height:50px;
            margin-bottom:10px;
        }
        .select_way{
            background: #fff;
            margin-left: 5px;
            margin-right:5px;
            padding:0 10px;
        }
        .select_submit{
            width:100%;
            bottom: 0;
            border-top:1px solid #DEDEDE;
            position:fixed;
            background: #fff;
            height:50px;
            padding-left:10px;
            padding-right:20px;
            z-index: 9999;
        }
        .way{
            float:left;
            line-height:55px;
            vertical-align: middle;
            font-size:14px;
        }
        .way_right{
            margin-left:65%;
        }
        .total{
            height:120px;
            background: #fff;
            padding-top:10px;
            padding-right:19px;
            font-size:14px;
        }
        .price{
            float:right;
            margin-top:-16px;
        }
        .post,.t_price{
            color:red;
        }
        .total_price{
            float:left;
            font-size:20px;
            line-height: 50px;
            vertical-align: middle;
        }
        .total_submit{
            float:right;
            background: red;
            width:35%;
            color:#fff;
            text-align: center;
            font-size:16px;
            margin-top:-1px;
            height:51px;
        }



        .store_parent{
            margin-bottom:15px;
        }
        .store_height{
            height:15px;
        }
        .store_nameDiv{
            height:30px;
        }
        .store_checkbox{
            float:left;
        }
        .store_name{
            float:left;
            font-size:18px;
        }
        .car_div{
            height:90px;
            margin-top:10px;
        }
        .car_img{
            float:left;
            margin-right:10px;
        }
        .car_image{
            width:80px;
            height:80px;
            border-radius:10px;
        }
        .car_{
            font-size:12px;
            margin-top:8px;
        }
        .car_price{
            font-size:12px;
        }
        .car_num{
            float:right;
            margin-top:60px;
            margin-right:10px;
        }
        .hr{
            margin-left:-10px;
            width:106%;
            height:10px;
            background: #FAFAFA;
        }
    </style>
</head>
<body>
    <header class="head">
        <ul>
            <li>
                <span class="iconfont icon-ffanhui- back"></span>
            </li>
            <li class="title">填&nbsp;写&nbsp;订&nbsp;单</li>
            <li></li>
        </ul>
    </header>
    <section class="b select">
        <div class="my-address-box select_b">
            <ul>
            </ul>
        </div>
        <div class="select_way pay">
            <div class="way">
                支付方式
            </div>
            <div class="way way_right btn1">
                在线支付
            </div>
        </div>

        <div class="select_way zc_carGoods">

        </div>

        <div class="select_way total">
            {{--<div>商品金额</div>--}}
            {{--<div class="price">￥228.00</div>--}}
            {{--<div style="margin-top:10px;">运费</div>--}}
            {{--<div class="price post">+&nbsp;￥6.00</div>--}}
        </div>
    </section>
    <footer class="select_submit">
        {{--<div class="total_price t_price">￥228.00</div>--}}
        {{--<div class="total_price total_submit">提交订单</div>--}}
    </footer>
</body>
<script src="/js/jquery-3.0.0.min.js"></script>
<script>
    $(function(){
        var id = getUrlParam('id');
        var goodsid = getUrlParam('goods_id');
        var num = getUrlParam('num');
        $.ajax({
            url : "/defaultAddress",	//请求url
            type : "get",	//请求类型  post|get
            async:true,
            dataType : "json",  //返回数据的 类型 text|json|html--
            data: {id:id},
            success : function(data){//回调函数 和 后台返回的 数据
                var defaultAddress = '';
                if (data.status){
                    $.each(data.data, function (k, v) {
                        defaultAddress += '<li><div class="icon-box">'+v.name.substr(0,1)+'</div>';
                        defaultAddress += '<div class="address-cont"><a href="/wap/my_address?flag=1'+'&goods_id='+goodsid+'&num='+num+'" id="'+v.id+'" class="open-address btn-bjdz">></a>';
                        defaultAddress += '<h3>'+v.name+'<span>'+v.mobile+'</span></h3>';
                        defaultAddress += '<p>';
                        if(v.is_default == 1){
                            defaultAddress += '<span>默认</span>';
                        }
                        defaultAddress += v.province+' '+v.city+' '+v.area+' '+v.address_info+'</p>';
                        defaultAddress += '</div></li>';
                    });
                    $(".my-address-box ul").html(defaultAddress);
                }else {
                    alert("哎呀！出错了");
                }
            }
        });
        var car = '',goods='',settle='';
        $.ajax({
            url : "/myOrderList",	//请求url 商城分类
            type : "get",	//请求类型  post|get
            async: true,
            dataType : "json",  //返回数据的 类型 text|json|html--
            data:{goods_id:goodsid,num:num},
            success : function(data){//回调函数 和 后台返回的 数据
                console.log(data);
                var record = data.data;
                $.each(record.data, function (k, v) {
                    car += '<div class="store_parent">';
                    car += '<div class="store_div">';
                    car += '<div class="store_height"></div>';
                    car += '<div class="store_nameDiv">';
                    car += '<div class="store_name">'+v['name']+'</div>';
                    car += '</div>';
                    $.each(v.goods, function (k, goods) {
                        car += '<div class="car_div">';
                        car += '<div class="car_img">';
                        car += '<img class="car_image" src="'+goods['image_one']+'"/>';
                        car += '</div>';
                        car += '<div class="store_checkbox">';
                        car += '<p>'+goods['goods_name']+'</p>';
                        car += '<p>'+goods['goods_info'].substr(0,5)+'...</p>';
                        car += '<p class="car_"></p>';
                        car += '<p class="car_price">￥'+goods['price']+'</p></div>';
                        car += '<div class="zc_btngroup car_num">x&nbsp;'+goods['num']+'</div></div>';
                    });
                    car += '</div></div><div class="hr"></div>';
                });
                $('.zc_carGoods').html(car);

                goods += '<div>商品金额</div>';
                goods += '<div class="price">￥'+record['total']+'</div>';
                goods += '<div style="margin-top:10px;">运费</div>';
                goods += '<div class="price post">+&nbsp;￥'+record['postage']+'</div>';
                $('.total').html(goods);

                settle += '<div class="total_price t_price">￥'+record['total_price']+'</div>';
                settle += '<div class="total_price total_submit">提交订单</div>';
                $('.select_submit').html(settle);
            }
        });

        $('.back').on('click',function(){
            window.location.href="/wap/shop_cart";
        });

        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }

        $('.total_submit').on('click',function(){
            var address_id = $('.btn-bjdz').attr('id');
            $.ajax({
                url : "/purchase",	//请求url 商城分类
                type : "post",	//请求类型  post|get
                async: false,
                dataType : "json",  //返回数据的 类型 text|json|html--
                data:{address_id:address_id,goods_id:goodsid,num:num},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data);
                    if(data.status){
                        var order = data.data.pay_order_sn;
                        window.location.href="http://shwh.jianghairui.com/wx/pay?pay_order_sn="+order;
                    }
                }
            });
        });
    });
</script>
</html>
