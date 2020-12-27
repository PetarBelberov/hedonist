var sections_arr = ['services', 'team', 'gallery', 'contacts'];

jQuery(document).ready(function($) {
    $("a[href='#home']").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    })
});

jQuery(document).ready(function($) {
    for (let index = 0; index < sections_arr.length; index++) {
        $('[href*=#' + sections_arr[index] + ']').bind('click', function(e) {
    
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