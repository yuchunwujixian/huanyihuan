$(function () {
    var selectData = {
        mode: []
    },
        title = {
            mode: "前置条件"
        };

    // 前置条件
    $(".mode").click(function () {
        if (selectData.mode[0] !== $(this).html()) {
            selectData.mode[0] = $(this).html();
            $(this).removeClass("square-o").addClass("square").siblings(":gt(0)").removeClass("square").addClass("square-o");
        } else {
            selectData.mode.splice(0, 1);
            $(this).removeClass("square").addClass("square-o");
        }
        renderParameters();
    })

    // 参数删除事件绑定
    $(document).on("click", ".one-parameter", function () {
        var objKey = this.getAttribute("name");            
        if (!objKey) {
            return false;
        }
        var willDeleteData = $(this).children("i").html();
        $(".square." + objKey).each(function () {
            if ($(this).html() === willDeleteData) {
                $(this).removeClass("square").addClass("square-o")
            }
        });
        selectData[objKey].splice(selectData[objKey].indexOf(willDeleteData), 1)
        renderParameters();
    })

    // 重新渲染函数
    function renderParameters() {
        var html = "已选条件：<div class='inline-block parameter-show'><span>类别：</span><span class='one-parameter'>外包供应榜</span></div>"
        for (var key in selectData) {
            if (selectData[key].length > 0) {
                html += "<div class='inline-block parameter-show'>" +
                    "<span>" + title[key] + "：</span>";
                for (var parameter of selectData[key]) {
                    html += "<span class='one-parameter' name=" + key + "><i>" + parameter + "</i> ×</span>";
                }
                html += "</div>"
            }
        }
        $("#parameter-show").html(html)
    }
})