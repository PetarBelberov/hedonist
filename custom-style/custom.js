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

jQuery(document).ready(function($) {
    $(window).scroll(function () {
        var scrollDistance = $(window).scrollTop();

        // Show/hide menu on scroll
        //if (scrollDistance >= 850) {
        //		$('nav').fadeIn("fast");
        //} else {
        //		$('nav').fadeOut("fast");
        //}

        // Assign active class to nav links while scolling
        $('.page-section').each(function (i) {
            if ($(this).position().top <= scrollDistance) {
                $('.navigation a.active').removeClass('active');
                $('.navigation a').eq(i).addClass('active');
            }
        });
    }).scroll();
});

// jQuery(document).ready(function($) {
// window.onscroll = function() {myFunction()};
//
// var navbar = document.getElementById("masthead");
// var sticky = navbar.offsetTop;
//     // $("#masthead").css({"display": "none", "visibility": "hidden"});
//
// function myFunction() {
//     // $("#masthead").css({"display": "all", "visibility": "visible"});
//     if (window.pageYOffset >= sticky) {
//         navbar.classList.add("sticky");
//         // $('#masthead').addClass("sticky");
//         // $('#masthead').fadeOut(0.2);
//         // $('#masthead').css("height","65px");
//         // $('#masthead').css("top","0px");
//
//     } else {
//         $('#masthead').removeClass('sticky');
//         // $('#masthead').fadeIn(0.5);
//         // $('#toggle').css("top","19px");
//         // $('#masthead').css("height","105px");
//         // $('#masthead').css("top","0px");
//
//     }
// }
// });

jQuery(document).ready(function( $ ) {
    // $("#masthead").css({"display": "none", "visibility": "none"});
    // Header fixed and Back to top button
    $(window).scroll(function()        {
        // $("#masthead").css({"display": "all", "visibility": "visible"});
        // $('#masthead').offset().top
        if ($(this).scrollTop() >= 120) {
            // $('.sticky').fadeIn(3000);
            // $('#masthead').fadeIn('slow');
            // $('#masthead').fadeOut('slow');
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
            // $('#masthead').fadeOut('slow');
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