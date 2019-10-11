$(".tchat .case #submit").click(function (e) {
    e.preventDefault;
    
    var message = encodeURIComponent($(".tchat .case .message").val());
    var des = [];
    var des_number = 0;

    $(".tchat .case .checkbox:checked").each(function () {
        des[des_number] = encodeURIComponent($(this).parent().find("span").html());
        des_number++;
    })

    $.ajax({
        url: "php/post-message.php",
        type: "post",
        data: "message=" + message + "&des=" + JSON.stringify(des),
        success: function (data) {
            
            if (data == "[]") {

                $(".tchat .case .message").val("");
                $(".tchat .case .errors").css("display", "none");
            } else {

                $(".tchat .case .errors").empty();
                $(".tchat .case .errors").css("display", "block");

                JSON.parse(data, (key, value) => {

                        (value.constructor === String) && $(".tchat .case .errors").append("<br/>" + value);
                })
            }
        }
    })
})

setInterval(function () {load_message();}, 10000);
update_contacts();

function load_message () {

    var id = $(".message-frame .tchat-message:first").attr('id');

    $.ajax({
        url: "../php/load-message.php",
        type: "post",
        data: "id=" + id,
        success : function(data){

            $(".message-frame").prepend(data);
        }
    });
}

function update_contacts () {

    $.ajax({
        url: "php/update-contacts.php",
        success: function (data) {

            var id = 0;

            $(".tchat .case .contacts").empty();

            if (data != "[]") {

                JSON.parse(data, (key, value) => {
                    
                    (value.constructor === String) && $(".tchat .case .contacts").append('<div class="contact"><input class="checkbox" id="0' + id + '" type="checkbox" /><label for="0' + id + '"></label><span>' + value + '</span></div>');
                    id++;
                })
            }
        }
    })
}