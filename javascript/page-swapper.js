$(function(){

    $.ajax({
        url: "php/load-page.php",
        success: function (data) {

            if (data == "profile") {

                swap_page(data);
                $("#connexion, #inscription").css("display", "none");
                $("#profile, #tchat, #déconnexion").css("display", "inline");
            } else if (data == "accueil") {

                swap_page("accueil");
                $("#connexion, #inscription").css("display", "inline");
                $("#profile, #tchat, #déconnexion").css("display", "none");
            }
        }
    })

    $(".top li").click(function(){swap_page($(this).attr("id"));})
})

function swap_page (name) {

    if (name != "déconnexion") {
        
        $.ajax({
            url: "html/" + name + ".htm",
            success: function (html) {

                $(".body").empty();
                $(".body").append(html);
            }
        })
    }
}