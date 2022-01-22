(function ($) {
    "use strict";

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll > 100) {
            $(".serrvrv").addClass("menu_affix"); // you don't need to add a "." in before your class name
        } else {
            $(".serrvrv").removeClass("menu_affix");
        }
    });

    jQuery("#main-nav").stellarNav({
        breakpoint: 991,
    });

    $(".pgwSlideshow").pgwSlideshow({
        autoSlide: true,
        intervalDuration: 2500,
        //   maxHeight:600,
        displayList: false,
    });

    $("#accordion").on("hide.bs.collapse show.bs.collapse", (e) => {
        $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
    });

    /*--------------------------------------------------------------
        ## Owl Carousel Activated
        --------------------------------------------------------------*/
    $(".slider-wp.owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-chevron-left'></i>",
            "<i class='fa fa-chevron-right'></i>",
        ],
        autoplay: true,
        autoplaySpeed: 2000,
        autoplayTimeout: 6000,
        navSpeed: 1000,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 2,
            },
        },
    });

    //toggle the component with class accordion_body
    $(".accordion_head").click(function () {
        $(this).removeClass("coll-back");
        if ($(".accordion_body").is(":visible")) {
            $(".accordion_body").slideUp(300);
            $(".plusminus").text("+");
            $(this).removeClass("coll-back");
            $(".rmv-cls").removeClass("coll-back");
        }

        if ($(this).next(".accordion_body").is(":visible")) {
            $(this).next(".accordion_body").slideUp(300);
            $(this).children(".plusminus").text("+");
            $(this).removeClass("coll-back");
        } else {
            $(this).next(".accordion_body").slideDown(300);
            $(this).children(".plusminus").text("");
            $(this).children(".plusminus").append('<hr class="hr-clc">');
            $(this).toggleClass("coll-back");
            $(this).addClass("rmv-cls");
        }
    });

    $.scrollUp({
        scrollName: "scrollUp", // Element ID
        topDistance: "300", // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: "fade", // Fade, slide, none
        animationInSpeed: 200, // Animation in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollText: ['<i class="fa fa-chevron-up"></i>'], // Text for element
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });

    // $("select").on("change", function () {
    //     var url = $(this).val();
    //     if (url) {
    //         window.location = url;
    //     }
    //     return false;
    // });
})(jQuery); // End of use strict
