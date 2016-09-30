<script>
    load_asset("core/custom/tab.css");
    load_asset("jquery.matchHeight-min.js");
    jQuery(function ($) {
        //=== function to check if element existed
        jQuery.fn.exists = function () {
            return this.length > 0;
        };
        jQuery.fn.existNot = function () {
            return this.length == 0;
        };
        /*custom functions*/
        function onResize() {
            //if($('.setFullScreen').exists()){
            var h = $(window).height(), w = $(window).width();
            if (h > 500) {
                $('.setFullScreen').css("min-width", function () {
                    return $(window).width() + "px";
                });
                $('.setFullHeight').css("height", function () {
                    return $(window).height() - $('#navbar').height() + "px";
                });
                $('.setFullHeightHero').css("height", function () {
                    return $(window).height() - 30 - $('#topNav').height() + "px";
                });
                $('.setMinFullHeight').css("min-height", function () {
                    return $(window).height() + "px";
                });
                $('.setFullWidth').css("width", function () {
                    return $(window).width() + "px";
                });
                //stretch bbg image
                $('.bg-image').css("height", function () {
                    return $(window).height() + "px";
                });
                $('.bg-image').css("width", function () {
                    return $(window).width() + "px";
                });
                // setvideo height to screen height
                $('.sliderContentVideo').css("height", function () {
                    //return $(window).height()+"px";
                });
            }
            //$('.main-nav').affix('checkPosition');
        }







        /*=== windows onLoad ===*/
        $(window).ready(function () {

            onResize();
            /*tooltip*/
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            })
            /*animate element when in viewport**/
            $('.hasIntro').viewportChecker({classToAdd: 'slideInUp animated', offset: 0, });
            $('.introSlideUp').viewportChecker({classToAdd: 'slideInUp animated', offset: 50, });
            $('.introSlideDown').viewportChecker({classToAdd: 'slideInDown animated', offset: 50, });
            $('.introSlideRight').viewportChecker({classToAdd: 'slideInRight animated', offset: 50, });
            $('.introSlideLeft').viewportChecker({classToAdd: 'slideInLeft animated', offset: 50, });
            //if ($('.bxslider').exists()){
            setTimeout(function () {
                var contentSlider = $('.sliderContent').bxSlider({
                    slideSelector: '.bx-slide',
                    easing: 'easeInOutQuint',
                    pager: false,
                    auto: false,
                    autoDelay: 1000,
                    infiniteLoop: true,
                    autoControls: false,
                    startSlide: 0,
                    preloadImages: true,
                    adaptiveHeight: true,
                    video: true,
                    //autoHover:true,
                    pause: 7000,
                    //hideControlOnEnd:true,
                    onSliderLoad: function (currentIndex) {
                        // callback
                    },
                    onSlideBefore: function ($slideElement, oldIndex, newIndex) {
                        // callback
                    },
                    onSlideAfter: function ($slideElement, oldIndex, newIndex) {
                        // callback
                    }
                });
                /*=== scroll page on hashtag ===*/
                // Scroll initially if there's a hash (#something) in the url 
                $.localScroll.hash({
                    target: 'body', // Could be a selector or a jQuery object too.
                    queue: true,
                    offset: -30,
                    duration: 1500
                });
                $.localScroll({
                    target: 'body', // could be a selector or a jQuery object too.
                    queue: true,
                    duration: 1000,
                    hash: true,
                    lazy: true,
                    offset: -30,
                    onBefore: function (e, anchor, $target) {
                        // The 'this' is the settings object, can be modified
                    },
                    onAfter: function (anchor, settings) {
                        // The 'this' contains the scrolled element (#content)
                    }
                });


                var bxSlider = $('#testimonialSlider').bxSlider({
                    slideSelector: '.bx-slide',
                    easing: 'easeInOutQuint',
                    pager: false,
                    auto: false,
                    autoDelay: 1000,
                    infiniteLoop: true,
                    autoControls: false,
                    startSlide: 0,
                    preloadImages: true,
                    adaptiveHeight: true,
                    //autoHover:true,
                    pause: 7000,
                    //hideControlOnEnd:true,
                    onSliderLoad: function (currentIndex) {
                        // callback
                    },
                    onSlideBefore: function ($slideElement, oldIndex, newIndex) {
                        // callback
                    },
                    onSlideAfter: function ($slideElement, oldIndex, newIndex) {
                        // callback
                    }
                });

            }, 10);



            /*fitvids - responsive width*/
            $('.page-section').fitVids();
            /*sticky side navigation*/
            $('body').scrollspy({target: "#sideNav", offset: 100});
            $('[data-spy="scroll"]').each(function () {
                var $spy = $(this).scrollspy('refresh')
            });
            $("#sideNav").on("activate.bs.scrollspy", function () {
                var currentItem = $("#sideNav .nav li.active > a").attr('href');
                $('#navbar .nav > li').each(function ($index, $element) {
                    var navAttr = $(this).find(' > a').attr('href');
                    if (navAttr === currentItem) {
                        $(this).first().addClass('active').siblings().removeClass('active');
                        return false;
                    }
                });
            })
            $('#sideNavWrap').height($('#sideNav').outerHeight(true))
            $('#sideNav').affix({
                offset: {
                    top: $('#sideNav').outerHeight(true) - $('#sideNav').offset().top
                }
            });

        });


    });
    $(document).ready(function () {
        // ADD #scrollToTop
        $('.fancybox').fancybox({
            padding: 2
        });
        var defaultPage = "<?= isset($section) ? $section : "" ?>";
        if (defaultPage !== "") {
            setTimeout(function () {
                $("#navbar a[href=" + defaultPage + "]").click()
            }, 300);

        }
        $("#sectionExperts img").on("load", function () {
            $("#sectionExperts .grid-tile").matchHeight();
        });
        setTimeout(function () {
            $("#sectionExperts .grid-tile").matchHeight();
        }, 1000);
        $(function () {
//        $('a[href$=".pdf"]').prop('target', '_blank');
        });
    });

</script>
<!-- twiiter -->
<script>
//    !function (d, s, id) {
//        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
//        if (!d.getElementById(id)) {
//            js = d.createElement(s);
//            js.id = id;
//            js.src = p + "://platform.twitter.com/widgets.js";
//            fjs.parentNode.insertBefore(js, fjs);
//        }
//    }(document, "script", "twitter-wjs");
</script>