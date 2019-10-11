get_profile();
update_contacts();
load_message();

//-------------------------------------------------> profile <-------------------------------------------------\\

$(".profile .case #submit-app").click(function (e) {
    e.preventDefault;
    
    var new_pseudo = encodeURIComponent($(".profile .case #pseudo").val());
    var new_email = encodeURIComponent($(".profile .case #email").val());
    var new_password = encodeURIComponent($(".profile .case #password").val());

    $.ajax({
        url: "php/edit-profile.php",
        type: "post",
        data: "pseudo=" + new_pseudo + "&email=" + new_email + "&password=" + new_password,
        success: function (data) {

            if (data == "[]") {
                
                $(".profile .case #pseudo, .profile .case #email, .profile .case #password").val("");
                $(".profile .case #pseudo").attr("placeholder", "pseudo");
                $(".profile .case #email").attr("placeholder", "email");
                $(".profile .case .errors").css("display", "none");
                
                get_profile();
            } else {

                $(".profile .case .errors").empty();
                $(".profile .case .errors").css("display", "block");

                JSON.parse(data, (key, value) => {

                    (value.constructor === String) && $(".profile .case .errors").append("<br/>" + value);
                })
            }
        }
    })
})

$(".profile .case #submit-sup").click(function (e) {
    e.preventDefault();
    
    $.ajax({
        url: "php/sup-profile.php",
        success: function (data) {

            déconnexion();
        }
    })
})

//-------------------------------------------------> contacts <-------------------------------------------------\\

$(".contacts .case #submit-add").click(function (e) {
    e.preventDefault;
    
    var pseudo = encodeURIComponent($(".contacts .case #new-contact").val());

    $.ajax({
        url: "php/add-contact.php",
        type: "post",
        data: "pseudo=" + pseudo,
        success: function (data) {

            $(".contacts .case #new-contact").val("");

            if (data == "[]") {
                
                update_contacts();

                $(".contacts .case .errors").css("display", "none");
            } else {

                $(".contacts .case .errors").empty();
                $(".contacts .case .errors").css("display", "block");

                JSON.parse(data, (key, value) => {

                    (value.constructor === String) && $(".contacts .case .errors").append("<br/>" + value);
                })
            }
        }
    })
})

$(".contacts .case #submit-sup").click(function (e) {
    e.preventDefault();

    var contacts = [];
    var contacts_number = 0;

    $(".contacts .case .checkbox:checked").each(function () {
        contacts[contacts_number] = encodeURIComponent($(this).parent().find("span").html());
        contacts_number++;
    })

    $.ajax({
        url: "php/sup-contacts.php",
        type: "post",
        data: "contacts=" + JSON.stringify(contacts),
        success: function (data) {

            if (data == "[]") {

                update_contacts();

                $(".contacts .case .errors").css("display", "none");
            } else {

                $(".contacts .case .errors").empty();
                $(".contacts .case .errors").css("display", "block");

                JSON.parse(data, (key, value) => {

                    (value.constructor === String) && $(".contacts .case .errors").append("<br/>" + value);
                })
            }
        }
    })
})

//-------------------------------------------------> profile function <-------------------------------------------------\\

function get_profile () {

    var get_pseudo;
    var get_email;

    $.ajax({
        url: "php/get-profile.php",
        success: function (data) {

            JSON.parse(data, (key, value) => {
                
                if (key == "pseudo") get_pseudo = value;
                if (key == "email") get_email  = value;
            })

            $(".profile .case #pseudo").attr("placeholder", get_pseudo);
            $(".profile .case #email").attr("placeholder", get_email);
        }
    })
}

//-------------------------------------------------> contacts function <-------------------------------------------------\\

function update_contacts () {

    $.ajax({
        url: "php/update-contacts.php",
        success: function (data) {

            var id = 0;

            $(".contacts .case .contacts").empty();

            if (data != "[]") {

                JSON.parse(data, (key, value) => {
                    
                    (value.constructor === String) && $(".contacts .case .contacts").append('<div class="contact"><input class="checkbox" id="' + id + '" type="checkbox" /><label for="' + id + '"></label><span>' + value + '</span></div>');
                    id++;
                })
            }
        }
    })
}