$(document).ready(function() {

    let settingContent = false; // 是否显示设置内容

    $("#user-setting").click(function() {
        if (settingContent) {
            $("#user-setting-content").css({display: "none"})
            settingContent = false
        } else {
            $("#user-setting-content").css({display: "block"})
             settingContent = true
        }
    })

    // 点击内部任意一个子内容都会关闭该标签
    $(".one-setting").click(function() {
        settingContent = false;
        $(this).parent().css({display: "none"})
    });

    $('.tips-del').click(function () {
        $(this).parent().remove()
    })







})