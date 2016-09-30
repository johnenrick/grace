<script>
    jQuery(function ($) {
        //=== function to check if element existed
        jQuery.fn.exists = function () {
            return this.length > 0;
        };
        jQuery.fn.existNot = function () {
            return this.length == 0;
        };

        /*===== resize hero to brwosers size =====*/
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


        function onScroll() {
            /*=== toggle scroll-to-top button ===*/
            if ($(window).scrollTop() < $(window).height() / 2) {
                $("#scrollToTop").fadeOut().removeClass('slideInRight');
            } else {
                $("#scrollToTop").fadeIn().addClass('animated slideInRight');
            }
            /*=== toggle menu to FIX ===*/
            if ($(window).scrollTop() > ($('.main-nav').offset().top - $('.main-nav').outerHeight(true))) {
                $(".main-nav").addClass('navbar-fixed-top');
            } else {
                $(".main-nav").removeClass('navbar-fixed-top');
            }
        }
        /*=== on document ready ===*/
        $(document).ready(function() {
            // ADD #scrollToTop
            if($('#scrollToTop').existNot()){
                    $('body').prepend('<a id="scrollToTop" class="animated" href="#top" rel="tooltip-left" title="Scroll to top"><i class="fa fa-angle-up"></i></a>');
            }
            $('#scrollToTop').click(function(e) {
                    e.preventDefault();
                    $('body').scrollTo(0, 800);
            });

            

            // SWITCH THEME
            $('#toggleTheme').on('click',function(e){
                    e.preventDefault();
                    $('body').toggleClass('theme-snow');
            });

            /* set height for main-nav container - used for fix/sticky scrolling */
            //$('#mainNavWrap').height($(".main-nav").height());
            $(".main-nav").on('affixed.bs.affix', function(){
                    $('#mainNavWrap').height($(".main-nav").height());
            });
            $(".main-nav").on('affix-top.bs.affix', function(){
                    $('#mainNavWrap').height('');
            });
        });
        $(window).load(function () {
            
            /*tooltip*/
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
            
            /*check main top nav if scrolled*/
            $('.main-nav').affix({
                offset: {
                    top: $('#topNav').outerHeight(true)
                }
            });
        });
        /*=== smooth screen scroll ===*/
        jQuery.scrollSpeed(100, 600);

        /*===== window resize =====*/
        $(window).resize(onResize);
        $(window).scroll(onScroll);
        onResize(); // first time;
    });
    $(document).ready(function(){
        setTimeout(function(){
            mainContentHeight();
        }, 500);
        
        $( window).resize(function () {
            mainContentHeight();
        });
    });
    function mainContentHeight(){
        var header = $("#topNav").height();
        var footer = $("#footer").height() + $("#footerBar").height();
        var mainContent = (($(window).height() - header - footer)+($("#mainContent").css("margin-bottom").replace("px","")/2));
        
        $("#mainContent").css("min-height", mainContent+25);
    };
</script>