$.validator.setDefaults({
    submitHandler: function () {
        alert("提交事件!");
    }
});
$().ready(function () {
    // 在键盘按下并释放及提交后验证提交表单
    $("#signupForm").validate({
        rules: {
            company_name: "required",
            company_url: {
                required: true,
                url: true
            },
            company_person: "required",
            company_phone: {
                required: true,
                minlength: 7,
                maxlength: 12
            },
            company_address: "required"
        },
        messages: {
            company_name: "请输入公司名称",
            company_url: "请输入公司官网",
            company_person: "请输入联系人姓名",
            company_phone: {
                required: "请输入公司电话",
                minlength: "请输入正确的电话",
                maxlength: "请输入正确的电话"
            },
            company_address: "请输入公司地址"
        }
    });
});