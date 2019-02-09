$(function(){
	// 鼠标在更多上悬浮，展开更多城市
	$('.area-items .more').on('mouseenter', function() {
		$('.select-area-hover').show();
	});
	// 鼠标在更多城市上悬浮，保持更多城市展开
	$('.select-area-hover').on('mouseenter', function() {
		$(this).show();
	});
	// 鼠标离开更多城市，更多城市关闭
	$('.select-area-hover').on('mouseleave', function() {
		$(this).hide();
	});
	// 点击城市，选定
	choosed('.area-item', '.selected-items-area')	
	//鼠标在职位上悬浮，展开更多职位,离开关闭
	// $('.job-item').each(function(i) {
	// 	$(this).mouseenter(function() {
	// 		$($('.items-hover')[i]).css('display', 'block');			
	// 	}).mouseleave(function() {
	// 		$($('.items-hover')[i]).css('display', 'none');
	// 	});
	// });
	//鼠标在更多职位上悬浮，离开关闭
	// $('.items-hover').on('mouseenter', function() {
	// 	$(this).css('display', 'block');
	// }).on('mouseleave', function() {
	// 	$(this).css('display', 'none');
	// });
	choosed('.job-item', '.selected-items-job')
	// choosed('.job-hover-title', '.selected-items-job')

	// 点击薪资，选定
	choosed('.salary-item', '.selected-items-salary')
	//拼接span标签字符串,插入
	function createSpan(className) {
		$(className).append('<span class="selected-item">'
						+ '<i class="selected-item-content"></i>'
						+ '<i class="iconfont icon-tubiao06"></i>'
						+ '</span>')
	};
	//点击性质选定
	choosed('.nature-item', '.selected-items-nature')
	// 点击时间选定
	choosed('.time-item', '.selected-items-time')
	function choosed(ele1, ele2) {
		$(ele1).on('click', function() {
			//判断已选标签是否存在
			if($(ele2).children(' .selected-item').length === 0) {//不存在
				//拼接span标签字符串,插入到p.selected-items-area后
				createSpan(ele2);
				$(ele2).find('.selected-item-content').text($(this).text());
			} else {
				$(ele2).find('.selected-item-content').text($(this).text());
			};
			//显示选定的项
			$(ele2).css('display', 'flex');			
		})	
		$(ele2).on('click', '.selected-item', function() {
			$(this).parent().css('display', 'none')
			$(this).remove();
		});	
	}
});
