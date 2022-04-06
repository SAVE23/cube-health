function sendOTP() {
    $(".error").html("").hide();
    var number = $("#mobile").val();
    if (number.length == 10 && number != null) {
        var input = {
            "mobile_number": number,
            "action": "send_otp"
        };
        $.ajax({
            url: 'sendotp',
            type: 'POST',
            data: input,
            dataType: 'json',
            success: function(response) {

                if (response.status == true) {
                    $(".container").html(response.data);

                } else {
                    $(".error").html('Please enter a valid number!')
                    $(".error").show();
                }
            },
            error: function() {
                alert("Please contact developer");
            }
        });
    } else {
        $(".error").html('Please enter a valid number!')
        $(".error").show();
    }
}

function verifyOTP() {
    var base_url = window.location.origin;
    $(".error").html("").hide();
    $(".success").html("").hide();
    var otp = $("#mobileOtp").val();
    var input = {
        "otp": otp,
        "action": "verify_otp"
    };
    if (otp.length == 6 && otp != null) {
        $.ajax({
            url: 'verifyotp',
            type: 'POST',
            dataType: "json",
            data: input,
            success: function(response) {
                if (response.status == true) {
                    // $(".container").html(response.data);
                    location.href = base_url + response.data;
                } else {
                    $(".error").html('You have entered wrong OTP.')
                    $(".error").show();
                }
            },
            error: function() {
                alert("Please contact developer");
            }
        });
    } else {
        $(".error").html('You have entered wrong OTP.')
        $(".error").show();
    }
}