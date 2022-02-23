$(document).ready(function () {

    // $('.carousel').carousel({
    //     interval: false,
    // });

    $(document).on('click', '.arrow-collapse', function () {
        $('.main-row').slideToggle();
    });

    $(document).on('click', '#next-cate', function () {
        $(`.mobDiv`).hide();
        var i = $('.carousel-item.active').index();
        // console.log(i);
        $('.mobDiv').eq(i == 2 ? i = 0 : ++i).show();
    });

    // start-nav
    $(document).on('click', '#prev-cate', function () {
        $(`.mobDiv`).hide();
        var i = $('.carousel-item.active').index();
        // console.log(i);
        $('.mobDiv').eq(--i).show();
    });
    // end-nav

    // start-size-active
    $('.effect.size.to60').click(function () {
        $('.hide-size-chk').hide();
        $('.size-check1').show();
        $('.prev-foam-design, .next-foam-design').removeClass('prev-next-design-p');
    });
    $('.effect.size.to120').click(function () {
        $('.hide-size-chk').hide();
        $('.size-check2').show();
        $('.prev-foam-design, .next-foam-design').addClass('prev-next-design-p');
    });
    // end-size-active

    // start-color-select
    $(document).on('click', '.design-circle', function () {
        if ($(window).width() <= 576) {
            $('.design-circle').parent().find('span.color-active-1').remove();
            $('.design-circle').removeClass('active-clr-round');
            $(this).addClass('active-clr-round');
            $(this).parent().prepend('<span class="color-active-1"><i class="far fa-check-circle"></i></span>');
        }
    });

    $(document).on('click', '.active-foam-div', function () {
        if ($(window).width() <= 576) {
            $('.active-foam-div').removeClass('active-foam');
            $('.active-foam-div').find('span.foam-active-1').remove();
            $(this).prepend('<span class="foam-active-1"><i class="far fa-check-circle"></i></span>');
        }
    });
    // end-color-select

    var scrolled = 0;
    $(document).on('click', '.next-foam-design', function () {
        scrolled = scrolled + 319;
        $(".design-opt .card").animate({
            scrollLeft: scrolled
        }, "fast");
    });

    $(document).on('click', '.prev-foam-design', function () {
        scrolled = scrolled - 319;
        $(".design-opt .card").animate({
            scrollLeft: scrolled
        }, "fast");
    });

    // $(".next-foam-design").click(function(){
    //     alert($(".design-opt .card").scrollLeft() + " px");
    // });



    // $(document).on('click','#next-cate',function(){
    //     let navdata = $('.menu-h2 .active').data('nav');
    //     if(navdata == 'size'){
    //         $('.size-opt').show();            
    //     }
    // });

});