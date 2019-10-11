$(".get-password .case #submit").click(function(e){
    e.preventDefault();
    
    var email = encodeURIComponent($("#email").val());

    $.ajax({
        url: "php/get-password.php",
        type: "post",
        data: "email=" + email,
        success: function(data) {

            if (data == "[]") swap_page("connexion");
            else {

                $(".get-password .case .errors").empty();
                $(".get-password .case .errors").css("display", "block");

                JSON.parse(data, (key, value) => {

                    (value.constructor === String) && $(".get-password .case .errors").append("<br/>" + value);
                })
            }
        }
    })
})