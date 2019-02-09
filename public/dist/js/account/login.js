$(function(){
	//	是否显示密码
	$('.inputWrapper>.fr').click(function() {
		var imgSrc = $(this).attr('src');
		if (imgSrc === '../../img/notshow.png') {
			$(this).attr('src', '../../img/show.png').siblings('input').attr('type', 'text');			
		} else if(imgSrc === '../../img/show.png'){
			$(this).attr('src', '../../img/notshow.png').siblings('input').attr('type', 'password');
		}		
	})
	//  是否记住密码，默认状态下不记住密码
	var isRemember = false;
	$('.rememberPassword').click(function() {
		//isRemember为true时，点击后变为不记住密码
		if (isRemember === true) {
			//从localstorage移出账号密码信息 !?	
			$(this).siblings('.choose').removeClass('remembered').addClass('notRemember');
		} else if(isRemember === false){//isRemember为false时，点击后变为记住密码
			//账号密码信息存入localstorage !?
			$(this).siblings('.choose').removeClass('notRemember').addClass('remembered');
		}
		isRemember = !isRemember;
	})
	
});
