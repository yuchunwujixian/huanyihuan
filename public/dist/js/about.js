$(document).ready(function () {
	var mySwiper = new Swiper ('.swiper-container', {
		direction: 'horizontal',
		loop: true,   
		// 如果需要前进后退按钮
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev'
	});
	$(".feedback-form").validate({
	    rules: {
	        suggestInfo: "required"
	    },
	    messages: {
	        suggestInfo: "请输入信息"
	    }
	});   
})