jQuery(document).ready(function($) {
    $(window).scroll(function () {
        var scrollDistance = $(window).scrollTop();

        // Assign active class to nav links while scolling
        $('.page-section').each(function (i) {
            if ($(this).position().top <= scrollDistance) {
                $('.navigation a.active').removeClass('active');
                $('.navigation a').eq(i).addClass('active');
            }
        });
    }).scroll();
});

jQuery(document).ready(function( $ ) {
    // Header fixed and Back to top button
    $(window).scroll(function()        {
        if ($(this).scrollTop() >= 120) {
            $('#masthead').css("height","70px");
            $('#masthead').css("padding","7px 0px");
            $('#masthead').addClass('sticky');
            $('#masthead').css("position","fixed");
        }
        else {
            $('#masthead').css("padding","0px 0px");
            $('#masthead').css("height","64px");
            $('#masthead').removeClass('sticky');
            $('#masthead').css("position","absolute");
        }
    });
});

// Trigger CSS animations on scroll.

jQuery(document).ready(function( $ ) {
  
    // Function which adds the 'animated' class to any '.animatable' in view
    var do_animations = function() {
      
        // Calc current offset and get all animatables
        var offset = $(window).scrollTop() + $(window).height();
        var animatables = $('.animatable');
        
        // Unbind scroll handler if we have no animatables
        if (animatables.length == 0) {
            $(window).off('scroll', do_animations);
        }
        
        // Check all animatables and animate them if necessary
        animatables.each(function(i) {
            animatables = $(this);
                if ((animatables.offset().top + animatables.height() - 20) < offset) {
                animatables.removeClass('animatable').addClass('animated');
                }
                else if (animatables.offset().top) {
                    ($('.slider-container')).removeClass('animatable').addClass('animated');
                }     
        });
      };
    
    // Hook doAnimations on scroll, and trigger a scroll
    $(window).bind('scroll load', do_animations);
  });