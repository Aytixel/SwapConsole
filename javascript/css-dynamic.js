$(function(){
    css_media();

    $(window).resize(function(){css_media();})

    function css_media () {
        $(".body").css("height", $(window).height()-76+"px");
    } 
})