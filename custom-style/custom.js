jQuery(document).ready(function($) {
    $("a[href='#1']").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    })
});


jQuery(document).ready(function($) {
    for (var i = 2; i <= 5; i++) {
        $('[href*=#'+ i + ']').bind('click', function(e) {
            e.preventDefault(); // prevent hard jump, the default behavior
            var target = $(this).attr("href"); // Set the target as variable

            // perform animated scrolling by getting top-position of target-element and set it as scroll target
            $('html, body').stop().animate({
                scrollTop: $(target).offset().top
            }, 600, function() {
                location.hash = ''; //remove the hash (#jumptarget) to the page url
            });

            return false;
        });
    }

});

// Trigger popup modal using (Modal ID) from url
jQuery(document).ready(function($) {
      if(window.location.hash) {
          var hash = window.location.hash;
          $(hash).modal('toggle');
      }
  });

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