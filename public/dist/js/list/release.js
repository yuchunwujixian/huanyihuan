$(function () {
    var selectData = {
        platform: [],
        distinguish: [],
        gametype: [],
        mode: [],
        need: [],
        region: []
    },
        title = {
            platform: "平台",
            distinguish: "区分",
            gametype: "游戏分类",
            mode: "合作方式",
            need: "需求",
            region: "地区"
        };

    // 平台参数添加事件
    $(".platform").click(function () {
        if (selectData.platform.indexOf($(this).html()) === -1) {
            selectData.platform.push($(this).html());
            $(this).removeClass("square-o").addClass("square");
        } else {
            selectData.platform.splice(selectData.platform.indexOf($(this).html()), 1);
            $(this).removeClass("square").addClass("square-o");
        }
        renderParameters();
    })

    // 区分添加事件
    $(".distinguish").click(function () {
        if (selectData.distinguish.indexOf($(this).html()) === -1) {
            selectData.distinguish.push($(this).html());
            $(this).removeClass("square-o").addClass("square");
        } else {
            selectData.distinguish.splice(selectData.distinguish.indexOf($(this).html()), 1);
            $(this).removeClass("square").addClass("square-o");
        }
        renderParameters();
    })

    // 游戏分类添加事件
    $(".gametype").click(function () {
        if (selectData.gametype.indexOf($(this).html()) === -1) {
            selectData.gametype.push($(this).html());
            $(this).removeClass("square-o").addClass("square");
        } else {
            selectData.gametype.splice(selectData.gametype.indexOf($(this).html()), 1);
            $(this).removeClass("square").addClass("square-o")
        }
        renderParameters();
    })

    // 游戏分类和地区 更多实现
    $(".gametype-more").click(function () {
        if ($(this).next().css("display") === "none") {
            $(this).css({color: "#0064bc"}).next().css({ display: "block" });
        } else {
            $(this).css({color: "#4d4d4d"}).next().css({ display: "none" });
        }
    })

    // 地区参数添加事件
    $(".region").click(function () {
        if (selectData.region[0] !== $(this).html()) {
            selectData.region[0] = $(this).html();
            $(".region").removeClass("square").addClass("square-o")
            $(this).removeClass("square-o").addClass("square");
        } else {
            selectData.region.splice(0, 1);
            $(this).removeClass("square").addClass("square-o");
        }
        renderParameters();
    })

    // 合作方式参数添加事件
    $(".mode").click(function () {
        if (selectData.mode[0] !== $(this).html()) {
            selectData.mode[0] = $(this).html();
            $(this).removeClass("square-o").addClass("square").siblings(":gt(0)").removeClass("square").addClass("square-o");
        } else {
            selectData.mode.splice(0, 1);
            $(this).removeClass("square-o").addClass("square").siblings(":gt(0)").removeClass("square").addClass("square-o");
        }
        renderParameters();
    })

    // 需求参数添加事件
    $(".need").click(function () {
        if (selectData.need.indexOf($(this).html()) === -1) {
            selectData.need.push($(this).html());
            $(this).removeClass("square-o").addClass("square");
        } else {
            selectData.need.splice(selectData.need.indexOf($(this).html()), 1);
            $(this).removeClass("square").addClass("square-o");
        }
        renderParameters();
    })

    // 参数删除事件绑定
    $(document).on("click", ".one-parameter", function () {
        var objKey = this.getAttribute("name"),
            willDeleteData = $(this).children("i") ? $(this).children("i").html() : $(this).html();
        // 删除单选选中标签（无标记）
        if (["stage", "gametype", "region", "distinguish", "platform", "need", "mode"].indexOf(objKey) > -1) {
            // 删除多选选中标签(方块形标记)
            $(".square." + objKey).each(function () {
                if ($(this).html() === willDeleteData) {
                    $(this).removeClass("square").addClass("square-o")
                }
            });
        }
        selectData[objKey].splice(selectData[objKey].indexOf(willDeleteData), 1)
        renderParameters();
    })

    // 重新渲染函数
    function renderParameters() {
        var html = "已选条件："
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