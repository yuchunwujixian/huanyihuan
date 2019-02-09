$().ready(function () {
    $('.choose-btn').on('click', function() {
        $('.choose-items').toggle()
    })
    var i = 0;  
    var allChoosed = false;  
    function appendTo(that) {
        var itemVal = $(that).text()
        var str = "<span>"
               + itemVal
               + "<i class='iconfont icon-tubiao06'></i>"
               + "</span>"
        $('.choosed').append(str)
    }    
    $('.choose-item').on('click', function() {
        if (allChoosed) {
            $('.choosed span').remove()
            allChoosed = !allChoosed
        }
        var that = this
        if (i < 3) {
            appendTo(that)
            i++
        }
        if (i == 3) {
            $('.choose-items').hide()
        }      
    })
    $('.all-choose').on('click', function() {        
        if (!allChoosed) {
            $('.choosed').children().remove()
            var that = this
            appendTo(that)
            allChoosed = !allChoosed
            i = 0
            $('.choose-items').hide()
        }
    })
    $('.choosed').on('click', 'span', function() {
        $(this).remove()
        i--
        allChoosed = false
    })

    //checkbox 全选/取消全选  
    // var isCheckAll = false;
    // $('#selectAll').on('click', function() {
    //     if (isCheckAll) {
    //         $("input[type='checkbox']").each(function() {
    //             this.checked = false;
    //         });
    //         isCheckAll = false;
    //     } else {
    //         $("input[type='checkbox']").each(function() {
    //             this.checked = true;
    //         });
    //         isCheckAll = true;
    //     }
    // })
})