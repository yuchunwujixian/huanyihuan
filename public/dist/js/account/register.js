
$(function(){
    //密码显示隐藏
    $('.password-eye').click(function () {
        var _this = $(this);
        if (_this.hasClass('glyphicon-eye-open')){
            _this.removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            _this.parent().prev().attr('type', 'password');
        }else{
            _this.removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            _this.parent().prev().attr('type', 'text');
        }
    });
    //注册同意注册须知
    $('input[name=allow_register]').click(function () {
        if ($(this).prop('checked')){
            $('.register-button').removeClass('disabled');
        }else{
            $('.register-button').addClass('disabled');
        }
    });
    //点击获取验证码进入倒计时
    var isTiming = false;
    $('#sendVerifySmsButton').on('click', function() {
        var _this = $(this);
        var username = $('input[name=username]').val();
        //对手机 电子邮件的验证
        if(mobile_reg.test(username)) {
            isTiming = true;
        }else{
            alert('请输入有效的手机号');
            return false;
        }
        if (isTiming) {
            _this.removeClass('back-color-blue').removeAttr('id');
            $.ajax({
                url     : "/sms/send",
                type    : 'POST',
                data    : {username : username, type:'mobile'},
                dataType   : 'json',
                success : function (data) {
                    toastr.options = {"positionClass":"toast-top-right"};
                    if (data.status == 1) {
                        toastr.success(data.message,'');
                    } else {
                        isTiming = false;
                        toastr.error(data.message,'');
                    }
                }
            });
            //进入倒计时
            if (isTiming){
                var second = 10;
                var that = this;
                $(that).text(second);
                var timer = setInterval(function() {
                    second--;
                    if (second > 0) {
                        $(that).text(second);
                    } else {
                        clearInterval(timer);
                        //isTiming = false
                        isTiming = true;
                        $(that).text("获取验证码");
                        $('.idcode span').css('background-color', '#0063bc');
                    };
                },1000);
            }
        } else {
            //正在计时，返回
            return;
        };
    });
});
