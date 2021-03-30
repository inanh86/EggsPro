jQuery(document).ready(function ($) {
    "use strict";
    //Loader
    $(function preloaderLoad() {
        if ($(".preloader").length) {
            $(".preloader").delay(200).fadeOut(300);
        }
        $(".preloader_disabler").on("click", function () {
            $("#preloader").hide();
        });
    });
    // Menu dropdown
    $(".sub-lv0").hover(
        function () {
            $(this)
                .find(".sub-menu")
                .each(function (e) {
                    if (e === 0) {
                        $(this).addClass("active");
                    }
                });
            $(".sub-lv1").hover(
                function () {
                    $(this).find(".sub-menu").addClass("active");
                },
                function () {
                    $(this).find(".sub-menu").removeClass("active");
                }
            );
        },
        function () {
            $(this)
                .find(".sub-menu")
                .each(function (e) {
                    if (e === 0) {
                        $(this).removeClass("active");
                    }
                });
        }
    );
    // Recent Products Slider
    $(".category-slider").owlCarousel({
        items: 7,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
        ],
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 5,
            },
            1200: {
                margin: 20,
                items: 6,
            },
            1400: {
                margin: 40,
                items: 7,
            },
        },
    });
});
