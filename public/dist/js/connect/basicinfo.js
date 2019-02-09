$.validator.setDefaults({
    submitHandler: function () {
        alert("提交事件!");
    }
});
$().ready(function () {
    // 在键盘按下并释放及提交后验证提交表单
    $("#signupForm").validate({
        rules: {
            user_name: "required",
            user_department: "required",
            user_duties: "required",
            user_eare: "required",
            user_thing: "required"
        },
        messages: {
            user_name: "请输入姓名",
            user_department: "请输入部门",
            user_duties: "请输入职务",
            user_eare: "请输入负责区域",
            user_thing: "请输入负责事宜"
        }
    });
});