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



   //  登录框垂直居中
    $(".vertical-center").css("margin-top","-" + $(".vertical-center").outerHeight()/2 + "px");
    $(".weChat").css("margin-top","-" + $(".weChat").outerHeight()/2 + "px");

    // 点击微信登陆显示授权
    $(".weChat-login").click(function () {
        $(".mask-box").css("display","block");
    });

    // 消息中心的消息分类切换
    var index = window.location.search;
    var message_index = index.substr(7)
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
            $(this).html("完成");
            $(".note-list-box li").animate({"margin":"0 55px 20px 25px"},500);
            $(".btn-del-box").animate({"bottom":"0"},500);
            $(".choice").animate({"left":"-25px"},500);
            $(".btn-del").animate({"right":"-55px"},500);
            $(".note-list-box li").find("label").css("display","block");
            $(".write-note").css("display","none");
        }else {
            $(this).html("编辑");
            $(".note-list-box li").animate({"margin":"0 0 20px 0"},500);
            $(".btn-del-box").animate({"bottom":"-50px"},500,function () {
                $(".write-note").css("display","block");
            });
            $(".choice").animate({"left":"-20px"},500);
            $(".btn-del").animate({"right":"-50px"},500);
            $(".note-list-box li").find("label").css("display","none");
        }
    });
    $("#cancel").click(function () {
        a = a+1;
        $("#edit-del").html("编辑");
        $(".note-list-box li").animate({"margin":"0 0 20px 0"},500);
        $(".btn-del-box").animate({"bottom":"-50px"},500,function () {
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
    $("input[name=choice]").click(function(){
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


    // 删除
    $(".btn-del button").click(function () {
        $(this).parents("li").remove();
    });
    // 删除全选
    $("#btn-all-del").click(function () {
        $("input[name=choice]:checked").parents("li").remove();
    });

    // 消息中心的回复按钮链接地址
    $(".btn-reply").attr("href","reply-comment.html");


    // 推荐消息点击li跳转页面
    $(".recommend ul li").click(function () {
        window.location.href="recommend.html";
    });

    // 消息列表的标题显示评论条数
    $("#pl-title-text").html("共" + $("#pl-cont-list li").length + "条评论")


    // 点击转发显示分享
    $(".btn-zf").click(function () {
        $(".share-box").animate({"bottom":"0"},500);
    });

    // 点击评论跳转到评论界面
    $(".btn-pl-list").attr("href","pinglun-edit.html?i=2");

    //评论界面返回
    var pl_index = index.substr(3);
    console.log(pl_index)
    if (pl_index == 1){
        $("#btn-pl-return").attr("href","recommend.html");
    }else if (pl_index == 2) {
        $("#btn-pl-return").attr("href","my-note.html");
    }

    //点击取消隐藏分享
    $(".share-box button").click(function () {
        $(".share-box").animate({"bottom":"-150px"},500);
    });
});