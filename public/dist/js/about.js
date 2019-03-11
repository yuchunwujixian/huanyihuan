$(document).ready(function () {
	$(".feedback-form").validate({
	    rules: {
	        suggestInfo: "required"
	    },
	    messages: {
	        suggestInfo: "请输入信息"
	    }
	});   
})