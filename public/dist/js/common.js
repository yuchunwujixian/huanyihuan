var mobile_reg = /^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[13678]|18\d)\d{8}|170[059]\d{7})$/;
var email_reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/i;
//定位提示信息位置为头部居中
toastr.options = {"positionClass":"toast-top-right"};
//提示消息关闭
$('.tips-del').click(function () {
    $(this).parent().remove()
});
//tooltip
$("[data-toggle='tooltip']").tooltip();
//图片处理，放在自动高度之前
$('img:not(.origin)').on('error', function(){
    var _this = $(this);
    if(_this.attr('data-img-default')){
        _this.attr('src', _this.attr('data-img-default'));
    }
});
//设置子元素中的高度相等 要用定时跑，因为是异步执行的，或者用div=table样式
if($(".same-height").length > 0) {
    setTimeout(function () {
        //元素存在时执行的代码
        $('.same-height').each(function(index,value){
            var _this = $(value);
            var arr = new Array();
            _this.children('div').each(function(i,s){
                arr[i] = $(s).outerHeight();
            });
            // console.log(arr);
            _this.children('div').css('min-height', Math.max.apply(null,arr) + 1);
        });
    }, 600);
}
//提交headers中增加 X-CSRF-TOKEN
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

//select美化
$('.selectpicker').selectpicker({
    wiidth : 'auto'
});

$('input:not(.origin)').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '10%' // optional
});