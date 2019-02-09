$(document).ready(function () {
    //业务需求
    $('.b-nav-item').each(function(i) {
        $(this).on('click', function() {
            $(this).siblings().removeClass('b-nav-active')
            $(this).addClass('b-nav-active')
            $('.business-requirement').hide()
            $($('.business-requirement')[i]).show()
        })
    })

    // 公司环境
    var swiper = new Swiper('#company-enviroment', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 3,
        loop: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        coverflow: {
            rotate: 0,
            stretch: 0,
            depth: 150,
            modifier: 1,
            slideShadows : false
        }
    });
    
})