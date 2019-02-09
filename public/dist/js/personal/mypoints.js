$(document).ready(function() {
    // 选择支付方式
    var rechargeType = "";
    $(".one-recharge-type").click(function() {
        if (rechargeType !== this.getAttribute("name")) {
            rechargeType = this.getAttribute("name");
            if($(".circle")) {
                $(".circle").removeClass("circle").addClass("circle-o");
            }
            $(this).children("i").removeClass("circle-o").addClass("circle");
        }
    })

    // 点击立即支付按钮
    $("#recharge-btn").click(function() {
        // 此处为处理事件


        return false; // 阻止表单自动提交
    })
})