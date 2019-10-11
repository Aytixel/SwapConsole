$("#déconnexion").click(function(e){déconnexion();})

function déconnexion () {
    
    $.ajax({
        url: "php/déconnexion.php",
        success: function (data) {

            $("#connexion, #inscription").css("display", "inline");
            $("#déconnexion, #profile, #tchat").css("display", "none");
            
            swap_page("accueil");
        }
    })
}