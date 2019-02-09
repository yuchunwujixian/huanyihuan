$().ready(function () {
    var isShowErr = false,
        data = {
            positionName: "",
            positionType: "",
            positionProperty: "",
            salary: {
                min: "",
                max: ""
            },
            experience: "",
            education: "",
            welfare: [],
            positionPlace: "",
            positionContent: "",
            positionRequire: ""
        }
    // 设置选择框的默认选项
    $("#positionType").val("请选择").css({color: "#a9a9a9"});
    $("#positionProperty").val("请选择").css({color: "#a9a9a9"});
    $("#experience").val("请选择").css({color: "#a9a9a9"});
    $("#education").val("请选择").css({color: "#a9a9a9"});

    // 发布职位名称填写
    $("#positionName").keyup(function() {
        if ($(this).val() === "") {
            data.positionName = $(this).val()
            if (isShowErr) {
                $(this).next().css({display: "block"})
            }
        } else {
            data.positionName = $(this).val()
            $(this).next().css({display: "none"})
        }
    })

    // 职业分类
    $("#positionType").change(function() {
        data.positionType = $(this).val();
        this.style.color = "#373737";
        if (data.positionType.length > 0) {
            $(this).next().css({display: "none"});
        }
    })

    // 职业性质
    $("#positionProperty").change(function() {
        data.positionProperty = $(this).val();
        $(this).css({color: "#373737"});
        if (data.positionProperty.length > 0) {
            $(this).next().css({display: "none"});
        }
    })

    // 薪资范围
    $(".salary").keyup(function() {
        if ($(this).val() === "") {
            data.salary[this.getAttribute("name")] = "";
            if (isShowErr) {
                $(this).parent().next().css({display: "block"})
            }
        } else {
            data.salary[this.getAttribute("name")] = $(this).val()
            if (data.salary.min !== "" &&
                data.salary.max !== "" &&
                Number(data.salary.max) > Number(data.salary.min)) {
                $(this).parent().next().css({display: "none"})
            } else {
                if (isShowErr) {
                    $(this).parent().next().css({display: "block"})
                }
            }
        }
    })

    // 经验要求
    $("#experience").change(function() {
        data.experience = $(this).val();
        this.style.color = "#373737";
        if (data.experience.length > 0) {
            $(this).next().css({display: "none"});
        }
    })

    // 学历要求
    $("#education").change(function() {
        data.education = $(this).val();
        $(this).css({color: "#373737"});
        if (data.education.length > 0) {
            $(this).next().css({display: "none"});
        }
    })

    // 福利待遇
    $(".welfare").click(function() {
        var index = data.welfare.indexOf($(this).html());
        if (index === -1) {
            data.welfare.push($(this).html())
            $(this).removeClass("square-o").addClass("square");
        } else {
            data.welfare.splice(index, 1)
            $(this).removeClass("square").addClass("square-o");
        }
        if (data.welfare.length === 0) {
            if (isShowErr) {
                $(this).parent().next().css({display: "block"});
            }
        } else {
            $(this).parent().next().css({display: "none"});
        }
    })

    // 工作地点
    $("#positionPlace").keyup(function() {
        if ($(this).val === "") {
            data.positionPlace = "";
            if (isShowErr) {
                $(this).next().css({display: "block"});
            }
        } else {
            data.positionPlace = $(this).val();
            $(this).next().css({display: "none"});
        }
    })

    // 工作内容
    $("#positionContent").keyup(function() {
        if ($(this).val === "") {
            data.positionContent = "";
            if (isShowErr) {
                $(this).next().css({display: "block"});
            }
        } else {
            data.positionContent = $(this).val();
            $(this).next().css({display: "none"});
        }
    })

    // 任职要求
    $("#positionRequire").keyup(function() {
        if ($(this).val === "") {
            data.positionRequire = "";
            if (isShowErr) {
                $(this).next().css({display: "block"});
            }
        } else {
            data.positionRequire = $(this).val();
            $(this).next().css({display: "none"});
        }
    })

    $("#submit-form").click(function() {
        isShowErr = true;
        var isSubmit = true; // 是否提交
        for (var key in data) {
            console.log(key)
            if (key !== "salary") {
                console.log()
                if (data[key].length === 0) {
                    $("#"+key).next().css({display: "block"});
                    isSubmit = false;
                } else {
                    $("#"+key).next().css({display: "none"});
                }
            } else {
                if (data.salary.min !== "" &&
                    data.salary.max !== "" &&
                    Number(data.salary.max) > Number(data.salary.min)) {
                    $("#salary").next().css({display: "none"})
                } else {
                    console.log(1111111111111)
                    console.log($("#salary").next())
                    $("#salary").next().css({display: "block"})
                }
            }
        }
        if (isShowErr) {
            // AJAX请求
        }
    })
})