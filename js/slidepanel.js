jQuery(document).ready(function($){
    $('#toggle').click(
        function(e) {
            e.stopPropagation();
            $("#toggle").toggleClass("collapsed");

            $("#popout").toggleClass("show");
            $('#popout').css("transition","all 1s");

            $("#popout-2").toggleClass("show");
            $('#popout-2').css("transition","all 1s");
        }
    );
});