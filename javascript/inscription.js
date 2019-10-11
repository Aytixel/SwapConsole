$(".inscription .case #submit").click(function(e){
    e.preventDefault;
    
    var pseudo = encodeURIComponent($("#pseudo").val());
    var email = encodeURIComponent($("#email").val());
    var password1 = encodeURIComponent($("#password1").val());
    var password2 = encodeURIComponent($("#password2").val());

    $.ajax({
        url: "php/inscription.php",
        type: "post",
        data: "pseudo=" + pseudo + "&email=" + email + "&password1=" + password1 + "&password2=" + password2,
        success: function(data) {

            if (data == "[]") {

                $("#connexion, #inscription").css("display", "none");
                $("#déconnexion, #profile, #tchat").css("display", "inline");
                
                swap_page("profile");
            } else {

                $(".inscription .case .errors").empty();
                $(".inscription .case .errors").css("display", "block");

                JSON.parse(data, (key, value) => {
                    
                    (value.constructor === String) && $(".inscription .case .errors").append("<br/>" + value);
                })
            }
        }
    })
})