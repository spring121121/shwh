<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞,山洞,山洞平台,文创产品">
        <title>新增收货地址-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/my_address"></a></div>
            <h3 class="top-title">增加收货地址</h3>
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
                    <label>具体位置</label>
                    <div class="ipt-box"><input id="shr-address-info" type="text" placeholder="小区名称xx号楼xx门门牌号"></div>
                    <div class="ipt-box default-box"><input type="checkbox" id="default">设置为默认<label for="default"><em></em></label></div>
                </form>
            </div>
            <div class="btn-new-address"><a href="#" id="btn-new-keep">保存</a></div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            choice_address();
            $("#btn-new-keep").click(function () {
                var shr_name = $("#shr-name").val(),
                    shr_phone = $("#shr-phone").val(),
                    shr_province = $("#province").find("option:checked").attr("id"),
                    shr_city = $("#city").find("option:checked").attr("id"),
                    shr_area = $("#area").find("option:checked").attr("id"),
                    shr_xxdz = $("#shr-address-info").val(),
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
                }else if ($("#province option:checked").text() == "请选择省份") {
                    alert("请选择省份");
                }else if ($("#city option:checked").text() == "请选择城市") {
                    alert("请选择城市");
                }else if ($("#area option:checked").text() == "请选择地区") {
                    alert("请选择地区");
                }else if (shr_xxdz == "") {
                    alert("请填写详细地址");
                }else {
                    console.log(shr_name,shr_phone,shr_province,shr_city,shr_area,shr_xxdz,is_default,default_address);
                    $.ajax({
                        url : "/addAddress",	//请求url
                        type : "post",	//请求类型  post|get
                        dataType : "json",  //返回数据的 类型 text|json|html--
                        data: {
                            name:shr_name,
                            province:shr_province,
                            city:shr_city,
                            area:shr_area,
                            address_info:shr_xxdz,
                            mobile:shr_phone,
                            is_default:is_default
                        },
                        success : function(data){//回调函数 和 后台返回的 数据
                            if (data.status){
                                alert("添加成功");
                                window.location.href = "/wap/my_address";
                            }else {
                                alert("添加失败");
                            }
                        }
                    });
                }
            });
        });
    </script>
</html>