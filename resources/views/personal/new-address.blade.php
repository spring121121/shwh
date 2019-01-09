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
            <div class="header-left"><a class="btn-title-text" href="/wap/my_address">返回</a></div>
            <h3 class="top-title">增加收货地址</h3>
        </div>
        <div class="content-box">
            <div class="ipt-cont ipt-address-box">
                <form>
                    <div class="ipt-box"><input id="shr-name" type="text" placeholder="收货人姓名"></div>
                    <div class="ipt-box"><input id="shr-phone" type="text" placeholder="手机号码"></div>
                    <div class="ipt-box ipt-address-choice">
                        <label>所在地区</label>
                        <div class="address-box">
                            <input id="shr-province" type="text" placeholder="省">
                        </div>
                        <div class="address-box">
                            <input id="shr-city" type="text" placeholder="市">
                        </div>
                        <div class="address-box">
                            <input id="shr-area" type="text" placeholder="区">
                        </div>
                    </div>
                    <label>具体位置</label>
                    <div class="ipt-box"><input id="shr-address-info" type="text" placeholder="小区名称xx号楼xx门门牌号"></div>
                    <div class="ipt-box default-box"><input type="checkbox" id="default">设置为默认<label for="default"><em></em></label></div>
                </form>
            </div>
            <div class="btn-new-address"><a href="#">保存</a></div>
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
                            noteHtml += '<div class="address-cont"><a href="jacascript:void(0)" class="edit-address btn-bjdz">编辑</a>';
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

        });
    </script>
</html>