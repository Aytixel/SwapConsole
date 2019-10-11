$(".connexion .case #submit").click(function(e){
    
    var username = encodeURIComponent($("#username").val());
    var password = encodeURIComponent($("#password").val());

    $.ajax({
        url: "php/connexion.php",
        type: "post",
        data: "username=" + username + "&password=" + password,
        success: function(data) {

            if (data == "[]") {

                $("#connexion, #inscription").css("display", "none");
                $("#déconnexion, #profile, #tchat").css("display", "inline");
                
                swap_page("profile");
            } else {

                $(".connexion .case .errors").empty();
                $(".connexion .case .errors").css("display", "block");

                JSON.parse(data, (key, value) => {

                    (value.constructor === String) && $(".connexion .case .errors").append("<br/>" + value);
                })
            }
        }
    })
})

$(".connexion .case #submit-password").click(function(e){
    e.preventDefault();

    swap_page("get-password");
})