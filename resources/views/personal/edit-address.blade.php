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
                        <div class="select-box">
                            <select id="province">
                                <option selected>请选择省份</option>
                            </select>
                            <select id="city">
                                <option selected>请选择城市</option>
                            </select>
                            <select id="area">
                                <option selected>请选择地区</option>
                            </select>
                        </div>
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
            $("#btn-keep").click(function () {
                var shr_name = $("#shr-name").val(),
                    shr_phone = $("#shr-phone").val(),
                    shr_province = $("#province").find("option:checked").attr("id"),
                    shr_city = $("#city").find("option:checked").attr("id"),
                    shr_area = $("#area").find("option:checked").attr("id"),
                    shr_xxdz = $("#xxdz").val(),
                    default_address = $("#default").is(":checked");
                var is_default;
                if (default_address){
                    is_default = 1;
                } else {
                    is_default = 0;
                }
                console.log(shr_province,shr_city,shr_area,is_default);
                if(shr_name == ""){
                    alert("请填写收货人姓名");
                }else if (shr_phone == "") {
                    alert("请填写收货人手机号码");
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
                            // console.log(data)
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
                    $("#shr-name").val(data.data[0].name);
                    $("#shr-phone").val(data.data[0].mobile);
                    $("#province option").find("#"+data.data[0].provinceid).attr("checked","checked");
                    $("#city").find("option:first-child").text(data.data[0].city);
                    $("#area").find("option:first-child").text(data.data[0].area);
                    $("#xxdz").val(data.data[0].address_info);
                    if (data.data[0].is_default ==1){
                        $("#default").attr("checked","checked");
                    } else {
                        $("#default").removeAttr("checked");
                    }
                }
            });
        });
        //编辑地址页面，选择省市区的方法
        function choice_address() {
            var province_id,city_id;
            $.ajax({
                url : "/getAllProvinces",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {},
                success : function(data){//回调函数 和 后台返回的 数据
                    var noteHtml = '';
                    if (data.status){
                        noteHtml += '<option selected>请选择省份</option>';
                        $.each(data.data, function (k, v) {
                            noteHtml += '<option id="'+v.provinceid+'">'+v.province+'</option>';
                        });
                        $("#province").html(noteHtml);
                    }
                }
            });
            $("#province").on("change",function () {
                province_id = $(this).find("option:checked").attr("id");
                $.ajax({
                    url : "/getCitiesByProvince/" + province_id,	//请求url
                    type : "get",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {},
                    success : function(data){//回调函数 和 后台返回的 数据
                        var noteHtml = '';
                        if (data.status){
                            noteHtml += '<option selected>请选择城市</option>';
                            $.each(data.data, function (k, v) {
                                noteHtml += '<option id="'+v.cityid+'">'+v.city+'</option>';
                            });
                            $("#city").html(noteHtml);
                            $("#area").find("option:checked").text("请选择地区");
                            $("#area").find("option:checked").siblings().remove();
                        }
                    }
                });
            });
            $("#city").on("change",function () {
                city_id = $(this).find("option:checked").attr("id");
                $.ajax({
                    url : "/getAreasByCityId/" + city_id,	//请求url
                    type : "get",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {},
                    success : function(data){//回调函数 和 后台返回的 数据
                        var noteHtml = '';
                        if (data.status){
                            noteHtml += '<option selected>请选择地区</option>';
                            $.each(data.data, function (k, v) {
                                noteHtml += '<option id="'+v.areaid+'">'+v.area+'</option>';
                            });
                            $("#area").html(noteHtml);
                        }
                    }
                });
            });
        }
    </script>
</html>