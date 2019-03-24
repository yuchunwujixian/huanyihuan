$(function(){
	$('.password-eye').click(function () {
		var _this = $(this);
		if (_this.hasClass('glyphicon-eye-open')){
            _this.removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            _this.parent().prev().attr('type', 'password');
		}else{
            _this.removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            _this.parent().prev().attr('type', 'text');
		}
    })
	
});
