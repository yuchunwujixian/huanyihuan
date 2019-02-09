$(document).ready(function() {
    // 点击请选择产品出现产品选择界面
    $("#product-name-items").click(function() {
        if ($(this).css("color") === "rgb(0, 100, 188)") {
            $(this).css({color: "#646464"}).next().css({display: "none"})
        } else {
            $(this).css({color: "#0064bc"}).next().css({display: "block"})
        }
    })
})