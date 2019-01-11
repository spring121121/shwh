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
        $(".mask-box").css("display","block");
    });
    $(".btn-del-false").click(function () {
        $(".mask-box").css("display","none");
    });

    // content-box据顶部的距离动态设置
    $(".content-box").css("margin-top",$(".header").height() + "px");

   //  登录框垂直居中
    $(".vertical-center").css("margin-top","-" + $(".vertical-center").outerHeight()/2 + "px");
    $(".weChat").css("margin-top","-" + $(".weChat").outerHeight()/2 + "px");

    // 点击微信登陆显示授权
    $(".weChat-login").click(function () {
        $(".mask-box").css("display","block");
    });
    $("#btn-qx").click(function () {
        $(".mask-box").css("display","none");
    });

    // 消息中心的消息分类切换
    var index = window.location.search;
    var message_index = index.substr(7);
    if(message_index ==''){
        message_index = 1;
    }
    if(message_index == 0) {
        $(".system").css("display", "block");
        $(".system").siblings(".massage-cont").css("display", "none");
    }else if(message_index == 1){
        $(".discuss").css("display","block");
        $(".discuss").siblings(".massage-cont").css("display","none");
    }else if(message_index == 2){
        $(".recommend").css("display","block");
        $(".recommend").siblings(".massage-cont").css("display","none");
    }
    $('.massage-category ul li').eq(message_index).addClass('click-change');
    $(".massage-category li").click(function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
        // console.log($(this).index())
        // 0代表系统消息，1代表评论消息，2代表推荐消息
        if ($(this).index() == 0){
            $(".system").css("display","block");
            $(".system").siblings(".massage-cont").css("display","none");
        }
        if ($(this).index() == 2){
            $(".recommend").css("display","block");
            $(".recommend").siblings(".massage-cont").css("display","none");
        }
        if ($(this).index() == 1){
            $(".discuss").css("display","block");
            $(".discuss").siblings(".massage-cont").css("display","none");
        }
    });

    // 探宝笔记全选和删除
    var a = 1;
    $("#edit-del").click(function () {
        a = a+1;
        if (a%2 == 0){
            $(this).css("background-image","url('../images/wc-icon.png')");
            $(".note-list-box li").animate({"margin":"0 55px 20px 25px"},500);
            $(".btn-del-box").animate({"bottom":"55px"},500);
            $(".choice").animate({"left":"-25px"},500);
            $(".btn-del").animate({"right":"-55px"},500);
            $(".note-list-box li").find("label").css("display","block");
            $(".write-note").css("display","none");
        }else {
            $(this).css("background-image","url('../images/xzbj-icon.png')");
            $(".note-list-box li").animate({"margin":"0 0 20px 0"},500);
            $(".btn-del-box").animate({"bottom":"5px"},500,function () {
                $(".write-note").css("display","block");
            });
            $(".choice").animate({"left":"-20px"},500);
            $(".btn-del").animate({"right":"-50px"},500);
            $(".note-list-box li").find("label").css("display","none");
        }
    });
    $("#cancel").click(function () {
        a = a+1;
        $("#edit-del").css("background-image","url('../images/xzbj-icon.png')");
        $(".note-list-box li").animate({"margin":"0 0 20px 0"},500);
        $(".btn-del-box").animate({"bottom":"5px"},500,function () {
            $(".write-note").css("display","block");
        });
        $(".choice").animate({"left":"-20px"},500);
        $(".btn-del").animate({"right":"-50px"},500);
        $(".note-list-box li").find("label").css("display","none");
    });


    //给全选的复选框添加事件
    $("#all-check").click(function(){
        // this 全选的复选框
        var userids=this.checked;
        //获取name=choice的复选框 遍历输出复选框
        $("input[name=choice]").each(function(){
            this.checked=userids;
        });
        var num = 0;
        num = $("input[name=choice]").length;
        if (userids){
            $("#list-note").html("已选" + num + "条笔记");
        }else {
            $("#list-note").html("已选" + 0 + "条笔记");
        }
    });
    //给name=choice的复选框绑定单击事件
    $(document).on("click","input[name=choice]",function(){
        //获取选中复选框长度
        var length=$("input[name=choice]:checked").length;
        //未选中的长度
        var len=$("input[name=choice]").length;
        if(length==len){
            $("#all-check").get(0).checked=true;
        }else{
            $("#all-check").get(0).checked=false;
        }
        $("#list-note").html("已选" + length + "条笔记");
    });


    // 消息中心的回复按钮链接地址
    $(".btn-reply").attr("href","/wap/reply_comment");


    // 推荐消息点击li跳转页面
    $(".recommend ul li").click(function () {
        window.location.href="/wap/recommend";
    });

    // 消息列表的标题显示评论条数
    $("#pl-title-text").html("共" + $("#pl-cont-list li").length + "条评论")


    // 点击转发显示分享
    $(".btn-zf").click(function () {
        $(".share-box").animate({"bottom":"55px"},500);
    });

    // 点击评论跳转到评论界面
    $(".btn-pl-list").attr("href","/wap/pinglun_edit?i=2");

    //评论界面返回
    var pl_index = index.substr(3);
    if (pl_index == 1){
        $("#btn-pl-return").attr("href","/wap/recommend");
    }else if (pl_index == 2) {
        $("#btn-pl-return").attr("href","/wap/my_note");
    }

    //点击取消隐藏分享
    $(".share-box button").click(function () {
        $(".share-box").animate({"bottom":"-95px"},500);
    });


    // 店铺页面切换效果
    $(".store-switch").css("top",$(".store-header").height() + "px");
    // 店铺的展示切换
    $(".shop-list").css("display","flex");
    $('.store-switch li').eq(1).addClass('click-change');
    $(".store-switch li").click(function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
        // 0代表笔记，1代表商品，2代表收藏
        if ($(this).index() == 0){
            $(".notes-box").css("display","block");
            $(".notes-box").siblings(".store-content").css("display","none");
        }
        if ($(this).index() == 2){
            $(".store-list").css("display","flex");
            $(".store-list").siblings(".store-content").css("display","none");
        }
        if ($(this).index() == 1){
            $(".shop-list").css("display","flex");
            $(".shop-list").siblings(".store-content").css("display","none");
        }
    });

    // 点击订单列表跳转到订单详情
    $(".order-cont li a").click(function () {
        $(this).attr("href","/wap/order_details");
    });

    // 点击删除订单事件
    $(".btn-del-order").click(function (event) {
        event.stopPropagation();
        $(".mask-box").css("display","block");
    });
    $("#order-return").click(function () {
        $(".mask-box").css("display","none");
    });

    // 关注页面
    $(".my-concern").css("display","block");
    $('.follow-title li').eq(0).addClass('click-change');
    $(".follow-title li").click(function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
        // 0代表关注的人，1代表我的粉丝
        if ($(this).index() == 0){
            $(".my-concern").css("display","block");
            $(".my-concern").siblings(".gz-common").css("display","none");
        }
        if ($(this).index() == 1){
            $(".my-fans").css("display","block");
            $(".my-fans").siblings(".gz-common").css("display","none");
        }
    });
    
    
    // 点击关注的人跳转到ta的主页
    $(".gz-common").on("click","li",function (event) {
        if ($(this).attr("class") == "first-title") {
            event.stopPropagation();
        }else {
            window.location.href = "/wap/other_home";
        }
    });
    $(".gz-common").on("click","button",function (event) {
        event.stopPropagation();
    });


    // 别人的主页
    $(".treasure-note").css("display","block");
    $('.other-switch li').eq(0).addClass('click-change');
    $(".other-switch li").click(function () {
        $(this).addClass("click-change");
        $(this).siblings().removeClass("click-change");
        // 0代表探宝笔记，1代表宝藏收藏，2代表点赞痕迹
        if ($(this).index() == 0){
            $(".treasure-note").css("display","block");
            $(".treasure-note").siblings(".other-content").css("display","none");
        }
        if ($(this).index() == 1){
            $(".treasure-collection").css("display","flex");
            $(".treasure-collection").siblings(".other-content").css("display","none");
        }
        if ($(this).index() == 2){
            $(".mark-praise").css("display","block");
            $(".mark-praise").siblings(".other-content").css("display","none");
        }
    });


    var address_height = $(window).height()-300;
    $(".personal-cont .choice-address ul").css("height",address_height+"px");

});
//编辑地址页面，选择省市区的方法
function choice_address() {
    var province_id,city_id;
    $.ajax({
        url : "/getAllProvinces",	//请求url
        type : "get",	//请求类型  post|get
        dataType : "json",  //返回数据的 类型 text|json|html--
        async:false,
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
    $("#province").on("click",function () {
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
    $("#city").on("click",function () {
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