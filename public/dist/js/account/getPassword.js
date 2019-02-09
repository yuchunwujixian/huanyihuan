$(function(){
	//	是否显示密码
	$('.inputWrapper>.fr').click(function() {
		var imgSrc = $(this).attr('src');
		if (imgSrc === '../../img/notshow.png') {
			$(this).attr('src', '../../img/show.png').siblings('input').attr('type', 'text');			
		} else if(imgSrc === '../../img/show.png'){
			$(this).attr('src', '../../img/notshow.png').siblings('input').attr('type', 'password');
		}		
	});
	//点击获取验证码进入倒计时
	var isTiming = true;
	$('.idcode span').on('click', function() {
		if (isTiming) {
			//isTiming = true
			isTiming = false;			
			//进入倒计时
			var second = 60;
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
				};
			},1000);
		} else {
			//正在计时，返回
			return;
		};		
	});
});
