$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Did you fill in the form properly?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});

function submitForm(){
    // Initiate Variables With Form Content
    var name      = $("#name").val();
    var email     = $("#email").val();
    var message   = $("#message").val();
    var phoneNumb = $("#phone").val();

    $.ajax({
        type: "POST",
        url: "/",
        data: "name=" + name + "&email=" + email + "&message=" + message + "&phone=" + phoneNumb + "&c=6w-1LdB0TAAAAAPoB8GKdbG-XOqq8QaZ-ft2VGQ3n",
        success : function(response) {
            // console.log(response);
            msg = JSON.parse(response);
            if (msg.code == "success") { formSuccess(msg.message); }
            else {
                formError();
                submitMSG(false, msg.message);
            }
        }
    });
}

function formReset(){
    $("#contactForm")[0].reset();
    submitMSG(true, "");
}


function formSuccess(response){
    $("#contactForm")[0].reset();
    submitMSG(true, response);
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h4 float-right tada animated text-success";
    } else {
        var msgClasses = "h4 animated flash float-right text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
