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
    //点击获取验证码进入倒计时
    var isTiming = false;
    $('#sendVerifySmsButton').on('click', function() {
        var _this = $(this);
        var username = $('input[name=username]').val();
        //对手机 电子邮件的验证
        if(mobile_reg.test(username) || email_reg.test(username)) {
            isTiming = true;
        }else{
            toastr.error('请输入有效的账号');
            return false;
        }
        if (isTiming) {
            _this.removeClass('back-color-blue').addClass('disabled');
            $.ajax({
                url     : "/sms/send",
                type    : 'POST',
                data    : {username : username, type:2},
                dataType   : 'json',
                success : function (data) {
                    if (data.status == 1) {
                        toastr.success(data.message,'');
                        //进入倒计时
                        var second = 60;
                        _this.text(second);
                        var timer = setInterval(function() {
                            second--;
                            if (second > 0) {
                                _this.text(second);
                            } else {
                                clearInterval(timer);
                                isTiming = false;
                                _this.text("重新获取").removeClass('disabled').addClass('back-color-blue');
                            };
                        },1000);
                    } else {
                        _this.addClass('back-color-blue').removeClass('disabled');
                        toastr.error(data.message,'');
                    }
                }
            });
        }
    });
});
