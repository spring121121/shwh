$(function () {
    var reg_phone = /^[1][3,4,5,6,7,8][0-9]{9}$/;
    var reg_pass = /^[A-z][\w\d]{7,15}$/;
    var reg_card = /(^\d{18}$)|(^\d{17}(\d|x)$)/;
    var reg_num = /^[1-9]/;
    blur_yanzheng(".phone",reg_phone,"请输入正确的手机号");
    blur_yanzheng(".ipt-bind-mobile",reg_phone,"请输入正确的手机号");
    blur_yanzheng("#store-id-card",reg_card,"请输入有效的身份证号码");
    blur_yanzheng(".password",reg_pass,"请输入8-16位数的英文和数字组合密码");
    blur_yanzheng("#shop-price",reg_num,"输入的价格不能以0开头");
    // blur_yanzheng("#shop-freight",reg_num,"输入的运费不能以0开头");
    blur_yanzheng("#shop-stock",reg_num,"输入的库存数量不能以0开头");
    $(".password-again").blur(function () {
        if ($(".password").val() === $(this).val()){
        } else {
            layer.msg('两次输入的密码不一致！');
        }
    });
});
function blur_yanzheng(classname,reg,tip) {
    $(classname).blur(function () {
        if (reg.test($(this).val())) {
        } else {
            layer.msg(tip);
        }
    });
}