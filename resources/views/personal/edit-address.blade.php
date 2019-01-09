<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>编辑收货地址-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/my_address"></a></div>
            <h3 class="top-title">编辑收货地址</h3>
        </div>
        <div class="content-box">
            <div class="ipt-cont ipt-address-box">
                <form>
                    <div class="ipt-box"><input id="shr-name" type="text" placeholder="收货人姓名"></div>
                    <div class="ipt-box"><input id="shr-phone" type="text" placeholder="手机号码"></div>
                    <div class="ipt-box address-choice">
                        <label>收货地址</label>
                        <ul>
                            <li>
                                <div class="btn-address-choice province"></div>
                                <div class="ipt-choice"><input id="province" type="text" disabled placeholder="省"></div>
                                <div class="get-address get-province"></div>
                            </li>
                            <li>
                                <div class="btn-address-choice city"></div>
                                <div class="ipt-choice"><input id="city" type="text" readonly placeholder="市"></div>
                                <div class="get-address get-city"></div>
                            </li>
                            <li>
                                <div class="btn-address-choice area"></div>
                                <div class="ipt-choice"><input id="area" type="text" readonly placeholder="区"></div>
                                <div class="get-address get-area"></div>
                            </li>
                        </ul>
                    </div>
                    <label for="xxdz">具体位置</label>
                    <div class="ipt-box"><input type="text" id="xxdz" placeholder="小区名称xx号楼xx门门牌号"></div>
                    <div class="ipt-box default-box"><input type="checkbox" id="default">设置为默认<label for="default"><em></em></label></div>
                </form>
            </div>
            <div class="btn-write-note">
                <a href="#" id="btn-keep">保存</a>
                <a class="other-color" href="#">删除</a>
            </div>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            choice_address();
            var address_url = window.location.search;
            var address_id = address_url.substr(4);
            console.log(address_id)
            $("#btn-keep").click(function () {
                var shr_name = $("#shr-name").val(),
                    shr_phone = $("#shr-phone").val(),
                    shr_province = $("#province").val(),
                    shr_city = $("#city").val(),
                    shr_area = $("#area").val(),
                    shr_xxdz = $("#xxdz").val(),
                    default_address = $("#default").is(":checked");
                var is_default;
                if (default_address){
                    is_default = 1;
                } else {
                    is_default = 0;
                }
                if(shr_name == ""){
                    alert("请填写收货人姓名");
                }else if (shr_phone == "") {
                    alert("请填写收货人手机号码");
                }else if (shr_province == '') {
                    alert("请选择省份");
                }else if (shr_city == '') {
                    alert("请选择城市");
                }else if (shr_area == '') {
                    alert("请选择地区");
                }else if (shr_xxdz == "") {
                    alert("请填写详细地址");
                }else {
                    $.ajax({
                        url : "/updateAddress",	//请求url
                        type : "post",	//请求类型  post|get
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        data: {
                            id:address_id,
                            name:shr_name,
                            province:shr_province,
                            city:shr_city,
                            area:shr_area,
                            address_info:shr_xxdz,
                            mobile:shr_phone,
                            is_default:is_default
                        },
                        success : function(data){//回调函数 和 后台返回的 数据
                            console.log(data)
                            if (data.status){
                                alert("修改成功");
                            }else {
                                alert("修改失败");
                            }
                        }
                    });
                }
            });
            $.ajax({
                url : "/addressDetail",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {id:address_id},
                success : function(data){//回调函数 和 后台返回的 数据
                    console.log(data.data[0].city);
                    $("#shr-name").val(data.data[0].name);
                    $("#shr-phone").val(data.data[0].mobile);
                    $("#province").val(data.data[0].province);
                    $("#city").val(data.data[0].city);
                    $("#area").val(data.data[0].area);
                    $("#xxdz").val(data.data[0].address_info);
                    if (data.data[0].is_default ==1){
                        $("#default").attr("checked","checked");
                    } else {
                        $("#default").removeAttr("checked");
                    }
                    // var noteHtml = '';
                    // if (data.status){
                    //     $.each(data.data, function (k, v) {
                    //         noteHtml += '<span id="'+v.provinceid+'">'+v.province+'</span>';
                    //     });
                    //     $(".get-province").html(noteHtml);
                    //     if (flag) {
                    //         $(".province").css("background-image","url('../images/down-icon.png')");
                    //         $(".get-province").slideDown();
                    //     }else {
                    //         $(".province").css("background-image","url('../images/return.png')");
                    //         $(".get-province").slideUp();
                    //     }
                    // }
                }
            });
        });
        //编辑地址页面，选择省市区的方法
        function choice_address() {
            var flag = false;
            var province_id,city_id;
            $(".province").click(function () {//点击选择省份
                flag = !flag;
                $.ajax({
                    url : "/getAllProvinces",	//请求url
                    type : "get",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {},
                    success : function(data){//回调函数 和 后台返回的 数据
                        var noteHtml = '';
                        if (data.status){
                            $.each(data.data, function (k, v) {
                                noteHtml += '<span id="'+v.provinceid+'">'+v.province+'</span>';
                            });
                            $(".get-province").html(noteHtml);
                            if (flag) {
                                $(".province").css("background-image","url('../images/down-icon.png')");
                                $(".get-province").slideDown();
                            }else {
                                $(".province").css("background-image","url('../images/return.png')");
                                $(".get-province").slideUp();
                            }
                        }
                    }
                });
            });
            $(".get-province").on("click","span",function () {
                $(".province").css("background-image","url('../images/return.png')");
                province_id = $(this).attr("id");
                $("#province").val($(this).text());
                $(".get-province").slideUp();
                flag = !flag;
            });
            $(".city").click(function () {//点击选择城市
                flag = !flag;
                $.ajax({
                    url : "/getCitiesByProvince/" + province_id,	//请求url
                    type : "get",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {},
                    success : function(data){//回调函数 和 后台返回的 数据
                        var noteHtml = '';
                        if (data.status){
                            $.each(data.data, function (k, v) {
                                noteHtml += '<span id="'+v.cityid+'">'+v.city+'</span>';
                            });
                            $(".get-city").html(noteHtml);
                            if (flag) {
                                $(".city").css("background-image","url('../images/down-icon.png')");
                                $(".get-city").slideDown();
                            }else {
                                $(".city").css("background-image","url('../images/return.png')");
                                $(".get-city").slideUp();
                            }
                        }
                    }
                });
            });
            $(".get-city").on("click","span",function () {
                $(".city").css("background-image","url('../images/return.png')");
                city_id = $(this).attr("id");
                $("#city").val($(this).text());
                $(".get-city").slideUp();
                flag = !flag;
            });
            $(".area").click(function () {//点击选择地区
                flag = !flag;
                $.ajax({
                    url : "/getAreasByCityId/" + city_id,	//请求url
                    type : "get",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {},
                    success : function(data){//回调函数 和 后台返回的 数据
                        var noteHtml = '';
                        if (data.status){
                            $.each(data.data, function (k, v) {
                                noteHtml += '<span id="'+v.areaid+'">'+v.area+'</span>';
                            });
                            $(".get-area").html(noteHtml);
                            if (flag) {
                                $(".area").css("background-image","url('../images/down-icon.png')");
                                $(".get-area").slideDown();
                            }else {
                                $(".area").css("background-image","url('../images/return.png')");
                                $(".get-area").slideUp();
                            }
                        }
                    }
                });
            });
            $(".get-area").on("click","span",function () {
                $(".area").css("background-image","url('../images/return.png')");
                $("#area").val($(this).text());
                $(".get-area").slideUp();
                flag = !flag;
            });
        }
    </script>
</html>