$(function () {
    var reg_phone = /^[1][3,4,5,6,7,8][0-9]{9}$/;
    var reg_pass = /^[A-z][\w\d]{7,15}$/;
    blur_yanzheng(".phone",reg_phone,"请输入正确的手机号");
    blur_yanzheng(".password",reg_pass,"请输入8-16位数的英文和数字组合密码");
    $(".password-again").blur(function () {
        if ($(".password").val() === $(this).val()){
            $(".tips").css("display","none");
        } else {
            $(".tips").css("display","block").html("两次密码输入不一致");
        }
    });
});
function blur_yanzheng(classname,reg,tip) {
    $(classname).blur(function () {
        if (reg.test($(this).val())) {
            $(".tips").css("display","none");
        } else {
            $(".tips").css("display","block").html(tip);
        }
    });
}