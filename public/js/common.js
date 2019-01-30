$(function () {
    //登录注册页面，选择登录方式样式切换和表单切换
    //  $(".chose-login li").click(function () {
    //      $(this).css("color","#fff");
    //      $(this).siblings().css("color","#999");
    //      if ($(this).index() == 1){
    //          $(".pass").css("display","block");
    //      }else {
    //          $(".pass").css("display","none");
    //      }
    //  });

    // 点击删除弹出提示框
    $(".btn-delete").click(function () {
        $(".mask-box").css("display", "block");
    });
    $(".btn-del-false").click(function () {
        $(".mask-box").css("display", "none");
    });

    // content-box据顶部的距离动态设置
    $(".content-box").css("margin-top", $(".header").height() + "px");

    //  登录框垂直居中
    $(".vertical-center").css("margin-top", "-" + $(".vertical-center").outerHeight() / 2 + "px");
    $(".weChat").css("margin-top", "-" + $(".weChat").outerHeight() / 2 + "px");

    // 点击微信登陆显示授权
    // $(".weChat-login").click(function () {
    //     $(".mask-box").css("display","block");
    // });
    // $("#btn-qx").click(function () {
    //     $(".mask-box").css("display","none");
    // });

    // 消息中心的消息分类切换
    var index = window.location.search;
    var message_index = index.substr(7);
    if (message_index == '') {
        message_index = 1;
    }
    if (message_index == 0) {
        $(".system").css("display", "block");
        $(".system").siblings(".massage-cont").css("display", "none");
    } else if (message_index == 1) {
        $(".discuss").css("display", "block");
        $(".discuss").siblings(".massage-cont").css("display", "none");
    } else if (message_index == 2) {
        $(".recommend").css("display", "block");
        $(".recommend").siblings(".massage-cont").css("display", "none");
    }
    $('.massage-category ul li').eq(message_index).addClass('click-change');
    $(".massage-category li").click(function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
        // console.log($(this).index())
        // 0代表系统消息，1代表评论消息，2代表推荐消息
        if ($(this).index() == 0) {
            $(".system").css("display", "block");
            $(".system").siblings(".massage-cont").css("display", "none");
        }
        if ($(this).index() == 2) {
            $(".recommend").css("display", "block");
            $(".recommend").siblings(".massage-cont").css("display", "none");
        }
        if ($(this).index() == 1) {
            $(".discuss").css("display", "block");
            $(".discuss").siblings(".massage-cont").css("display", "none");
        }
    });

    // 探宝笔记全选和删除
    var a = 1;
    $("#edit-del").click(function () {
        a = a + 1;
        if (a % 2 == 0) {
            $(this).css("background-image", "url('../images/wc-icon-ffcc00.png')");
            $(".note-list-box li").animate({"margin": "0 55px 20px 25px"}, 500);
            $(".btn-del-box").animate({"bottom": "55px"}, 500);
            $(".choice").animate({"left": "-25px"}, 500);
            $(".btn-del").animate({"right": "-55px"}, 500);
            $(".note-list-box li").find("label").css("display", "block");
            $(".write-note").css("display", "none");
        } else {
            $(this).css("background-image", "url('../images/xzbj-icon-fff.png')");
            $(".note-list-box li").animate({"margin": "0 0 20px 0"}, 500);
            $(".btn-del-box").animate({"bottom": "5px"}, 500, function () {
                $(".write-note").css("display", "block");
            });
            $(".choice").animate({"left": "-20px"}, 500);
            $(".btn-del").animate({"right": "-50px"}, 500);
            $(".note-list-box li").find("label").css("display", "none");
        }
    });
    $("#cancel").click(function () {
        a = a + 1;
        $("#edit-del").css("background-image", "url('../images/xzbj-icon.png')");
        $(".note-list-box li").animate({"margin": "0 0 20px 0"}, 500);
        $(".btn-del-box").animate({"bottom": "5px"}, 500, function () {
            $(".write-note").css("display", "block");
        });
        $(".choice").animate({"left": "-20px"}, 500);
        $(".btn-del").animate({"right": "-50px"}, 500);
        $(".note-list-box li").find("label").css("display", "none");
    });

    // 返回上一级页面
    $('.goback').on('click',function(){
        window.history.go(-1);
    });

    //给全选的复选框添加事件
    $("#all-check").click(function () {
        // this 全选的复选框
        var userids = this.checked;
        //获取name=choice的复选框 遍历输出复选框
        $("input[name=choice]").each(function () {
            this.checked = userids;
        });
        var num = 0;
        num = $("input[name=choice]").length;
        if (userids) {
            $("#list-note").html("已选" + num + "条笔记");
        } else {
            $("#list-note").html("已选" + 0 + "条笔记");
        }
    });
    //给name=choice的复选框绑定单击事件
    $(document).on("click", "input[name=choice]", function () {
        //获取选中复选框长度
        var length = $("input[name=choice]:checked").length;
        //未选中的长度
        var len = $("input[name=choice]").length;
        if (length == len) {
            $("#all-check").get(0).checked = true;
        } else {
            $("#all-check").get(0).checked = false;
        }
        $("#list-note").html("已选" + length + "条笔记");
    });


    // 消息中心的回复按钮链接地址
    $(".btn-reply").attr("href", "/wap/reply_comment");


    // 推荐消息点击li跳转页面
    $(".recommend ul li").click(function () {
        window.location.href = "/wap/recommend";
    });

    // 消息列表的标题显示评论条数
    $("#pl-title-text").html("共" + $("#pl-cont-list li").length + "条评论")


    // 点击转发显示分享
    $(".btn-zf").click(function () {
        $(".share-box").animate({"bottom": "55px"}, 500);
    });

    // 点击评论跳转到评论界面
    $(".btn-pl-list").attr("href", "/wap/pinglun_edit?i=2");

    //评论界面返回
    var pl_index = index.substr(3);
    if (pl_index == 1) {
        $("#btn-pl-return").attr("href", "/wap/recommend");
    } else if (pl_index == 2) {
        $("#btn-pl-return").attr("href", "/wap/my_note");
    }

    //点击取消隐藏分享
    $(".share-box button").click(function () {
        $(".share-box").animate({"bottom": "-95px"}, 500);
    });


    // 店铺页面切换效果
    // $(".store-switch").css("top",$(".store-header").height() + "px");
    // 店铺的展示切换
    $("#dfh-shop").css("display", "block");
    $('.store-switch li').eq(1).addClass('click-change');
    $(".store-switch li").click(function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
        // 0代表商品，1代表待发货，2代表已发货
        if ($(this).index() == 1) {
            $("#dfh-shop").css("display", "block");
            $("#dfh-shop").siblings(".store-content").css("display", "none");
        }
        if ($(this).index() == 0) {
            $("#ysj-shop").css("display", "flex");
            $("#ysj-shop").siblings(".store-content").css("display", "none");
        }
        if ($(this).index() == 2) {
            $("#yfh-shop").css("display", "block");
            $("#yfh-shop").siblings(".store-content").css("display", "none");
        }
    });

    // 点击订单列表跳转到订单详情
    $(".order-cont li a").click(function () {
        $(this).attr("href", "/wap/order_details");
    });

    // 点击删除订单事件
    $(".btn-del-order").click(function (event) {
        event.stopPropagation();
        $(".mask-box").css("display", "block");
    });
    $("#order-return").click(function () {
        $(".mask-box").css("display", "none");
    });

    // 关注页面
    $(".my-concern").css("display", "block");
    $('.follow-title li').eq(0).addClass('click-change');
    $(".follow-title li").click(function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
        // 0代表关注的人，1代表我的粉丝
        if ($(this).index() == 0) {
            $(".my-concern").css("display", "block");
            $(".my-concern").siblings(".gz-common").css("display", "none");
        }
        if ($(this).index() == 1) {
            $(".my-fans").css("display", "block");
            $(".my-fans").siblings(".gz-common").css("display", "none");
        }
    });


    // 点击关注的人跳转到ta的主页
    $(".gz-common").on("click", "li", function (event) {
        if ($(this).attr("class") == "first-title") {
            event.stopPropagation();
        } else {
            var other_id = $(this).attr("class");
            console.log(other_id)
            window.location.href = "/wap/other_home?id=" + other_id;
        }
    });
    $(".gz-common").on("click", "button", function (event) {
        event.stopPropagation();
    });


    // 别人的主页
    $(".other-switch").on('click','li',function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
    });

    var address_height = $(window).height() - 300;
    $(".personal-cont .choice-address ul").css("height", address_height + "px");

});

//编辑地址页面，选择省市区的方法
function choice_address() {
    var province_id, city_id;
    $.ajax({
        url: "/getAllProvinces",	//请求url
        type: "get",	//请求类型  post|get
        dataType: "json",  //返回数据的 类型 text|json|html--
        async: false,
        data: {},
        success: function (data) {//回调函数 和 后台返回的 数据
            var noteHtml = '';
            if (data.status) {
                noteHtml += '<option selected>请选择省份</option>';
                $.each(data.data, function (k, v) {
                    noteHtml += '<option class="'+v.province+'" id="' + v.provinceid + '">' + v.province + '</option>';
                });
                $("#province").html(noteHtml);
            }
        }
    });
    $("#province").on("change click", function () {
        province_id = $(this).find("option:checked").attr("id");
        $.ajax({
            url: "/getCitiesByProvince/" + province_id,	//请求url
            type: "get",	//请求类型  post|get
            dataType: "json",  //返回数据的 类型 text|json|html--
            data: {},
            success: function (data) {//回调函数 和 后台返回的 数据
                var noteHtml = '';
                if (data.status) {
                    noteHtml += '<option selected>请选择城市</option>';
                    $.each(data.data, function (k, v) {
                        noteHtml += '<option class="'+v.city+'" id="' + v.cityid + '">' + v.city + '</option>';
                    });
                    $("#city").html(noteHtml);
                    $("#area").find("option:checked").text("请选择地区");
                    $("#area").find("option:checked").siblings().remove();
                }
            }
        });
    });
    $("#city").on("change", function () {
        city_id = $(this).find("option:checked").attr("id");
        $.ajax({
            url: "/getAreasByCityId/" + city_id,	//请求url
            type: "get",	//请求类型  post|get
            dataType: "json",  //返回数据的 类型 text|json|html--
            data: {},
            success: function (data) {//回调函数 和 后台返回的 数据
                var noteHtml = '';
                if (data.status) {
                    noteHtml += '<option selected>请选择地区</option>';
                    $.each(data.data, function (k, v) {
                        noteHtml += '<option class="'+v.area+'"id="' + v.areaid + '">' + v.area + '</option>';
                    });
                    $("#area").html(noteHtml);
                }
            }
        });
    });
}

//获取url的参数
function GetUrlParam(paraName) {
    var url = document.location.toString();
    var arrObj = url.split("?");

    if (arrObj.length > 1) {
        var arrPara = arrObj[1].split("&");
        var arr;

        for (var i = 0; i < arrPara.length; i++) {
            arr = arrPara[i].split("=");

            if (arr != null && arr[0] == paraName) {
                return arr[1];
            }
        }
        return "";
    } else {
        return "";
    }
}

//获取cookie里的值
function getCookie(cookie_name) {
    var allcookies = document.cookie;
    //索引长度，开始索引的位置
    var cookie_pos = allcookies.indexOf(cookie_name);
    console.log(cookie_pos);
    // 如果找到了索引，就代表cookie存在,否则不存在
    if (cookie_pos != -1) {

        // 把cookie_pos放在值的开始，只要给值加1即可
        //计算取cookie值得开始索引，加的1为“=”
        cookie_pos = cookie_pos + cookie_name.length + 1;
        //计算取cookie值得结束索引
        var cookie_end = allcookies.indexOf(";", cookie_pos);

        if (cookie_end == -1) {
            cookie_end = allcookies.length;

        }
        //得到想要的cookie的值
        var value = unescape(allcookies.substring(cookie_pos, cookie_end));
    }

    return value;
}

function toOtherHome(otherUid) {
    window.location.href = "/wap/other_home?id="+otherUid;
}
//对笔记点赞
function addLikes(note_id) {
    var likeNum = parseInt($("#likeNum-"+note_id).html());
    $.post("/likeNote", {'note_id': note_id}, function (data) {
        if (data.status) {
            $("#dianzan-"+note_id).css("color","red");
            $("#likeNum-"+note_id).html(likeNum+1);
        } else {
            alert(data.message)
            window.location.href = "/wap/login_index"
        }
    })
}

//转发笔记
function addForward(uid, note_id) {
    var forwardNum = parseInt($("#forward-"+note_id).html());
    $.post("/forwardNote", {'beuid': uid, 'note_id': note_id}, function (data) {
        if (data.status) {
            alert("转发成功");
            $("#forward-"+note_id).html(forwardNum+1);
        } else {
            alert(data.message)
            window.location.href = "/wap/login_index"
        }
    })
}

// 获取和增加浏览数量
function browseNum(url,id,type){
    var num;
    $.ajax({
        url : url,	//请求url 商城分类
        type : type,	//请求类型  post|get
        dataType : "json",  //返回数据的 类型 text|json|html--
        data:{browse_id:id,type:1},
        async: false,
        success : function(data){//回调函数 和 后台返回的 数据
            if (url == "/browseCount"){
                num = data.data.count;
            }else if (url == "/createRecord") {
                console.log(data)
            }
        }
    });
    return num;
}

