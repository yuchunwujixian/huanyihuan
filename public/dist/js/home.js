$(function(){
	var imgSrc = {
		'mouseleave': ['img/need_icon-1.png','img/company_icon-1.png','img/product_icon1.png'],
		'mouseenter': ['img/need_icon2.png','img/company_icon2.png','img/product_icon2.png']
	}
	$('.submit-info-wrapper a').each(function(i) {
		this.onmouseleave = function() {
			$(this).children('img').attr('src', imgSrc.mouseleave[i]);
		};
		this.onmouseenter = function() {
			$(this).children('img').attr('src', imgSrc.mouseenter[i]);
		};
	});
	var mySwiper = new Swiper ('.swiper-container', {
		direction: 'horizontal',
		loop: true,
		autoplay: 5000
	});
	// 点击搜索手动跳转到搜索页
	$('.search').on('click', function() {
		if ($('.search-wrapper input').val() === '') {
			return;
		} else {
			window.location.href = "../pages/search/search_company.html";			
		}
	});	
	//浮动图效果
	$('.list li').on('mouseenter', function() {
		$(this).siblings().children('.detail').hide();
		$(this).siblings().children('.text').show();
		$(this).children('.text').hide();
		$(this).children('.detail').show();
	});
});
