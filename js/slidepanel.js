(function($) {
    $('#toggle').toggle(
        function() {
            $('#toggle').html('<i class="fa fa-close"></i>');
            $('#popout').animate({ left: 0 }, 'linear');
            $('#popout-2').animate({ right: 0 }, 'linear');
        },
        function() {
            $('#toggle').html('<img src='+ url_custom.template_url + "/images/menu.png" + '>');
            $('#popout-2').animate({ right: -500 }, 'linear');
            $('#popout').animate({ left: -500 }, 'linear');
        },
    );
    $('#primary-menu li a').click(function(){
        $('#popout-2').animate({ right: -500 }, 'linear');
        $('#popout').animate({ left: -500 }, 'linear');
        $('#toggle').trigger('click');
    });
    $('#popout-2').click(function(){
        $('#toggle').html('<img src='+ url_custom.template_url + "/images/menu.png" + '>');
        $('#popout-2').animate({ right: -500 }, 'linear');
        $('#popout').animate({ left: -500 }, 'linear');
        $('#toggle').trigger('click');
    });
})(jQuery);
