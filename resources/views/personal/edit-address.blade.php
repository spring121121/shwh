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
                <a class="other-color btn-delete" href="javascript:void(0)">删除</a>
            </div>
        </div>
        <div class="mask-box">
            <div class="weChat del-order">
                <span>确定删除此收货地址吗？</span>
                <div class="btn-mask">
                    <button class="btn-del-false">取消</button>
                    <button id="del-address-true">确定</button>
                </div>
            </div>
        </div>

        <!--引入footer-->
        @extends('layout.footer')
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var goods_ids = getUrlParam('goods_id');
            var num = getUrlParam('num');
            var flag = getUrlParam('flag');
            // var address_url = window.location.search;
            var address_id = getUrlParam('id');
            var province_id,city_id,area_id;
            console.log(address_id);
            choice_address();
            $.ajax({
                url : "/addressDetail",	//请求url
                type : "get",	//请求类型  post|get
                dataType : "json",  //返回数据的 类型 text|json|html--
                data: {id:address_id},
                success : function(data){//回调函数 和 后台返回的 数据
                    if (data.status){
                        province_id = data.data[0].provinceId;
                        city_id = data.data[0].cityId;
                        area_id = data.data[0].areaId;
                        $("#shr-name").val(data.data[0].name);
                        $("#shr-phone").val(data.data[0].mobile);
                        $("#"+data.data[0]['provinceId']).attr("selected",'selected');
                        $("#city").find("option:first-child").text(data.data[0].city);
                        $("#area").find("option:first-child").text(data.data[0].area);
                        $("#xxdz").val(data.data[0].address_info);
                        if (data.data[0].is_default ==1){
                            $("#default").attr("checked","checked");
                        } else {
                            $("#default").removeAttr("checked");
                        }
                    }else {
                        alert("哎呀！出错了")
                    }
                }
            });


            $("#btn-keep").click(function () {
                var shr_name = $("#shr-name").val(),
                    shr_phone = $("#shr-phone").val(),
                    shr_province,
                    shr_city,
                    shr_area,
                    shr_xxdz = $("#xxdz").val(),
                    default_address = $("#default").is(":checked");
                var is_default;
                if ($("#city option").length <= 1){
                    shr_province = province_id;
                    shr_city = city_id;
                    shr_area = area_id;
                }else {
                    shr_province = $("#province").find("option:checked").attr("id");
                    shr_city = $("#city").find("option:checked").attr("id");
                    shr_area = $("#area").find("option:checked").attr("id");
                }
                if (default_address){
                    is_default = 1;
                } else {
                    is_default = 0;
                }
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
                            if (data.status){
                                alert("修改成功");
                                if(flag != null){
                                    window.location.href = "/wap/my_address?flag=1&goods_id="+goods_ids+'&num='+num;
                                    return false;
                                }
                                window.location.href = "/wap/my_address";
                            }else {
                                alert("修改失败");
                            }
                        }
                    });
                }
            });
            $("#del-address-true").click(function () {
                $.ajax({
                    url : "/deleteAddress/"+address_id,	//请求url
                    type : "post",	//请求类型  post|get
                    dataType : "json",  //返回数据的 类型 text|json|html--
                    data: {},
                    success : function(data){//回调函数 和 后台返回的 数据
                        if (data.status){
                            alert("删除成功");
                            if(flag != null){
                                window.location.href = "/wap/my_address?flag=1&goods_id="+goods_ids+'&num='+num;
                                return false;
                            }
                            window.location.href = "/wap/my_address";
                        } else {
                            alert("删除失败");
                        }
                    }
                });
            });

            function getUrlParam(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
                if (r != null) return unescape(r[2]); return null; //返回参数值
            }
        });
    </script>
</html>