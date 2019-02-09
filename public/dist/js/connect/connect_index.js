$(function () {
    var selectData = {
        type: [],
        region: []
    },
        title = {
            type: "类型",
            region: "地区"
        },
        projectType = "";
        
    // 阶段参数添加事件
    $(".project-type").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        if (projectType !== this.getAttribute("name")) {
            projectType = this.getAttribute("name");
            $("#projct-children").css({display: "block"}).children("#"+projectType).css({display: "block"}).siblings().css({display: "none"})
        }
    })

    // 地区参数添加事件
    $(".type").click(function () {
        $(".type").removeClass("active");
        $(this).addClass("active");
        if (selectData.type[0] !== this.innerText) {
            selectData.type[0] = this.innerText;
            renderParameters();
        }
    })

    // 地区参数添加事件
    $(".region").click(function () {
        $(".region").removeClass("active");
        $(this).addClass("active");
        if (selectData.region[0] !== this.innerText) {
            selectData.region[0] = this.innerText;
            renderParameters();
        }
    })

    // 地区点击更多实现
    $(".gametype-more").click(function () {
        if ($(this).next().css("display") === "none") {
            $(this).css({color: "#0064bc"}).next().css({ display: "block" });
        } else {
            $(this).css({color: "#4d4d4d"}).next().css({ display: "none" });
        }
    })

    // 参数删除事件绑定
    $(document).on("click", ".one-parameter", function () {
        var objKey = this.getAttribute("name"),
            willDeleteData = $(this).children("i") ? $(this).children("i").html() : $(this).html();
            $(".active." + objKey).each(function () {
                if ($(this).html() === willDeleteData) {
                    $(this).removeClass("active")
                }
            });
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
            }
        }
        $("#parameter-show").html(html)
    }
})