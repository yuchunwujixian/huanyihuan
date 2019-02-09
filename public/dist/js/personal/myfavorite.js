$(document).ready(function () {
    $('.add-btn').on('click',function() {
        $('.add-form input').val('')
        $('.add-form textarea').val('')
        $(this).hide().siblings().show()
    })
    $('.fav-nav li').each(function(i) {
        $(this).on('click', function() {
            $(this).addClass('f-nav-active').siblings().removeClass('f-nav-active')
            $($('.fav-table')[i]).css('display', 'block').siblings('.fav-table').css('display', 'none')
        })
    })
    $('.oprate-btn').on('click', function() {
        $(this).parent().remove()
    })
    $('.edit-btn').on('click', function() {
        $('.add-btn').hide().siblings().show()
        $('.add-form input').val($(this).siblings('.fav-title').text())
        $('.add-form textarea').val($(this).siblings('.fav-info').text())
        $(this).parent().remove()
    })
    // 在键盘按下并释放及提交后验证提交表单
    $("#add-form1").validate({
        rules: {
            company_name: "required"
        },
        messages: {
            company_name: "请输入公司名称"
        }
    })
    $("#add-form2").validate({
        rules: {
            game_name: "required"
        },
        messages: {
            game_name: "请输入公司名称"
        }
    })
})